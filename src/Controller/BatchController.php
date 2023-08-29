<?php

namespace Gcal\Register\Controller;

use Gcal\Register\Service\{CreateMatchDataService, SlackApiService};
use Slim\Http\Request;
use Slim\Http\Response;

Class BatchController extends BaseController
{

    /**
     * スクレイピングで取得した試合日程をGoogle Calendarに登録する
     *
     * @param Request $request
     * @param Response $response
     * @param $args URLパラメータ
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function createCalendar(Request $request, Response $response, $args): Response
    {
        $process_start_time = microtime(true);
        $slack_api_service = new SlackApiService($this->ci);
        $this->logger->info('J.League Match Calendar Batch Process Start!');
        try {
            $div = $args['div'];
            $year = $args['year'];

            // Jリーグ公式サイトからスクレイピング
            $service = new CreateMatchDataService($this->ci);
            $service->execute($div, $year);
            $status_code = HTTP_STATUS_OK;
            // Slackに正常終了の投稿
            // $slack_api_service->postSlackMsg(SLACK_NORMAL_POST_MSG);

        } catch (\Exception $e) {
            $this->logger->error('Batch Process have something failed...)');
            $status_code = HTTP_STATUS_INTERNAL_SERVER_ERROR;
            // Slackに異常終了の投稿
            $slack_api_service->postSlackMsg(SLACK_FAILED_POST_MSG);
        }

        // 処理時間
        $processing_time = microtime(true) - $process_start_time;
        $this->logger->info('J.League Match Calendar Batch Process End!' . ' processing time = ' . $processing_time . " Second");

        // Response Json
        $response_json = [
            'status' => $status_code,
            'processing time' => $processing_time,
            'date' => date("Y/m/d H:i:s")
        ];
        return $response->withJson($response_json, HTTP_STATUS_OK);
    }
}

/* メモ
// 画面遷移の方法
return $this->ci->get('renderer')->render($response, 'index.phtml', ['event' => $event]);
return $this->render($response, 'index.phtml', ['event' => $event]);

// 配列内容出力
echo "<pre>"; var_dump($match_schedule); echo "</pre>";
echo \GuzzleHttp\json_encode($match_list, JSON_UNESCAPED_UNICODE);
*/
