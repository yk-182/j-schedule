<?php

namespace Gcal\Register\Service;

class IndexService extends BaseService
{

    public function __construct($ci)
    {
        parent::__construct($ci);
    }

    /**
     * 各カテゴリー毎の全クラブの配列を返却する
     *
     * @return array $club_array 各リーグ毎のクラブ名が定義された配列
     */
    public function fetchAllClubs(): array
    {
        // TODO 画面用のディビジョンごとのクラブ配列定数を作成する
        $club_array['j1'] = SELECTBOX_J1_CLUB;
        $club_array['j2'] = SELECTBOX_J2_CLUB;
        $club_array['j3'] = SELECTBOX_J3_CLUB;

        return $club_array;
    }
}
