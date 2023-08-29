<?php

namespace Gcal\Register\Service;

use GuzzleHttp\Client as Client;
use GuzzleHttp\Exception\BadResponseException;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\RequestOptions;

class SlackApiService extends BaseService
{

    public function __construct($ci)
    {
        parent::__construct($ci);
    }

    /**
     * Slackに通知する
     *
     * @param string $msg
     * @return void
     * @throws GuzzleException
     */
    public function postSlackMsg(string $msg): void
    {
        $payload = [
            'channel' => SLACK_CHANNEL,
            'text' => $msg,
            'charset' => 'utf-8',
        ];
        try {
            $client = new Client([
                'timeout' => 3.0,
                RequestOptions::VERIFY => false,
            ]);
            $response = $client->request('POST', SLACK_API_URL, [
                'headers' => [
                    'Content-Type' => 'application/json; charset=UTF-8',
                    'Authorization' => 'Bearer ' . SLACK_TOKEN,
                ],
                'body' => \GuzzleHttp\json_encode($payload, JSON_UNESCAPED_UNICODE),
            ]);

            // 連想配列で取得（getContentsにtrueの引数で文字列として取得する）
            $response_map = \GuzzleHttp\json_decode($response->getBody()->getContents(), true);
            if($response_map['ok'] === true) {
                $this->logger->info('Posting message to Slack was success!!');
            } else {
                $this->logger->info('Posting message to Slack was failed... [message] '. $response_map['error']);
            }

        } catch (BadResponseException | RequestException $e) {
            $response = $e->getResponse();
            $this->logger->info('Posting message to Slack was failed... [statusCode] ' .
                $response->getStatusCode() . ' [message] ' . $response->getReasonPhrase());
        }
    }
}
