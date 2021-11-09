<?php

namespace App\Http\Controllers\Admin\Config;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index() {
        return view('admin.config.notification.index');
    }

    public function publicConfig() {
        return view('admin.config.notification.public-config');
    }

    public function privateConfig() {
        return view('admin.config.notification.private-config');
    }
}
