<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller {

    public function index(Request $request) {
        dd($request);
    }
    public function postMethod(Request $request) {
        dd($request);
    }
    public function getMethod(Request $request) {
        dd($request);
    }

}