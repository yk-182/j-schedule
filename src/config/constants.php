<?php

// レスポンスパラメータ
const HTTP_STATUS_OK = 200;
const HTTP_STATUS_INTERNAL_SERVER_ERROR = 500;
const API_STATUS_CODE_OK = 204;
const MAX_RETRY_COUNT = 3;
const RETRY_INTERVAL_US = 300000;

// リクエストパラメータ リーグ
const DIVISION_1_PRAM = 'j1';
const DIVISION_2_PRAM = 'j2';
const DIVISION_3_PRAM = 'j3';
// リクエストパラメータ Jリーグカップ
const LEAGUE_CUP_PRAM = 'league_cup';
// リクエストパラメータ 天皇杯
const EMPEROR_CUP_PRAM = 'emperor_cup';
// カップ戦名称
const LEAGUE_CUP_NAME = 'ルヴァンカップ';
const EMPEROR_CUP_NAME = '天皇杯';

// 認証ファイルパス certification.json
const CERTIFICATION_PATH = '/../../conf/certification.json';

// 試合IDの文字数
const MATCH_ID_LENGTH = 18;
// 試合中止
const SUSPENDED = '試合中止';
// 未定
const MITEI = '未定';
const UNKNOWN  = 'UNKNOWN';
// 時間の正規表現パターン
const TIME_PATTERN = '|\d{1,2}\:\d{1,2}|';
const DATE_LENGTH = 10;
const TIME_ZONE_TOKYO = 'Asia/Tokyo';

// API
const URL_API = 'url';
const GOOGLE_CALENDAR = 'gcal';

// Slack
const SLACK_API_URL = 'https://slack.com/api/chat.postMessage';
const SLACK_TOKEN = 'xoxp-16618234979-16621659600-839383915238-cd6c74c00b23bf503c5fe5e786660c6a';
const SLACK_CHANNEL = 'jlmc';
const SLACK_NORMAL_POST_MSG = ':smiley: JLMC application process ends successfully!';
const SLACK_FAILED_POST_MSG = ':scream::scream::scream: JLMC application program ends contains problems. Check /logs/app-log message';

// 登録済みイベントの取得範囲の開始日時。
const BREAK_DATE = '-01-10';

// Jリーグ公式サイトhost
const J_LEAGUE_OFFICIAL_URL = 'https://www.jleague.jp';

// J1 全クラブの試合日程・結果ページ
const J1_ALL_MATCHES_URL = 'https://www.jleague.jp/match/search/?category%5B%5D=j1&year=';
// J2 全クラブの試合日程・結果ページ
const J2_ALL_MATCHES_URL = 'https://www.jleague.jp/match/search/?category%5B%5D=j2&year=';
// J3 全クラブの試合日程・結果ページ
const J3_ALL_MATCHES_URL = 'https://www.jleague.jp/match/search/?category%5B%5D=j3&year=';
// Jリーグカップに試合日程・結果ページ
const LEAGUE_CUP_MATCHES_URL = 'https://www.jleague.jp/match/search/?category%5B%5D=leaguecup&year=';
// 天皇杯の試合日程・結果ページ
const EMPEROR_CUP_MATCHES_URL = 'https://www.jleague.jp/match/search/?category%5B%5D=emperor&year=';

// Jクラブ名 正式名称(2021) TODO:シーズン毎に降昇格を反映
// j1
const SAPPORO = '北海道コンサドーレ札幌';
const SENDAI = 'ベガルタ仙台';
const KASHIMA = '鹿島アントラーズ';
const URAWA = '浦和レッズ';
const KAWASAKI = '川崎フロンターレ';
const TOKYO = 'FC東京';
const HIROSIMA = 'サンフレッチェ広島';
const NAGOYA = '名古屋グランパス';
const GOSAKA = 'ガンバ大阪';
const YOKOHAMAFM = '横浜F・マリノス';
const SYONAN = '湘南ベルマーレ';
const KOBE = 'ヴィッセル神戸';
const COSAKA = 'セレッソ大阪';
const TOSU = 'サガン鳥栖';
const OITA = '大分トリニータ';
const SHIMIZU = '清水エスパルス';
const KASHIWA = '柏レイソル';
const YOKOHAMAFC = '横浜FC';
const TOKUSHIMA = '徳島ボルティス';
const HUKUOKA = 'アビスパ福岡';
// j2
const MATSUMOTO = '松本山雅FC';
const IWATA = 'ジュビロ磐田';
const MACHIDA = 'FC町田ゼルビア';
const YAMAGATA = 'モンテディオ山形';
const MITO = '水戸ホーリーホック';
const OKAYAMA = 'ファジアーノ岡山';
const CHIBA = 'ジェフユナイテッド千葉';
const TOCHIGI = '栃木SC';
const KYOTO = '京都サンガF.C.';
const TOKYOV = '東京ヴェルディ';
const EHIME = '愛媛FC';
const KOFU = 'ヴァンフォーレ甲府';
const RYUKYU = 'FC琉球';
const NIGATA = 'アルビレックス新潟';
const NAGASAKI = 'V・ファーレン長崎';
const KANAZAWA = 'ツエーゲン金沢';
const OMIYA = '大宮アルディージャ';
const YAMAGUCHI = 'レノファ山口F.C.';
const KITAKYUSYU = 'ギラヴァンツ北九州';
const GUNMA = 'ザスパクサツ群馬';
const AKITA = 'ブラウブリッツ秋田';
const SAGAMIHARA = 'SC相模原';
// J3
const GIHU = 'FC岐阜';
const KAGOSHIMA = '鹿児島ユナイテッドFC';
const HACHINOHE = 'ヴァンラーレ八戸';
const IWATE = 'いわてグルージャ盛岡';
const SANUKI = 'カマタマーレ讃岐';
const HUKUSHIMA = '福島ユナイテッドFC';
const NAGANO = 'AC長野パルセイロ';
const KUMAMOTO = 'ロアッソ熊本';
const HUJIEDA = '藤枝MYFC';
const NUMAZU = 'アスルクラロ沼津';
const TOYAMA = 'カターレ富山';
const TOTTORI = 'ガイナーレ鳥取';
const YSYOKOHAMA = 'Y.S.C.C.横浜';
const IMABARI = 'ＦＣ今治';
const MIYAZAKI = 'テゲバジャーロ宮崎';
//const FTOKYO23 = 'FC東京U-23'; 廃止
//const GOSAKA23 = 'ガンバ大阪U-23'; 廃止
//const COSAKA23 = 'セレッソ大阪U-23'; 廃止

// スクレイピングでの抽出用クラブ名称(2021)
// j1
const FILTER_SAPPORO = '札幌';
const FILTER_SENDAI = '仙台';
const FILTER_KASHIMA = '鹿島';
const FILTER_URAWA = '浦和';
const FILTER_KAWASAKI = '川崎Ｆ';
const FILTER_TOKYO = 'FC東京';
const FILTER_HIROSIMA = '広島';
const FILTER_NAGOYA = '名古屋';
const FILTER_GOSAKA = 'Ｇ大阪';
const FILTER_YOKOHAMAFM = '横浜FM';
const FILTER_SYONAN = '湘南';
const FILTER_KOBE = '神戸';
const FILTER_COSAKA = 'Ｃ大阪';
const FILTER_TOSU = '鳥栖';
const FILTER_OITA = '大分';
const FILTER_SHIMIZU = '清水';
const FILTER_KASHIWA = '柏';
const FILTER_YOKOHAMAFC = '横浜FC';
const FILTER_HUKUOKA = '福岡';
const FILTER_TOKUSHIMA = '徳島';
// j2
const FILTER_MATSUMOTO = '松本';
const FILTER_IWATA = '磐田';
const FILTER_MACHIDA = '町田';
const FILTER_YAMAGATA = '山形';
const FILTER_MITO = '水戸';
const FILTER_OKAYAMA = '岡山';
const FILTER_CHIBA = '千葉';
const FILTER_TOCHIGI = '栃木';
const FILTER_KYOTO = '京都';
const FILTER_TOKYOV = '東京Ｖ';
const FILTER_EHIME = '愛媛';
const FILTER_KOFU = '甲府';
const FILTER_RYUKYU = '琉球';
const FILTER_NIGATA = '新潟';
const FILTER_NAGASAKI = '長崎';
const FILTER_KANAZAWA = '金沢';
const FILTER_OMIYA = '大宮';
const FILTER_YAMAGUCHI = '山口';
const FILTER_KITAKYUSYU = '北九州';
const FILTER_GUNMA = '群馬';
const FILTER_SAGAMIHARA = '相模原';
const FILTER_AKITA = '秋田';
// j3
const FILTER_KAGOSHIMA = '鹿児島';
const FILTER_GIHU = '岐阜';
const FILTER_HACHINOHE = '八戸';
const FILTER_IWATE = '岩手';
const FILTER_SANUKI = '讃岐';
const FILTER_HUKUSHIMA = '福島';
const FILTER_NAGANO = '長野';
const FILTER_KUMAMOTO = '熊本';
const FILTER_FUJIEDA = '藤枝';
const FILTER_NUMAZU = '沼津';
const FILTER_TOYAMA = '富山';
const FILTER_TOTTORI = '鳥取';
const FILTER_IMABARI = '今治';
const FILTER_YSYOKOHAMA = 'YS横浜';
const FILTER_MIYAZAKI = '宮崎';
// const FILTER_COSAKA23 = 'Ｃ大23';
// const FILTER_FTOKYO23 = 'Ｆ東23';
// const FILTER_GOSAKA23 = 'Ｇ大23';

// TODO:シーズン毎に降昇格を反映
// ディビジョン別配列(2021)
// J1 全クラブ
const FILTER_ALL_J1_CLUB = [
    FILTER_SAPPORO,
    FILTER_SENDAI,
    FILTER_KASHIMA,
    FILTER_URAWA,
    FILTER_KAWASAKI,
    FILTER_TOKYO,
    FILTER_HIROSIMA,
    FILTER_NAGOYA,
    FILTER_GOSAKA,
    FILTER_YOKOHAMAFM,
    FILTER_SYONAN,
    FILTER_KOBE,
    FILTER_COSAKA,
    FILTER_TOSU,
    FILTER_OITA,
    FILTER_SHIMIZU,
    FILTER_KASHIWA,
    FILTER_YOKOHAMAFC,
    FILTER_TOKUSHIMA,
    FILTER_HUKUOKA,
];
// J2 全クラブ
const FILTER_All_J2_CLUB = [
    FILTER_MATSUMOTO,
    FILTER_IWATA,
    FILTER_MACHIDA,
    FILTER_YAMAGATA,
    FILTER_MITO,
    FILTER_OKAYAMA,
    FILTER_CHIBA,
    FILTER_TOCHIGI,
    FILTER_KYOTO,
    FILTER_TOKYOV,
    FILTER_EHIME,
    FILTER_KOFU,
    FILTER_RYUKYU,
    FILTER_NIGATA,
    FILTER_NAGASAKI,
    FILTER_KANAZAWA,
    FILTER_OMIYA,
    FILTER_YAMAGUCHI,
    FILTER_KITAKYUSYU,
    FILTER_GUNMA,
    FILTER_AKITA,
    FILTER_SAGAMIHARA,
];
// J3 全クラブ
const FILTER_All_J3_CLUB = [
    FILTER_GIHU,
    FILTER_KAGOSHIMA,
    FILTER_HACHINOHE,
    FILTER_IWATE,
    FILTER_SANUKI,
    FILTER_HUKUSHIMA,
    FILTER_NAGANO,
    FILTER_KUMAMOTO,
    FILTER_FUJIEDA,
    FILTER_NUMAZU,
    FILTER_TOYAMA,
    FILTER_TOTTORI,
    FILTER_IMABARI,
    FILTER_YSYOKOHAMA,
    FILTER_MIYAZAKI,
    // FILTER_COSAKA23,
    // FILTER_FTOKYO23,
    // FILTER_GOSAKA23,
];

// セレクトボックス用クラブ配列(2021)
// J1 クラブ正式名称配列
const SELECTBOX_J1_CLUB = [
    FILTER_YOKOHAMAFM => YOKOHAMAFM,
    FILTER_TOKYO => TOKYO,
    FILTER_KASHIMA => KASHIMA,
    FILTER_HIROSIMA => HIROSIMA,
    FILTER_SAPPORO => SAPPORO,
    FILTER_KAWASAKI => KAWASAKI,
    FILTER_NAGOYA => NAGOYA,
    FILTER_COSAKA => COSAKA,
    FILTER_GOSAKA => GOSAKA,
    FILTER_KOBE => KOBE,
    FILTER_TOSU => TOSU,
    FILTER_URAWA => URAWA,
    FILTER_OITA => OITA,
    FILTER_SENDAI => SENDAI,
    FILTER_SHIMIZU => SHIMIZU,
    FILTER_SYONAN => SYONAN,
    FILTER_KASHIWA  => KASHIWA,
    FILTER_YOKOHAMAFC  => YOKOHAMAFC,
    FILTER_TOKUSHIMA  => TOKUSHIMA,
    FILTER_HUKUOKA  => HUKUOKA,
];
// J2 クラブ正式名称配列
const SELECTBOX_J2_CLUB = [
    FILTER_MATSUMOTO => MATSUMOTO,
    FILTER_IWATA => IWATA,
    FILTER_MACHIDA  => MACHIDA,
    FILTER_YAMAGATA  => YAMAGATA,
    FILTER_MITO  => MITO,
    FILTER_OKAYAMA  => OKAYAMA,
    FILTER_CHIBA  => CHIBA,
    FILTER_TOCHIGI  => TOCHIGI,
    FILTER_KYOTO  => KYOTO,
    FILTER_TOKYOV  => TOKYOV,
    FILTER_EHIME  => EHIME,
    FILTER_KOFU  => KOFU,
    FILTER_RYUKYU  => RYUKYU,
    FILTER_NIGATA  => NIGATA,
    FILTER_NAGASAKI  => NAGASAKI,
    FILTER_KANAZAWA  => KANAZAWA,
    FILTER_OMIYA  => OMIYA,
    FILTER_YAMAGUCHI  => YAMAGUCHI,
    FILTER_KITAKYUSYU => KITAKYUSYU,
    FILTER_GUNMA => GUNMA,
    FILTER_AKITA => AKITA,
    FILTER_SAGAMIHARA => SAGAMIHARA,
];
// J3 クラブ正式名称配列
const SELECTBOX_J3_CLUB = [
    FILTER_GIHU  => GIHU,
    FILTER_KAGOSHIMA  => KAGOSHIMA,
    FILTER_HACHINOHE => HACHINOHE,
    FILTER_IWATE => IWATE,
    FILTER_SANUKI => SANUKI,
    FILTER_HUKUSHIMA => HUKUSHIMA,
    FILTER_NAGANO => NAGANO,
    FILTER_KUMAMOTO => KUMAMOTO,
    FILTER_FUJIEDA => HUJIEDA,
    FILTER_NUMAZU => NUMAZU,
    FILTER_TOYAMA => TOYAMA,
    FILTER_TOTTORI => TOTTORI,
    FILTER_YSYOKOHAMA => YSYOKOHAMA,
    FILTER_IMABARI => IMABARI,
    FILTER_MIYAZAKI => MIYAZAKI,
    // FILTER_FTOKYO23 => FTOKYO23,
    // FILTER_GOSAKA23 => GOSAKA23,
    // FILTER_COSAKA23 => COSAKA23,
];

// カレンダーIDマップ(2021)
const CALENDAR_ID_MAP = [
    // j1
    FILTER_SAPPORO => 'u89580aghvj5b1tq164u987l04@group.calendar.google.com',
    FILTER_SENDAI => 'j4u89g5i4hs51djfqgsjje8sgc@group.calendar.google.com',
    FILTER_KASHIMA => 'fd5gkgrrca13nugkkevk6tmb8s@group.calendar.google.com',
    FILTER_URAWA => 'vnjd08tutrfdfskvi07pboevtk@group.calendar.google.com',
    FILTER_KAWASAKI => '0ucb23q7phqc5fd2n4uk8u7e48@group.calendar.google.com',
    FILTER_TOKYO => 'aht6pq1qmfg3v99740nvbj0uao@group.calendar.google.com',
    FILTER_HIROSIMA => 's7bvi9uspgt4cu636e6kojk5ek@group.calendar.google.com',
    FILTER_NAGOYA => '98aqhft3pkgncpuhe0fktp0ab0@group.calendar.google.com',
    FILTER_GOSAKA => '5u25aq263tsfg4a6dv5089vh8s@group.calendar.google.com',
    FILTER_YOKOHAMAFM => 'qbmflqvuoh7mlqjh47igvabjbs@group.calendar.google.com',
    FILTER_SYONAN => 'sj95fq0juqp76klfp7mihsjkr8@group.calendar.google.com',
    FILTER_KOBE => 'd2qvdvav89ju17ju66f6fmtdgg@group.calendar.google.com',
    FILTER_COSAKA => 'tt5a4dc8uil9mma8kclbca4t9o@group.calendar.google.com',
    FILTER_TOSU => 'tvt1igtpgc5qhbphtnjm8i7fv0@group.calendar.google.com',
    FILTER_OITA => '3j7gmci005v4v7pojoadvt0ui8@group.calendar.google.com',
    FILTER_SHIMIZU => 'rphh2ib1t7b17lvk30uegc06m4@group.calendar.google.com',
    FILTER_KASHIWA => 'qqcjpq3cbdgmk6mof5bs5b7bqk@group.calendar.google.com',
    FILTER_YOKOHAMAFC => 'l433pqkjc1j1dv51tup1knqlg8@group.calendar.google.com',
    FILTER_TOKUSHIMA => 'cppi16m0scgauiplv8u7vdgsic@group.calendar.google.com',
    FILTER_HUKUOKA => 'tjsql7ggolkhr5h77ehf4s9id0@group.calendar.google.com',
    // j2
    FILTER_MATSUMOTO => 'jdnhtd0fpb8m1ra92l5m7or2j0@group.calendar.google.com',
    FILTER_IWATA => "2v5ck5v9e710bjpf0cdujkf2c8@group.calendar.google.com",
    FILTER_MACHIDA => '8c1injr1afd50o9jjtqidhafhg@group.calendar.google.com',
    FILTER_YAMAGATA => 'e311o157al64620k6og3t2jr38@group.calendar.google.com',
    FILTER_MITO => 'mv283ms1rmi5c1lmg71hrll6sg@group.calendar.google.com',
    FILTER_OKAYAMA => 'dceoae50pmsglf2se6cqobf2ak@group.calendar.google.com',
    FILTER_CHIBA => '2co3r7feqg7magkneoa9v5ihu8@group.calendar.google.com',
    FILTER_TOCHIGI => '95h1j9jg67olqjo07ghoejoehk@group.calendar.google.com',
    FILTER_KYOTO => 'if0kb70g2rk1m2qjsn6ocjjbn0@group.calendar.google.com',
    FILTER_TOKYOV => '4285ttkefoussr68g0bbra9urg@group.calendar.google.com',
    FILTER_EHIME => 'hoe9no27faodk8p9i2nu0cdutk@group.calendar.google.com',
    FILTER_KOFU => '0sr1qekfkfu98if9o3obntrdvg@group.calendar.google.com',
    FILTER_RYUKYU => '1lc0vle42iakuel18nhrsvngeg@group.calendar.google.com',
    FILTER_NIGATA => '3d8ks2uf6ii4987e9u9t72nmgo@group.calendar.google.com',
    FILTER_NAGASAKI => '562vpoqh61jdh4mk96cirkjn6c@group.calendar.google.com',
    FILTER_KANAZAWA => '59lps4elc4amqbspu9kl48gsao@group.calendar.google.com',
    FILTER_OMIYA => 'oq18s07kff0quqgmnih86msirk@group.calendar.google.com',
    FILTER_YAMAGUCHI => 'sgqhimo85m398u45ug68hui3i0@group.calendar.google.com',
    FILTER_KITAKYUSYU => '2b2lv1i5husil1l61p43vce9cs@group.calendar.google.com',
    FILTER_GUNMA => 'ubktjvofdkd0irsom0t9eovrnc@group.calendar.google.com',
    FILTER_SAGAMIHARA => '6tqf27hn22crimscpp70vnkai4@group.calendar.google.com',
    FILTER_AKITA => '7bsi8g1bkomebklq9m4gb3t1pg@group.calendar.google.com',
    // j3
    FILTER_KAGOSHIMA => '53opmjg0o6d0b4pgiaed20brps@group.calendar.google.com',
    FILTER_GIHU => 'ua82m1lsiv8scsa8l1mnjc15ds@group.calendar.google.com',
    FILTER_HACHINOHE => 'pp9p96cn1cngu81q7i7s0v7tac@group.calendar.google.com',
    FILTER_IWATE => 'php649ca6rl9udd1khedc03an8@group.calendar.google.com',
    FILTER_SANUKI => '9ag97rucucobvcq9c4b1nop1sk@group.calendar.google.com',
    FILTER_HUKUSHIMA => 'a3qd674dghtu359799f5802kto@group.calendar.google.com',
    FILTER_NAGANO => 'g8lpeulq7nomsdmokgj7ujadck@group.calendar.google.com',
    FILTER_KUMAMOTO => 'niputcmeq3i35ngflk0np2ofik@group.calendar.google.com',
    FILTER_NUMAZU => 'soh5eooj8olk81q67ne3jjv64c@group.calendar.google.com',
    FILTER_FUJIEDA => 'ojip7172u6mnvi4nrtp28u4om0@group.calendar.google.com',
    FILTER_TOYAMA => '12o91aehg20cebnetk1oubm24c@group.calendar.google.com',
    FILTER_TOTTORI => '69k1ipnt0ibccr7fd41jp2pdms@group.calendar.google.com',
    FILTER_YSYOKOHAMA => 'nlg3tk6dkshi5r8rlb4f91emqk@group.calendar.google.com',
    FILTER_IMABARI => 'ur0r9gj4tnicp012m9lcab68eg@group.calendar.google.com',
    FILTER_MIYAZAKI => '3uljfjm4uljvcl6augmvplo5ok@group.calendar.google.com',
    // FILTER_COSAKA23 => '1rirgkg3a7gjo0l6g20db9ipoc@group.calendar.google.com',
    // FILTER_FTOKYO23 => 'dgvltuk61k4n2muhn86e5m2iag@group.calendar.google.com',
    // FILTER_GOSAKA23 => 'h743klmr0on0vtoqir2ded223s@group.calendar.google.com',
];

// 公開カレンダーURLマップ(2021)
const PUBLIC_CALENDAR_URL_MAP = [
    // j1
    FILTER_SAPPORO => 'https://calendar.google.com/calendar/r?cid=u89580aghvj5b1tq164u987l04@group.calendar.google.com',
    FILTER_SENDAI => 'https://calendar.google.com/calendar/r?cid=j4u89g5i4hs51djfqgsjje8sgc@group.calendar.google.com',
    FILTER_KASHIMA => 'https://calendar.google.com/calendar/r?cid=fd5gkgrrca13nugkkevk6tmb8s@group.calendar.google.com',
    FILTER_URAWA => 'https://calendar.google.com/calendar/b/1?cid=dm5qZDA4dHV0cmZkZnNrdmkwN3Bib2V2dGtAZ3JvdXAuY2FsZW5kYXIuZ29vZ2xlLmNvbQ',
    FILTER_KAWASAKI => 'https://calendar.google.com/calendar/r?cid=0ucb23q7phqc5fd2n4uk8u7e48@group.calendar.google.com',
    FILTER_TOKYO => 'https://calendar.google.com/calendar/r?cid=aht6pq1qmfg3v99740nvbj0uao@group.calendar.google.com',
    FILTER_HIROSIMA => 'https://calendar.google.com/calendar/r?cid=s7bvi9uspgt4cu636e6kojk5ek@group.calendar.google.com',
    FILTER_SHIMIZU => 'https://calendar.google.com/calendar/r?cid=rphh2ib1t7b17lvk30uegc06m4@group.calendar.google.com',
    FILTER_NAGOYA => 'https://calendar.google.com/calendar/r?cid=98aqhft3pkgncpuhe0fktp0ab0@group.calendar.google.com',
    FILTER_OITA => 'https://calendar.google.com/calendar/r?cid=3j7gmci005v4v7pojoadvt0ui8@group.calendar.google.com',
    FILTER_GOSAKA => 'https://calendar.google.com/calendar/r?cid=5u25aq263tsfg4a6dv5089vh8s@group.calendar.google.com',
    FILTER_YOKOHAMAFM => 'https://calendar.google.com/calendar/r?cid=qbmflqvuoh7mlqjh47igvabjbs@group.calendar.google.com',
    FILTER_SYONAN => 'https://calendar.google.com/calendar/r?cid=sj95fq0juqp76klfp7mihsjkr8@group.calendar.google.com',
    FILTER_KOBE => 'https://calendar.google.com/calendar/r?cid=d2qvdvav89ju17ju66f6fmtdgg@group.calendar.google.com',
    FILTER_COSAKA => 'https://calendar.google.com/calendar/r?cid=tt5a4dc8uil9mma8kclbca4t9o@group.calendar.google.com',
    FILTER_TOSU => 'https://calendar.google.com/calendar/r?cid=tvt1igtpgc5qhbphtnjm8i7fv0@group.calendar.google.com',
    FILTER_KASHIWA => 'https://calendar.google.com/calendar/r?cid=n1v45m37glqddpiarb1edqn9j8@group.calendar.google.com',
    FILTER_YOKOHAMAFC => 'https://calendar.google.com/calendar/r?cid=55mn5d5ava8mprop8bcn9l30r0@group.calendar.google.com',
    FILTER_TOKUSHIMA => 'https://calendar.google.com/calendar/b/1?cid=Y3BwaTE2bTBzY2dhdWlwbHY4dTd2ZGdzaWNAZ3JvdXAuY2FsZW5kYXIuZ29vZ2xlLmNvbQ',
    FILTER_HUKUOKA => 'https://calendar.google.com/calendar/b/1?cid=dGpzcWw3Z2dvbGtocjVoNzdlaGY0czlpZDBAZ3JvdXAuY2FsZW5kYXIuZ29vZ2xlLmNvbQ',
    // j2
    FILTER_MATSUMOTO => 'https://calendar.google.com/calendar/r?cid=jdnhtd0fpb8m1ra92l5m7or2j0@group.calendar.google.com',
    FILTER_IWATA => 'https://calendar.google.com/calendar/r?cid=2v5ck5v9e710bjpf0cdujkf2c8@group.calendar.google.com',
    FILTER_MACHIDA => 'https://calendar.google.com/calendar/b/1?cid=OGMxaW5qcjFhZmQ1MG85amp0cWlkaGFmaGdAZ3JvdXAuY2FsZW5kYXIuZ29vZ2xlLmNvbQ',
    FILTER_YAMAGATA => 'https://calendar.google.com/calendar/b/1?cid=ZTMxMW8xNTdhbDY0NjIwazZvZzN0MmpyMzhAZ3JvdXAuY2FsZW5kYXIuZ29vZ2xlLmNvbQ',
    FILTER_MITO => 'https://calendar.google.com/calendar/b/1?cid=bXYyODNtczFybWk1YzFsbWc3MWhybGw2c2dAZ3JvdXAuY2FsZW5kYXIuZ29vZ2xlLmNvbQ',
    FILTER_OKAYAMA => 'https://calendar.google.com/calendar/b/1?cid=ZGNlb2FlNTBwbXNnbGYyc2U2Y3FvYmYyYWtAZ3JvdXAuY2FsZW5kYXIuZ29vZ2xlLmNvbQ',
    FILTER_CHIBA => 'https://calendar.google.com/calendar/b/1?cid=MmNvM3I3ZmVxZzdtYWdrbmVvYTl2NWlodThAZ3JvdXAuY2FsZW5kYXIuZ29vZ2xlLmNvbQ',
    FILTER_TOCHIGI => 'https://calendar.google.com/calendar/b/1?cid=OTVoMWo5amc2N29scWpvMDdnaG9lam9laGtAZ3JvdXAuY2FsZW5kYXIuZ29vZ2xlLmNvbQ',
    FILTER_KYOTO => 'https://calendar.google.com/calendar/b/1?cid=aWYwa2I3MGcycmsxbTJxanNuNm9jampibjBAZ3JvdXAuY2FsZW5kYXIuZ29vZ2xlLmNvbQ',
    FILTER_TOKYOV => 'https://calendar.google.com/calendar/b/1?cid=NDI4NXR0a2Vmb3Vzc3I2OGcwYmJyYTl1cmdAZ3JvdXAuY2FsZW5kYXIuZ29vZ2xlLmNvbQ',
    FILTER_EHIME => 'https://calendar.google.com/calendar/b/1?cid=aG9lOW5vMjdmYW9kazhwOWkybnUwY2R1dGtAZ3JvdXAuY2FsZW5kYXIuZ29vZ2xlLmNvbQ',
    FILTER_KOFU => 'https://calendar.google.com/calendar/b/1?cid=MHNyMXFla2ZrZnU5OGlmOW8zb2JudHJkdmdAZ3JvdXAuY2FsZW5kYXIuZ29vZ2xlLmNvbQ',
    FILTER_RYUKYU => 'https://calendar.google.com/calendar/b/1?cid=MWxjMHZsZTQyaWFrdWVsMThuaHJzdm5nZWdAZ3JvdXAuY2FsZW5kYXIuZ29vZ2xlLmNvbQ',
    FILTER_NIGATA => 'https://calendar.google.com/calendar/b/1?cid=M2Q4a3MydWY2aWk0OTg3ZTl1OXQ3Mm5tZ29AZ3JvdXAuY2FsZW5kYXIuZ29vZ2xlLmNvbQ',
    FILTER_NAGASAKI => 'https://calendar.google.com/calendar/b/1?cid=NTYydnBvcWg2MWpkaDRtazk2Y2lya2puNmNAZ3JvdXAuY2FsZW5kYXIuZ29vZ2xlLmNvbQ',
    FILTER_KANAZAWA => 'https://calendar.google.com/calendar/b/1?cid=NTlscHM0ZWxjNGFtcWJzcHU5a2w0OGdzYW9AZ3JvdXAuY2FsZW5kYXIuZ29vZ2xlLmNvbQ',
    FILTER_OMIYA => 'https://calendar.google.com/calendar/b/1?cid=b3ExOHMwN2tmZjBxdXFnbW5paDg2bXNpcmtAZ3JvdXAuY2FsZW5kYXIuZ29vZ2xlLmNvbQ',
    FILTER_YAMAGUCHI => 'https://calendar.google.com/calendar/b/1?cid=c2dxaGltbzg1bTM5OHU0NXVnNjhodWkzaTBAZ3JvdXAuY2FsZW5kYXIuZ29vZ2xlLmNvbQ',
    FILTER_KITAKYUSYU => 'https://calendar.google.com/calendar/b/1?cid=MmIybHYxaTVodXNpbDFsNjFwNDN2Y2U5Y3NAZ3JvdXAuY2FsZW5kYXIuZ29vZ2xlLmNvbQ',
    FILTER_GUNMA => 'https://calendar.google.com/calendar/b/1?cid=dWJrdGp2b2Zka2QwaXJzb20wdDllb3ZybmNAZ3JvdXAuY2FsZW5kYXIuZ29vZ2xlLmNvbQ',
    FILTER_AKITA => 'https://calendar.google.com/calendar/b/1?cid=N2JzaThnMWJrb21lYmtscTltNGdiM3QxcGdAZ3JvdXAuY2FsZW5kYXIuZ29vZ2xlLmNvbQ',
    FILTER_SAGAMIHARA => 'https://calendar.google.com/calendar/b/1?cid=NnRxZjI3aG4yMmNyaW1zY3BwNzB2bmthaTRAZ3JvdXAuY2FsZW5kYXIuZ29vZ2xlLmNvbQ',
    // j3
    FILTER_KAGOSHIMA => 'https://calendar.google.com/calendar/b/1?cid=NTNvcG1qZzBvNmQwYjRwZ2lhZWQyMGJycHNAZ3JvdXAuY2FsZW5kYXIuZ29vZ2xlLmNvbQ',
    FILTER_GIHU => 'https://calendar.google.com/calendar/b/1?cid=dWE4Mm0xbHNpdjhzY3NhOGwxbW5qYzE1ZHNAZ3JvdXAuY2FsZW5kYXIuZ29vZ2xlLmNvbQ',
    FILTER_HACHINOHE => 'https://calendar.google.com/calendar/b/1?cid=cHA5cDk2Y24xY25ndTgxcTdpN3Mwdjd0YWNAZ3JvdXAuY2FsZW5kYXIuZ29vZ2xlLmNvbQ',
    FILTER_IWATE => 'https://calendar.google.com/calendar/b/1?cid=cGhwNjQ5Y2E2cmw5dWRkMWtoZWRjMDNhbjhAZ3JvdXAuY2FsZW5kYXIuZ29vZ2xlLmNvbQ',
    FILTER_SANUKI => 'https://calendar.google.com/calendar/b/1?cid=OWFnOTdydWN1Y29idmNxOWM0YjFub3Axc2tAZ3JvdXAuY2FsZW5kYXIuZ29vZ2xlLmNvbQ',
    FILTER_HUKUSHIMA => 'https://calendar.google.com/calendar/b/1?cid=YTNxZDY3NGRnaHR1MzU5Nzk5ZjU4MDJrdG9AZ3JvdXAuY2FsZW5kYXIuZ29vZ2xlLmNvbQ',
    FILTER_NAGANO => 'https://calendar.google.com/calendar/b/1?cid=ZzhscGV1bHE3bm9tc2Rtb2tnajd1amFkY2tAZ3JvdXAuY2FsZW5kYXIuZ29vZ2xlLmNvbQ',
    FILTER_KUMAMOTO => 'https://calendar.google.com/calendar/b/1?cid=bmlwdXRjbWVxM2kzNW5nZmxrMG5wMm9maWtAZ3JvdXAuY2FsZW5kYXIuZ29vZ2xlLmNvbQ',
    FILTER_NUMAZU => 'https://calendar.google.com/calendar/b/1?cid=c29oNWVvb2o4b2xrODFxNjduZTNqanY2NGNAZ3JvdXAuY2FsZW5kYXIuZ29vZ2xlLmNvbQ',
    FILTER_FUJIEDA => 'https://calendar.google.com/calendar/b/1?cid=b2ppcDcxNzJ1Nm1udmk0bnJ0cDI4dTRvbTBAZ3JvdXAuY2FsZW5kYXIuZ29vZ2xlLmNvbQ',
    FILTER_TOYAMA => 'https://calendar.google.com/calendar/b/1?cid=MTJvOTFhZWhnMjBjZWJuZXRrMW91Ym0yNGNAZ3JvdXAuY2FsZW5kYXIuZ29vZ2xlLmNvbQ',
    FILTER_TOTTORI => 'https://calendar.google.com/calendar/b/1?cid=NjlrMWlwbnQwaWJjY3I3ZmQ0MWpwMnBkbXNAZ3JvdXAuY2FsZW5kYXIuZ29vZ2xlLmNvbQ',
    FILTER_YSYOKOHAMA => 'https://calendar.google.com/calendar/b/1?cid=bmxnM3RrNmRrc2hpNXI4cmxiNGY5MWVtcWtAZ3JvdXAuY2FsZW5kYXIuZ29vZ2xlLmNvbQ',
    FILTER_IMABARI => 'https://calendar.google.com/calendar/b/1?cid=dXIwcjlnajR0bmljcDAxMm05bGNhYjY4ZWdAZ3JvdXAuY2FsZW5kYXIuZ29vZ2xlLmNvbQ',
    FILTER_MIYAZAKI => 'https://calendar.google.com/calendar/u/2?cid=M3VsamZqbTR1bGp2Y2w2YXVnbXZwbG81b2tAZ3JvdXAuY2FsZW5kYXIuZ29vZ2xlLmNvbQ',
    // FILTER_COSAKA23 => 'https://calendar.google.com/calendar/b/1?cid=MXJpcmdrZzNhN2dqbzBsNmcyMGRiOWlwb2NAZ3JvdXAuY2FsZW5kYXIuZ29vZ2xlLmNvbQ',
    // FILTER_FTOKYO23 => 'https://calendar.google.com/calendar/b/1?cid=ZGd2bHR1azYxazRuMm11aG44NmU1bTJpYWdAZ3JvdXAuY2FsZW5kYXIuZ29vZ2xlLmNvbQ',
    // FILTER_GOSAKA23 => 'https://calendar.google.com/calendar/b/1?cid=aDc0M2tsbXIwb24wdnRvcWlyMmRlZDIyM3NAZ3JvdXAuY2FsZW5kYXIuZ29vZ2xlLmNvbQ',
];

// スタジアムスクレイピング用
const ST_YANMAR = 'ヤンマー';
const ST_YODOKO = 'ヨドコウ';
const ST_ALWIN = 'サンアル';
const ST_YURTEC = 'ユアスタ';
const ST_TODOROKI = '等々力';
const ST_EDION = 'Ｅスタ';
const ST_EKIMAE = '駅スタ';
const ST_KASHIMA = 'カシマ';
const ST_YAMAHA = 'ヤマハ';
const ST_PANASONIC = 'パナスタ';
//const ST_BMW = 'ＢＭＷス'; 名前変更
const ST_LEMON = 'レモンＳ';
const ST_NISSAN = '日産ス';
const ST_IAI = 'アイスタ';
const ST_PALOMA = 'パロ瑞穂';
const ST_NOEVIR = 'ノエスタ';
const ST_SAITAMA = '埼玉';
const ST_URAWA = '浦和駒場';
const ST_SYOWA = '昭和電ド';
const ST_SAPPORO = '札幌ド';
const ST_AJINOMOTO = '味スタ';
const ST_TOYOTA = '豊田ス';
const ST_ECOPA = 'エコパ';
const ST_NIPPATSU = 'ニッパツ';
const ST_ATSUBETSU = '札幌厚別';
const ST_OITA = '大分陸';
const ST_SHIRANAMI = '白波スタ';
const ST_TOCHIGI = '栃木グ';
const ST_KANSEKI = 'カンセキ'; // 2020/7月に開場
const ST_NACK = 'ＮＡＣＫ';
const ST_MACHIDA = '町田';
const ST_NAGARAGAWA = '長良川';
const ST_TAKEBISHI = 'たけびし';
const ST_CITY = 'Ｃスタ';
const ST_TRANS = 'トラスタ';
const ST_MIRAI = 'みらスタ';
const ST_NINGINEER = 'ニンスタ';
const ST_TAPIC = 'タピスタ';
const ST_SANKYO = '三協Ｆ柏';
const ST_HAKATA = '博多陸';
const ST_KSDENKI = 'Ｋｓスタ';
const ST_FUKUDA = 'フクアリ';
const ST_POCARI = '鳴門大塚';
const ST_DENKA = 'デンカＳ';
const ST_NDSOFT = 'ＮＤスタ';
const ST_CHUGIN = '中銀スタ';
const ST_ISHIKAWA = '石川西部';
const ST_NISHIGAOKA = '味フィ西';
const ST_LEVEL5 = 'レベスタ'; // 2020シーズンからベスト電器スタジアムに名称変更
const ST_BEST = 'ベススタ';
const ST_KOMAZAWA = '駒沢';
const ST_SHIMONOSEKI = '下関';
const ST_KUMAGAYA = '熊谷陸';
const ST_FUJIEDA = '藤枝サ';
const ST_GION = 'ギオンス';
const ST_PIKARA = 'ピカスタ';
const ST_EGAO = 'えがおＳ';
const ST_MIKUNI = 'ミクスタ';
const ST_SHODA = '正田スタ';
const ST_NAGANOU = '長野Ｕ';
const ST_ASHITAKA = '愛鷹';
const ST_TORIGIN = 'とりスタ';
const ST_TOYAMA = '富山';
const ST_DAIHATSU = 'ダイスタ';
const ST_IWAGIN = 'いわスタ';
const ST_TOHO = 'とうスタ';
const ST_SOYU = 'ソユスタ';
const ST_CHUBU = 'チュスタ';
const ST_BANPAKU = '万博';
const ST_AIZU = 'あいづ';
const ST_JVILLAGE = 'Ｊスタ';
const ST_KITAKAMI = '北上';
const ST_IKIMENOMORI = '生目の杜';
const ST_YUMENOSHIMA = '夢の島';
const ST_SUIZENJI = '水前寺';
const ST_MITSUZAWA = '三ツ沢陸';
const ST_YUME = '夢スタ';
const ST_HUKUI = '福井';
const ST_PRIFOODS = 'プラスタ';
const ST_MACHIDAGION = 'Ｇスタ';
const ST_SANGA = 'サンガＳ';
const ST_KORIYAMA = '郡山西部';
const ST_KOKURITSU = '国立';
const ST_UNIVER = '神戸ユ';
const ST_HUKUYAMA = '福山';
const ST_COCA = 'コカ広島';
const ST_TAKAOKA = '高岡';
const ST_MEADOW = '長良川球';
const ST_NARADEN = 'ならでん';
const ST_KAKIDOMARI = '長崎市';
const ST_SANKO = '三交鈴鹿';
const ST_SAKU = '佐久';
const ST_HIGASHIOMI = '東近江';
const ST_SHIKISHIMA = '群馬サ';
const ST_KIMIIDERA = '紀三井寺';
const ST_SHIMANE = '島根サ';
const ST_NOBEOKA = '延岡西階';
const ST_CHICHIBU = '秩父宮';
const ST_AXIS = 'Ａｘｉｓ';
const ST_YUNISUTA = 'ユニスタ';
const ST_SVSHIMO = 'ＳＶ下関';
// 未定
const ST_UNKNOWN = MITEI;

// スタジアムID
const STADIUM_ID_MAP = [
    ST_YANMAR => 'yanm',
    ST_YODOKO => 'yodo',
    ST_ALWIN => 'alwi',
    ST_YURTEC => 'yurt',
    ST_TODOROKI => 'todo',
    ST_EDION => 'edio',
    ST_EKIMAE => 'ekim',
    ST_KASHIMA => 'kash',
    ST_YAMAHA => 'yama',
    ST_PANASONIC => 'pana',
    // ST_BMW => 'bmws',
    ST_LEMON => 'lemo',
    ST_NISSAN => 'niss',
    ST_IAI => 'iais',
    ST_PALOMA => 'palo',
    ST_NOEVIR => 'noev',
    ST_SAITAMA => 'sait',
    ST_URAWA => 'uraw',
    ST_SYOWA => 'syow',
    ST_SAPPORO => 'sapp',
    ST_AJINOMOTO => 'ajin',
    ST_TOYOTA => 'toyo',
    ST_ECOPA => 'ecop',
    ST_NIPPATSU => 'nipp',
    ST_ATSUBETSU => 'atsu',
    ST_OITA => 'oita',
    ST_SHIRANAMI => 'shir',
    ST_TOCHIGI => 'toch',
    ST_KANSEKI => 'kans',
    ST_NACK => 'nack',
    ST_MACHIDA => 'mach',
    ST_NAGARAGAWA => 'naga',
    ST_TAKEBISHI => 'take',
    ST_CITY => 'city',
    ST_TRANS => 'tran',
    ST_MIRAI => 'mira',
    ST_NINGINEER => 'ning',
    ST_TAPIC => 'tapi',
    ST_SANKYO => 'sank',
    ST_HAKATA => 'haka',
    ST_KSDENKI => 'ksde',
    ST_FUKUDA => 'fuku',
    ST_POCARI => 'poca',
    ST_DENKA => 'denk',
    ST_NDSOFT => 'ndso',
    ST_CHUGIN => 'chug',
    ST_ISHIKAWA => 'ishi',
    ST_NISHIGAOKA => 'nish',
    ST_LEVEL5 => 'leve',
    ST_BEST => 'best',
    ST_KOMAZAWA => 'koma',
    ST_SHIMONOSEKI => 'shim',
    ST_KUMAGAYA => 'kuma',
    ST_FUJIEDA => 'fuji',
    ST_GION => 'gion',
    ST_PIKARA => 'pika',
    ST_EGAO => 'egao',
    ST_MIKUNI => 'miku',
    ST_SHODA => 'shod',
    ST_NAGANOU => 'nagu',
    ST_ASHITAKA => 'ashi',
    ST_TORIGIN => 'tori',
    ST_TOYAMA => 'toya',
    ST_DAIHATSU => 'daih',
    ST_IWAGIN => 'iwag',
    ST_TOHO => 'toho',
    ST_SOYU => 'soyu',
    ST_CHUBU => 'chub',
    ST_BANPAKU => 'banp',
    ST_AIZU => 'aizu',
    ST_JVILLAGE => 'jvil',
    ST_KITAKAMI => 'kita',
    ST_IKIMENOMORI => 'ikim',
    ST_YUMENOSHIMA => 'yume',
    ST_SUIZENJI => 'suiz',
    ST_MITSUZAWA => 'mits',
    ST_YUME => 'yume',
    ST_HUKUI => 'huku',
    ST_PRIFOODS => 'prif',
    ST_MACHIDAGION => 'magi',
    ST_SANGA => 'sang',
    ST_KORIYAMA => 'kori',
    ST_KOKURITSU => 'koku',
    ST_UNIVER => 'univ',
    ST_HUKUYAMA => 'huku',
    ST_COCA => 'coca',
    ST_TAKAOKA => 'taka',
    ST_MEADOW => 'mead',
    ST_NARADEN => 'nade',
    ST_KAKIDOMARI => 'kaki',
    ST_SANKO => 'sank',
    ST_SAKU => 'saku',
    ST_HIGASHIOMI => 'homi',
    ST_SHIKISHIMA => 'shik',
    ST_KIMIIDERA => 'kimi',
    ST_SHIMANE => 'shim',
    ST_NOBEOKA => 'nobe',
    ST_CHICHIBU => 'chic',
    ST_AXIS => 'axis',
    ST_YUNISUTA => 'yuni',
    ST_SVSHIMO => 'svsh',
    // UNKNOWN
    ST_UNKNOWN => 'unkn',
];

// スタジアム正式名称
const STADIUM_OFFICIAL_NAME_MAP = [
    ST_YANMAR => 'ヤンマースタジアム長居',
    ST_YODOKO => 'ヨドコウ桜スタジアム',
    ST_ALWIN => 'サンプロ アルウィン',
    ST_YURTEC => 'ユアテックスタジアム仙台',
    ST_TODOROKI => '等々力陸上競技場',
    ST_EDION => 'エディオンスタジアム広島',
    ST_EKIMAE => '駅前不動産スタジアム     ',
    ST_KASHIMA => '県立カシマサッカースタジアム',
    ST_YAMAHA => 'ヤマハスタジアム',
    ST_PANASONIC => 'パナソニック スタジアム 吹田',
    // ST_BMW => 'Shonan BMW スタジアム平塚',
    ST_LEMON => 'レモンガススタジアム平塚',
    ST_NISSAN => '日産スタジアム',
    ST_URAWA => '浦和駒場スタジアム',
    ST_IAI => 'IAIスタジアム日本平',
    ST_PALOMA => 'パロマ瑞穂スタジアム',
    ST_NOEVIR => 'ノエビアスタジアム神戸',
    ST_SAITAMA => '埼玉スタジアム2002',
    ST_SYOWA => '昭和電工ドーム大分',
    ST_SAPPORO => '札幌ドーム',
    ST_AJINOMOTO => '味の素スタジアム',
    ST_TOYOTA => '豊田スタジアム',
    ST_ECOPA => 'エコパスタジアム',
    ST_NIPPATSU => 'ニッパツ三ツ沢球技場',
    ST_ATSUBETSU => '札幌厚別公園競技場',
    ST_OITA => '大分市営陸上競技場',
    ST_SHIRANAMI => '白波スタジアム',
    ST_TOCHIGI => '栃木県グリーンスタジアム',
    ST_KANSEKI => 'カンセキスタジアムとちぎ',
    ST_NACK => 'NACK５スタジアム大宮',
    ST_MACHIDAGION => '町田GIONスタジアム',
    ST_NAGARAGAWA => '岐阜メモリアルセンター長良川競技場',
    ST_TAKEBISHI => 'たけびしスタジアム京都',
    ST_CITY => 'シティライトスタジアム',
    ST_TRANS => 'トランスコスモススタジアム長崎',
    ST_MIRAI => '維新みらいふスタジアム',
    ST_NINGINEER => 'ニンジニアスタジアム',
    ST_TAPIC => 'タピック県総ひやごんスタジアム',
    ST_SANKYO => '三協フロンテア柏スタジアム',
    ST_HAKATA => '東平尾公園博多の森陸上競技場',
    ST_KSDENKI => 'ケーズデンキスタジアム水戸',
    ST_FUKUDA => 'フクダ電子アリーナ',
    ST_POCARI => 'ポカリスエットスタジアム',
    ST_DENKA => 'デンカビッグスワンスタジアム',
    ST_NDSOFT => 'NDソフトスタジアム山形',
    ST_CHUGIN => '山梨中銀スタジアム',
    ST_ISHIKAWA => '石川県西部緑地公園陸上競技場',
    ST_NISHIGAOKA => '味の素フィールド西が丘',
    ST_LEVEL5 => 'レベルファイブスタジアム',
    ST_BEST => 'ベスト電器スタジアム',
    ST_KOMAZAWA => '駒沢オリンピック公園総合運動場陸上競技場',
    ST_SHIMONOSEKI => '下関市営下関陸上競技場',
    ST_KUMAGAYA => '熊谷スポーツ文化公園陸上競技場',
    ST_FUJIEDA => '藤枝総合運動公園サッカー場',
    ST_GION => '相模原ギオンスタジアム',
    ST_PIKARA => 'Pikaraスタジアム',
    ST_EGAO => 'えがお健康スタジアム',
    ST_MIKUNI => 'ミクニワールドスタジアム北九州',
    ST_SHODA => '正田醤油スタジアム群馬',
    ST_NAGANOU => '長野Uスタジアム',
    ST_ASHITAKA => '愛鷹広域公園多目的競技場',
    ST_TORIGIN => 'とりぎんバードスタジアム',
    ST_TOYAMA => '富山県総合運動公園陸上競技場',
    ST_DAIHATSU => 'ダイハツスタジアム',
    ST_IWAGIN => 'いわぎんスタジアム',
    ST_TOHO => 'とうほう・みんなのスタジアム',
    ST_SOYU => 'ソユースタジアム',
    ST_CHUBU => 'チュウブYAJINスタジアム',
    ST_BANPAKU => '万博記念競技場',
    ST_AIZU => '会津総合運動公園あいづ陸上競技場',
    ST_JVILLAGE => 'Jヴィレッジスタジアム',
    ST_KITAKAMI => '北上総合運動公園北上陸上競技場',
    ST_IKIMENOMORI => '宮崎市生目の杜運動公園陸上競技場',
    ST_YUMENOSHIMA => '江東区夢の島競技場',
    ST_SUIZENJI => '熊本市水前寺競技場',
    ST_MITSUZAWA => '横浜市三ツ沢公園陸上競技場',
    ST_YUME => 'ありがとうサービス．夢スタジアム',
    ST_HUKUI => 'テクノポート福井スタジアム',
    ST_PRIFOODS => 'プライフーズスタジアム',
    ST_SANGA => 'サンガスタジアム',
    ST_KORIYAMA => '郡山西部サッカー場',
    ST_KOKURITSU => '国立競技場',
    ST_UNIVER => '神戸総合運動公園ユニバー記念競技場',
    ST_HUKUYAMA => '福山市竹ヶ端運動公園陸上競技場',
    ST_COCA => 'コカ・コーラボトラーズジャパン広島スタジアム',
    ST_TAKAOKA => '高岡スポーツコア サッカー・ラグビー場',
    ST_MEADOW => '岐阜メモリアルセンター長良川球技メドウ',
    ST_NARADEN => 'ならでんフィールド',
    ST_KAKIDOMARI => '長崎市総合運動公園かきどまり陸上競技場',
    ST_SANKO => '三重交通G スポーツの杜 鈴鹿',
    ST_SAKU => '佐久総合運動公園陸上競技場',
    ST_HIGASHIOMI => '東近江市布引運動公園陸上競技場',
    ST_SHIKISHIMA => '群馬県立敷島公園県営サッカー・ラグビー場',
    ST_KIMIIDERA => '和歌山県立紀三井寺公園陸上競技場',
    ST_SHIMANE => '島根県立サッカー場',
    ST_NOBEOKA => '延岡市西階総合運動公園陸上競技場',
    ST_CHICHIBU => '秩父宮ラグビー場',
    ST_AXIS => 'Ａｘｉｓバードスタジアム',
    ST_YUNISUTA => 'ユニリーバスタジアム新富',
    ST_SVSHIMO => 'セービング陸上競技場',
    // UNKNOWN
    MITEI => MITEI,
];
