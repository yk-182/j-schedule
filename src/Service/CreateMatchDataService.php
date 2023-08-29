<?php
namespace Gcal\Register\Service;

use GuzzleHttp\Exception\GuzzleException;
use PHPUnit\Util\Exception;

class CreateMatchDataService extends BaseService
{
    protected $ci = null;
    protected $google_api_service = null;
    protected $slack_api_service = null;
    protected $div = null;
    protected $year = null;
    protected $all_club = [];
    protected $calendar_map = [];
    protected $all_match_info_url = '';

    public function __construct(\Slim\Container $ci)
    {
        parent::__construct($ci);
        $this->ci = $ci;
        $this->slack_api_service = new SlackApiService($this->ci);
    }

    /**
     * service class main method
     *
     * @param string $div J1, J2, J3, league_cup or emperor_cup
     * @param string $year シーズンイヤー 2019,2020 etc
     * @throws GuzzleException
     */
    public function execute(string $div, string $year)
    {
        $this->div = $div;
        $this->year = $year;
        $this->calendar_map = CALENDAR_ID_MAP;
        // J1リーグクエリ
        if ($this->div === DIVISION_1_PRAM) {
            $this->all_club = FILTER_ALL_J1_CLUB;
            $this->all_match_info_url = J1_ALL_MATCHES_URL . $year;
        // J2リーグクエリ
        } elseif ($this->div === DIVISION_2_PRAM) {
            $this->all_club = FILTER_All_J2_CLUB;
            $this->all_match_info_url = J2_ALL_MATCHES_URL . $year;
        // J3リーグクエリ
        } elseif ($this->div === DIVISION_3_PRAM) {
            $this->all_club = FILTER_All_J3_CLUB;
            $this->all_match_info_url = J3_ALL_MATCHES_URL . $year;
        // リーグカップクエリ
        } elseif ($this->div === LEAGUE_CUP_PRAM) {
            $this->all_club = array_merge(FILTER_ALL_J1_CLUB, FILTER_All_J2_CLUB);
            $this->all_match_info_url = LEAGUE_CUP_MATCHES_URL . $year;
        // 天皇杯クエリ
        } elseif ($this->div === EMPEROR_CUP_PRAM) {
            $this->all_club = array_merge(FILTER_ALL_J1_CLUB, FILTER_All_J2_CLUB, FILTER_All_J3_CLUB);
            $this->all_match_info_url = EMPEROR_CUP_MATCHES_URL . $year;
        } else {
            throw new \Exception("values setting was failed...");
        }

        // Webサイトから全チームの日程を取得
        $all_match_info = $this->scrapeFromSite();
        // GoogleCalendarAPI向けにデータを整形
        $all_match_events = $this->createMatchEvent($all_match_info, $div);
        // 各クラブごとのカレンダーを作成
        $each_clubs_events = $this->createClubMatchCalendar($all_match_events);
        // GoogleServiceオブジェクト作成
        $this->google_api_service = new GoogleApiService($this->ci);
        $service = $this->google_api_service->createGoogleServiceObj($this->div);

        // 各クラブ毎に試合情報をGoogleCalendarに登録する
        foreach ($this->all_club as $club) {
            // 対象クラブの全試合イベント
            $clubs_events = $each_clubs_events[$club];
            // 対象チームのカレンダーID
            $calendar_id = $this->calendar_map[$club];
            // 試合情報に変更がある情報を抽出し、登録用と削除用のイベント配列を取得
            $modified_events = $this->google_api_service->extractModifiedEvent($clubs_events, $calendar_id, $club, $service, $this->div, $this->year);
            // カレンダーに登録済みで、変更する必要があるイベントを削除する
            if (!empty($modified_events['outdated_events'])) {
                $this->google_api_service->deleteOutdatedEvent($modified_events['outdated_events'], $calendar_id, $service);
            } else {
                $this->logger->info("There is no registered event to delete... club name : " . $club);
            }
            // カレンダーに変更のある試合情報を登録する
            if (!empty($modified_events['latest_events'])) {
                $this->google_api_service->insertLatestEvent($modified_events['latest_events'], $calendar_id, $service);
            } else {
                $this->logger->info("There is no match info to insert... club name :  {$club}");
            }
            // イベントを全削除する(必要時のみ)
            // $this->google_api_service->clearAllEvents($club, $calendar_id, $service, $this->year);
        }
    }

    /**
     * スクレイピング
     *
     * @param div 取得対象によってスクレイピングのメソッドを振り分け
     * @return array 全チームの日程
     * @throws \Exception
     */
    private function scrapeFromSite()
    {
        // Jリーグ公式サイトの日程ページをスクレイピング
        try {
             $html = \phpQuery::newDocumentFile($this->all_match_info_url);
             // デバッグ用 TODO あとで消す
             // $html = \phpQuery::newDocumentFile(__DIR__ . '/../../conf/levain.html');
             // $html = \phpQuery::newDocumentFile(__DIR__ . '/../../conf/emperor.html');
        } catch (\Exception $e) {
            $this->logger->error('failed to access Website... [method] :' . __METHOD__ . ' [message] ' . $e->getMessage());
            throw new \Exception();
        }
        // 日程が表記されたsection要素を取得
        $section_elm = \phpQuery::newDocument($html)->find(".matchlistWrap");
        // カップ戦または天皇杯取得のスクレイピングメソッド
        if ($this->div === LEAGUE_CUP_PRAM || $this->div === EMPEROR_CUP_PRAM) {
            $all_match_info = $this->createCupMatchInfo($section_elm);
        // リーグ戦取得のスクレイピングメソッド
        } else {
            $all_match_info = $this->createMatchInfo($section_elm);
        }
        return $all_match_info;
    }

    /**
     * リーグ戦試合情報用マップを作成
     * @param array $section_elm
     * @return array $all_match_info
     */
    private function createMatchInfo($section_elm)
    {
        $all_match_info = array();
        // phpQueryオブジェクトをループ
        foreach ($section_elm as $section) {

            $tr_arr = \pq($section)->find(".stadium")->parent("tr");

            foreach ($tr_arr as $key => $tr) {

                // ディビジョン "a"はコンバートオプションで全角英数字->半角英数字
                $division = mb_convert_kana(mb_substr(\pq($section)->find("h5")->text(), 6, 2), "a");
                // 節
                preg_match('/第\d{1,2}節/', \pq($section)->find("h5")->text(), $section_match);
                $section_jpn = $section_match[0];
                // 節（2桁0パディング）
                $section_num = sprintf('%02d', preg_replace('/[^0-9]/', '', $section_jpn));
                // 開催年 yyyy
                $year = substr(\pq($section)->find(".leftRedTit")->text(), 0, 4);
                // 日付 mm-dd
                preg_match("/\d{1,2}月/", \pq($section)->find(",leftRedTit")->text(), $mm_match);
                $mm = sprintf('%02d', str_replace('月', '', $mm_match[0]));
                preg_match("/月\d{1,2}/", \pq($section)->find(",leftRedTit")->text(), $dd_match);
                $dd = sprintf('%02d', str_replace('月', '', $dd_match[0]));
                $date = $mm . '-' . $dd;
                // キックオフ
                $kickoff = substr(\pq($tr)->find("td:eq(.stadium)")->text(), 0, 5);
                // 開始時間が未定の場合
                if (!preg_match(TIME_PATTERN, $kickoff)) {
                    $kickoff = MITEI;
                }
                // ホームクラブ
                $home = trim(\pq($tr)->find(".leftside")->find("a")->text());
                // アウェイクラブ
                $away = trim(\pq($tr)->find(".rightside")->find("a")->text());
                // ホームスコア
                $score_home = trim(\pq($tr)->find(".point:eq(0)")->text());
                // アウェイスコア
                $score_away = trim(\pq($tr)->find(".point:eq(1)")->text());
                // スコア
                if ($score_home !== '') {
                    $score = $score_home . '-' . $score_away;
                } else {
                    $match_status = trim(\pq($tr)->find("li")->find("span")->text());
                    $score = $match_status === SUSPENDED ? SUSPENDED : 'vs';
                }
                // 場所
                $place = \pq($tr)->find("td:eq(.stadium)")->find("a")->text();
                // 試合ID j101-yanm-20190222
                $match_id = $division . $section_num . '-' . STADIUM_ID_MAP[$place] . '-' . $year . str_replace('-', '', $date);
                if (strlen($match_id) !== MATCH_ID_LENGTH) {
                    $this->logger->warning("failed to create match_id... {$section_jpn} HOME:{$home} AWAY:{$away}");
                    $match_id = NULL;
                }
                // 詳細URL
                $url_detail = J_LEAGUE_OFFICIAL_URL . \pq($tr)->find(".match)")->find("a:eq(0)")->attr("href");

                $info = array(
                    "match_id" => $match_id, // j101-yanm-20190222
                    "division" => $division, // J1
                    "section_jpn" => $section_jpn, // 第1節
                    "section_num" => $section_num, // 01
                    "year" => $year, // 2019
                    "date" => $date, // 02-30
                    "kickoff" => $kickoff, // 18-00
                    "home" => $home, // C大阪
                    "away" => $away,  // 札幌
                    "score" => $score, // 1-1
                    "place" => $place, // ヤンマー
                    "url" => $url_detail
                );
                // 全日程をmapに追加
                $all_match_info[] = $info;
            }
        }
        if (count($all_match_info) === 0) {
            $this->logger->error('failed to create match info... [method] :' . __METHOD__);
            throw new Exception();
        }
        return $all_match_info;
    }

    /**
     * カップ戦試合情報用マップを作成
     * @param array $section_elm
     * @return array $all_match_info
     */
    private function createCupMatchInfo($section_elm)
    {
        $all_match_info = array();

        // phpQueryオブジェクトをループ
        foreach ($section_elm as $section) {

            $tr_arr = \pq($section)->find(".stadium")->parent("tr");

            foreach ($tr_arr as $key => $tr) {
                // ルヴァンカップ向けのスクレイピング
                if ($this->div === LEAGUE_CUP_PRAM) {
                    $division = LEAGUE_CUP_NAME;
                    // 節
                    $section_jpn = mb_convert_kana(str_replace('ＪリーグYBCルヴァンカップ', LEAGUE_CUP_NAME, \pq($section)->find("h5")->text()), 's');
                // 天皇杯向けのスクレイピング
                } else {
                    $division = EMPEROR_CUP_NAME;
                    // 節
                    $section_jpn = mb_convert_kana(\pq($section)->find("h5")->text(), 's');
                }
                // 開催年 yyyy
                $year = substr(\pq($section)->find(".leftRedTit")->text(), 0, 4);
                // 日付 mm-dd
                preg_match("/\d{1,2}月/", \pq($section)->find(",leftRedTit")->text(), $mm_match);
                $mm = sprintf('%02d', str_replace('月', '', $mm_match[0]));
                preg_match("/月\d{1,2}/", \pq($section)->find(",leftRedTit")->text(), $dd_match);
                $dd = sprintf('%02d', str_replace('月', '', $dd_match[0]));
                $date = $mm . '-' . $dd;
                // キックオフ
                $kickoff = substr(\pq($tr)->find("td:eq(.stadium)")->text(), 0, 5);
                // 開始時間が未定の場合
                if (!preg_match(TIME_PATTERN, $kickoff)) {
                    $kickoff = MITEI;
                }
                // ホームクラブ
                $home = trim(\pq($tr)->find(".leftside")->find("a")->text());
                if (empty($home) && $this->div === EMPEROR_CUP_PRAM) {
                   $home = trim(\pq($tr)->find("tr")->find("td:eq(0)")->text());
                }
                // アウェイクラブ
                $away = trim(\pq($tr)->find(".rightside")->find("a")->text());
                if (empty($away) && $this->div === EMPEROR_CUP_PRAM) {
                   $away = trim(\pq($tr)->find("tr")->find("td:eq(4)")->text());
                }
                // If the match club is undecided, stop processing
                if (empty($home) && empty($away)) {
                    continue;
                }
                // ホームスコア
                $score_home = trim(\pq($tr)->find(".point:eq(0)")->text());
                // アウェイスコア
                $score_away = trim(\pq($tr)->find(".point:eq(1)")->text());
                // スコア
                if ($score_home !== '') {
                    $score = $score_home . '-' . $score_away;
                } else {
                    $match_status = trim(\pq($tr)->find("li")->find("span")->text());
                    $score = $match_status === SUSPENDED ? SUSPENDED : 'vs';
                }
                // 開催地
                $place = \pq($tr)->find("td:eq(.stadium)")->find("a")->text();
                // 詳細URL
                $url_detail = J_LEAGUE_OFFICIAL_URL . \pq($tr)->find(".match)")->find("a:eq(0)")->attr("href");

                $info = array(
                    "division" => $division, // ルヴァンカップ
                    "section_jpn" => $section_jpn, // ルヴァンカップ グループステージ 第1節
                    "year" => $year, // 2019
                    "date" => $date, // 02-30
                    "kickoff" => $kickoff, // 18-00
                    "home" => $home, // C大阪
                    "away" => $away,  // 札幌
                    "score" => $score, // 1-1
                    "place" => $place, // ヤンマー
                    "url" => $url_detail
                );
                // 全日程をmapに追加
                $all_match_info[] = $info;
            }
        }
        if (count($all_match_info) === 0) {
            $this->logger->error('failed to create match info... [method] :' . __METHOD__);
            throw new Exception();
        }
        return $all_match_info;
    }

    /**
     * GoogleCalendarAPI向けのデータに整形
     *
     * @param array $all_match_info
     * @param $div
     * @return array
     * @throws GuzzleException
     */
    private function createMatchEvent(array $all_match_info, $div): array
    {

        $all_match_events = array();

        foreach ($all_match_info as $m) {

            // タイトル
            if ($m["score"] === SUSPENDED) {
                $summary = SUSPENDED . " " . $m["home"] . " vs " . $m["away"];;
            } else {
                $summary = $m["home"] . " " . $m["score"] . " " . $m["away"];
            }
            // for LeagueCup summary
            if ($div === LEAGUE_CUP_PRAM) {
                $summary = 'L ' . $summary;
            // for EmperorCup summary
            } elseif ($div === EMPEROR_CUP_PRAM) {
                $summary = 'E ' . $summary;
            }
            // 場所
            $place = STADIUM_OFFICIAL_NAME_MAP[$m["place"]];
            if (empty($place)) {
                if ($m["place"]) {
                    $place = $m["place"];
                    $this->slack_api_service->postSlackMsg(':japan: This event place is not registered. so put abbreviation... ' . $m["section_jpn"] . ' ' . $summary);
                } else {
                    $place = '不明';
                    $this->slack_api_service->postSlackMsg(':japan: Failed to configure event place... ' . $m["section_jpn"] . ' ' . $summary);
                }
            }

            // 開始日時
            if ($m["kickoff"] === MITEI) {
                // 開始時刻が未定の場合
                $start_datetime = $m["year"] . "-" . $m["date"];
                $end_datetime = $start_datetime;

            } else {
                $start_datetime = $m["year"] . "-" . $m["date"] . "T" . $m["kickoff"] . ":00+09:00";
                // 終了日時
                $hour = sprintf('%02d', intval(substr($m["kickoff"], 0, 2)) + 2);
                $final_whistle = substr_replace($m["kickoff"], $hour, 0, 2);
                $end_datetime = $m["year"] . "-" . $m["date"] . "T" . $final_whistle . ":00+09:00";
            }

            // 概要
            if (strlen($start_datetime) === DATE_LENGTH) {
                $note = $m["division"] . $m["section_jpn"] . " 開催時刻未定 " . $m["url"];
            } else {
                // 天皇杯向け概要
                if ($div === LEAGUE_CUP_PRAM || $div === EMPEROR_CUP_PRAM) {
                    $note = $m["section_jpn"] . " " . $m["url"];
                } else {
                    // シーズン向け概要
                    $note = $m["division"] . " " . $m["section_jpn"] . " " . $m["url"];
                }
            }

            $event = array(
                "summary" => $summary, // C大阪 1-1 神戸 or C大阪 vs 神戸
                "place" => $place, // ヤンマースタジアム
                "note" => $note, // J1 第1節 https://www.jleague.com/090302/
                "start_datetime" => $start_datetime, // 2019-02-22T19:00:00+09:00
                "end_datetime" => $end_datetime, // 2019-02-22T21:00:00+09:00
                "home" => $m["home"],
                "away" => $m["away"]
            );
            // 全日程をmapに追加
            $all_match_events[] = $event;
        }
        return $all_match_events;
    }

    /**
     * 各クラブの試合イベント情報から、クラブ名をkeyとしたイベント配列を作成
     *
     * @param array $all_match_events
     * @return array
     */
    public function createClubMatchCalendar(array $all_match_events)
    {
        // クラブ名をkeyとした配列
        $each_clubs_events = [];
        // 対象カテゴリーの全クラブをループ
        foreach ($this->all_club as $club) {
            $club_events = [];
            // 全日程をループ
            foreach ($all_match_events as $event) {
                // 対象クラブの試合情報を抽出
                if ($event['home'] === $club || $event['away'] === $club) {

                    $club_events[] = $event;
                }
            }
            $each_clubs_events[$club] = $club_events;
        }
        return $each_clubs_events;
    }
}
