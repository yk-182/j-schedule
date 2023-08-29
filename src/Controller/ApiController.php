<?php

namespace Gcal\Register\Controller;

use Slim\Http\Request;
use Slim\Http\Response;
use Gcal\Register\Service\ApiService;

Class ApiController extends BaseController
{

    /**
     * WebAPIコントローラー
     *
     * @param Request $request
     * @param Response $response
     *
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function api(Request $request, Response $response): Response
    {
        $params = $request->getParsedBody();
        // URLから目的のAPIを取得
        $path = $request->getUri()->getPath();
        $path_arr = explode("/", $path); //分割処理
        $method = end($path_arr);

        $result = null;
        try {
            $service = new ApiService($this->ci);
            $result = $service->executeApi($method, $params);
            if(empty($result)) {
                throw new \Exception();
            }
            $status_code = HTTP_STATUS_OK;

        } catch (\Exception $e) {
            $this->logger->error('API Process have something failed...)');
            $status_code = HTTP_STATUS_INTERNAL_SERVER_ERROR;
        }
        return $response->withJson($result, $status_code);
    }
}
