<?php


namespace App\Enums;

class EMenu
{

    public static function listNameMenu()
    {
        return [
            'admin.system.user.index' => __('menu_name.system.user_mgr'),
            'admin.system.role.index' => __('menu_name.system.role_mgr'),
            'admin.system.audit.index' => __('menu_name.system.audit_list'),
            'admin.employee.index' => __('menu_name.hrm'),
            'admin.unit.index' => __('menu_name.unit_mgr'),
        ];
    }
}
