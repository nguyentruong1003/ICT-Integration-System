<?php

namespace App\Enums;

class EMasterData {
    const TYPE_POSITION = 1;
    const TYPE_ETHNIC = 2;
    const TYPE_RELIGION = 3;
    const TYPE_NATIONALITY = 4;
    const TYPE_WORKING_ADDRESS = 5;

    public static function getListData()
    {
        return [
            1 => __('data_field_name.master-data.type_list.position'),
            2 => __('data_field_name.master-data.type_list.ethnic'),
            3 => __('data_field_name.master-data.type_list.religion'),
            4 => __('data_field_name.master-data.type_list.nation'),
            5 => __('data_field_name.master-data.type_list.work_place'),
        ];
    }

    public static function typeToName($key)
    {
        $data = static::getListData();
        return $data[$key] ?? '';
    }
}