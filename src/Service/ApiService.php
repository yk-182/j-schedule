<?php

namespace Gcal\Register\Service;

class ApiService extends BaseService
{
    public function __construct($ci)
    {
        parent::__construct($ci);
    }

    /**
     * WebAPIを実行する
     *
     * @param string $method
     * @param array $params
     * @return array
     */
    public function executeApi(string $method, array $params): array
    {
        $result = null;
        // 実行メソッド判別
        if ($method === URL_API) {
            $result = $this->fetchCalendarUrl($params);
        }
        return $result;
    }

    private function fetchCalendarUrl(array $params): array
    {
        $club = $params['club'];
        // 対象クラブの公開カレンダーURLを設定
        $result = ['url' => PUBLIC_CALENDAR_URL_MAP[$club]];
        return $result;
    }
}
