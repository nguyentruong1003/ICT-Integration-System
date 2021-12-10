<?php

namespace App\Http\Controllers\Admin\Config;
use App\Http\Controllers\Controller;

class MasterController extends Controller
{
    public function index()
    {
        return view('admin.master.index');
    }
}
