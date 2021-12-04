<?php

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Auth;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $urls = [];
        foreach (\Route::getRoutes() as $value) {
            if (strpos($value->getName(), '.index') !== false) {
                $urls[] = $value->getName();
            }
        }

        if (!empty($urls)) {
            foreach ($urls as $url) {
                $menu = Menu::where('name', $url)->first();
                if(!$menu){
                    Menu::updateOrCreate([
                        'name' => $url,
                        'code' => $url,
                        'permission_name' => $url,
                        'admin_id' => Auth::id(),
                    ]);
                }


            }
        }
    }
}
