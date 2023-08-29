<?php

use Slim\App;

return function (App $app) {

    // シーズンカレンダー取得Batch
    $app->get('/jleague/match/{div}/{year}', 'Gcal\Register\Controller\BatchController:createCalendar');

    // カレンダー公開URL取得API
    $app->post('/jleague/calendar/{method}', 'Gcal\Register\Controller\ApiController:api');

    // ホーム画面
    $app->get('/', 'Gcal\Register\Controller\IndexController:index');
};
