<?php

namespace App\Http\Controllers\Admin\Config;
use App\Http\Controllers\Controller;

class MasterDataController extends Controller
{
    public function index()
    {
        return view('admin.config.master-data.index');
    }
}
