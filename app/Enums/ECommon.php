<?php

namespace App\Enums;

class ECommon {

    public static function getListData()
    {
        return [
            // Giới tính
            1 => [
                1 => 'Nam',
                2 => 'Nữ',
                3 => 'Khác',
            ],

            // Tình trạng hôn nhân
            2 => [
                1 => 'Chưa kết hôn',
                2 => 'Đã kết hôn',
                3 => 'Đã ly hôn',
            ],

            // Trạng thái
            3 => [
                1 => 'Hoạt động',
                2 => 'Không hoạt động',
            ],
        ];
    }

    public static function codeToValue($key1, $key2)
    {
        $data = static::getListData();
        return $data[$key1][$key2] ?? '';
    }
}