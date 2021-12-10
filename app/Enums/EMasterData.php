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
            1 => 'Chức danh',
            2 => 'Dân tộc',
            3 => 'Tôn giáo',
            4 => 'Quốc tịch',
            5 => 'Địa chỉ làm việc',
        ];
    }

    public static function typeToName($key)
    {
        $data = static::getListData();
        return $data[$key] ?? '';
    }
}