<?php
namespace  App\Http\Controllers;

use App\Country;

class HomeController extends Controller {
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function index(){
        $l = Country::all();
        var_dump($l);
        return view('home');
    }
}