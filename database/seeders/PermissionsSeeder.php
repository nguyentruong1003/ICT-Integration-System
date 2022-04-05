<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // DB::table('permissions')->truncate();
        $prefix = config('common.permission.prefix');
        $urls = [];
        foreach (\Route::getRoutes() as $value) {
            if (strpos($value->getName(), '.index') !== false) {
                $urls[] = $value->getName();
            }
        }

        $arrAction = ['index', 'show', 'create', 'edit', 'delete', 'download'];
        if (!empty($urls)) {
            foreach ($urls as $url) {
                foreach ($arrAction as $action) {
                    $name = str_replace('index', '', $url . $prefix) . $action;
                    Permission::updateOrCreate([
                        'name' => trim($name, '.'),
                        'guard_name' => 'web',
                    ]);
                }
            }
        }
    }
}
