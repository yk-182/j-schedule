<?php
namespace Gcal\Register\Controller;

use Psr\Container\ContainerInterface;
use Slim\Http\Request;
use Slim\Http\Response;
use Gcal\Register\Service\IndexService;

Class IndexController extends BaseController
{
    protected $ci;

    public function __construct(ContainerInterface $ci)
    {
        $this->ci = $ci;
    }

    public function index(Request $request, Response $response)
    {
        $index_service = new IndexService($this->ci);
        // 各リーグ毎のクラブを取得
        $club_array = $index_service->fetchAllClubs();
        // Render index view
        return $this->ci->get('renderer')->render($response, 'index.phtml', ['club_array' => $club_array]);
    }
}
