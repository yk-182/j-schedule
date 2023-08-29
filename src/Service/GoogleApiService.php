<?php

namespace Gcal\Register\Service;

class GoogleApiService extends BaseService
{
    protected $div = null;

    public function __construct($ci)
    {
        parent::__construct($ci);
    }

    /**
     * GoogleServiceオブジェクト作成
     *
     * @param string $div
     * @return \Google_Service_Calendar
     * @throws \Exception
     */
    public function createGoogleServiceObj(string $div)
    {
        $this->div = $div;
        // サービスオブジェクトを作成
        $client = new \Google_Client();
        // このアプリケーション名
        $client->setApplicationName('gcal_regist_app');
        // 予定を追加する（取得するだけの場合はCALENDAR_READONLYでもよい）
        $client->setScopes(\Google_Service_Calendar::CALENDAR_EVENTS);
        // $client->setScopes(\Google_Service_Calendar::CALENDAR_READONLY);
        // ディビジョン設定
        $certification_path = CERTIFICATION_PATH;
        try {
            // GoogleAPI認証ファイル
            $client->setAuthConfig(__DIR__ . $certification_path);
        } catch (\Exception $e) {
            $this->logger->error('failed to create Google Service Object... [method] ' . __METHOD__ . ' [message] ' . $e->getMessage());
            throw new \Exception();
        }
        // サービスオブジェクトの用意
        $service = new \Google_Service_Calendar($client);

        return $service;
    }

    /**
     * 変更のある試合情報とそれに該当する登録済みカレンダーIDを取得する
     *
     * @param array $clubs_events
     * @param string $calendar_id
     * @param string $club
     * @param array $service
     * @param string $div
     * @param string $year
     * @return array
     * @throws \Exception
     */
    public function extractModifiedEvent($clubs_events, $calendar_id, $club, $service, $div, $year): array
    {
        $calendar_items = null;
        // Google Calendarに登録済みのイベントを取得する
        $time_min = $year . BREAK_DATE;
        $time_max = (strval(intval($year) + 1)) . BREAK_DATE;
        $opt_params = array(
            'maxResults' => 100,
            'orderBy' => 'startTime',
            'singleEvents' => true,
            'timeMin' => date('c', strtotime($time_min)),
            'timeMax' => date('c', strtotime($time_max))
        );
        try {
            $results = $service->events->listEvents($calendar_id, $opt_params);
            // GoogleCalendarに登録済みのイベントを取得
            $calendar_items = $results->getItems();
            // 対象外のイベントをリストから除去
            $calendar_items = $this->deleteNonTargetInformation($calendar_items, $div);

            // 取得したイベント数が無い場合
            if (count($calendar_items) == 0) {
                $this->logger->info('No upcoming events found. [club] :' . $club);
            } else {
                foreach ($clubs_events as $m_key => $match) {
                    foreach ($calendar_items as $e_key => $item) {

                        $summary = $item->getSummary();
                        $place = $item->getLocation();
                        $start = $item->getStart();

                        // 開催時刻が未定から決定になったタイミングのイベントは残す
                        if (isset($start['date']) &&
                            strlen($match['start_datetime']) !== DATE_LENGTH &&
                            (strpos($match['start_datetime'], $start['date'] !== false))) {
                            break;
                        }
                        // サマリー、開催時刻、場所に変更がないイベントは削除
                        if ($summary === $match['summary'] && $place === $match['place'] &&
                            ($start['dateTime'] === $match['start_datetime'] || $start['date'] === $match['start_datetime'])) {
                            unset($clubs_events[$m_key]);
                            unset($calendar_items[$e_key]);
                            break;
                        }
                    }
                }
            }
        } catch (\Exception $e) {
            $this->logger->error('failed to get GoogleCalendar Event... [method] ' . __METHOD__ . ' [message] ' . $e->getMessage());
            throw new \Exception();
        }
        $modified_events['latest_events'] = $clubs_events;
        $modified_events['outdated_events'] = $calendar_items;

        return $modified_events;
    }

    /**
     * 対象外のカレンダーイベント情報をリストから削除
     *
     * @param $calendar_items
     * @param $div
     * @return $calendar_items
     */
    public function deleteNonTargetInformation($calendar_items, $div) {
        foreach ($calendar_items as $key => $item) {
            // カレンダー登録情報の概要内容
            $description = $item->getDescription();

            // J1でないイベント情報をリストから削除
            if ($div === DIVISION_1_PRAM && strpos($description, 'J1') === false) {
                unset($calendar_items[$key]);
                // J2でないイベント情報をリストから削除
            } elseif ($div === DIVISION_2_PRAM && strpos($description, 'J2') === false) {
                unset($calendar_items[$key]);
                // J3でないイベント情報をリストから削除
            } elseif ($div === DIVISION_3_PRAM && strpos($description, 'J3') === false) {
                unset($calendar_items[$key]);
                // リーグカップでないイベントはリストから削除
            } elseif ($div === LEAGUE_CUP_PRAM && (strpos($description, LEAGUE_CUP_NAME) === false)) {
                unset($calendar_items[$key]);
                // 天皇杯でないイベントはリストから削除
            } elseif ($div === EMPEROR_CUP_PRAM && (strpos($description, EMPEROR_CUP_NAME) === false)) {
                unset($calendar_items[$key]);
            }
        }
        return $calendar_items;
    }

    /**
     * 変更のあった試合は古いイベントをカレンダーから削除
     *
     * @param array $outdated_events
     * @param string $calendar_id
     * @param array $service
     * @throws \Exception
     */
    public function deleteOutdatedEvent(array $outdated_events, string $calendar_id, $service): void
    {
        $delete_counter = 0;
        $retry_count = 0;

        foreach ($outdated_events as $event) {

            while (true) {
                try {
                    $response = $service->events->delete($calendar_id, $event->getId());
                    if ((int)$response->getStatusCode() !== API_STATUS_CODE_OK) {
                        $this->logger->error();
                        throw new \Exception('API connection was faile... [status code] : ' . (string)$response->getStatusCode());
                    }
                    $delete_counter++;
                    $this->logger->info("success to delete event! calendar title : " . $event->getSummary());
                    break;
                } catch (\Exception $e) {
                    // 失敗時は最大リトライ回数までリトライ
                    if ($retry_count === MAX_RETRY_COUNT) {
                        $this->logger->error("failed to delete event... [calendar title] " . $event->getSummary() .
                            " [method] " . __METHOD__ . " [message] " . $e->getMessage());
                        throw new \Exception();
                    }
                    $retry_count++;
                    usleep(RETRY_INTERVAL_US);
                }
            }
            $this->logger->info("Delete Total Event Number : " . $delete_counter);
        }
    }

    /**
     * Google Calendarに更新のある試合情報を登録する
     *
     * @param array $latest_events
     * @param string $calendar_id
     * @param array $service
     * @throws \Exception
     */
    public function insertLatestEvent(array $latest_events, string $calendar_id, $service): void
    {
        $insert_counter = 0;
        $retry_count = 0;

        foreach ($latest_events as $event) {

            while (true) {

                // 開催時間未定のイベントは終日予定にする
                $key_dateTime = 'dateTime';
                if (strlen($event['start_datetime']) === DATE_LENGTH) {
                    $key_dateTime = 'date';
                }
                $item = new \Google_Service_Calendar_Event(array(
                    'summary' => $event['summary'], //予定のタイトル
                    'description' => $event['note'], // 予定の概要
                    'location' => $event['place'], // 場所
                    // 'gadget.display' => 'ICON', // icon or chip
                    'visibility' => 'public',
                    'start' => array(
                        $key_dateTime => $event['start_datetime'],// 開始日時
                        'timeZone' => TIME_ZONE_TOKYO,
                    ),
                    'end' => array(
                        $key_dateTime => $event['end_datetime'], // 終了日時
                        'timeZone' => TIME_ZONE_TOKYO,
                    ),
                ));
                // カレンダー登録実行
                try {
                    $service->events->insert($calendar_id, $item);
                    $insert_counter++;
                    // usleep(100000);// 0.1秒停止 sleepしない方が成功確率高い？
                    $this->logger->info("success to insert event! [calendar title] : " . $event['summary']);
                    break;

                } catch (\Exception $e) {
                    // 失敗時は最大リトライ回数までリトライ
                    if ($retry_count === MAX_RETRY_COUNT) {
                        $this->logger->error("failed to insert Event... [calendar title] " . $event['summary'] .
                            " [method] " . __METHOD__ . " [message] " . $e->getMessage());
                        throw new \Exception();
                    }
                    $retry_count++;
                    usleep(RETRY_INTERVAL_US);
                }
            }
        }
        $this->logger->info("Insert Total Event Number : " . $insert_counter);
    }

    /**
     * Google Calendarに登録済みのイベントをすべて削除する
     * @param string $club
     * @param string $calendar_id
     * @param array $service
     * @throws \Exception
     */
    public function clearAllEvents(string $club, string $calendar_id, $service, $year): void
    {
        $time_min = $year . BREAK_DATE;
        $time_max = (strval(intval($year) + 1)) . BREAK_DATE;
        // Google Calendarに登録済みのイベントを取得する
        $opt_params = array(
            'maxResults' => 100,
            'orderBy' => 'startTime',
            'singleEvents' => true,
            'timeMin' => date('c', strtotime($time_min)),
            'timeMax' => date('c', strtotime($time_max))
        );

        $del_counter = 0;
        try {
            $results = $service->events->listEvents($calendar_id, $opt_params);
            $events = $results->getItems();

            foreach ($events as $event) {
                $event_id = $event->getId();
                $service->events->delete($calendar_id, $event_id);
                $del_counter++;
            }
        } catch (\Exception $e) {
            $this->logger->error('failed to clear Event... [club name] ' . $club);
            throw new \Exception();
        }
        $this->logger->info("Delete all " . $club . " event is success.");
    }
}
