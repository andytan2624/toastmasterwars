<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\User;

class SearchController extends Controller
{
    public function find(Request $request)
    {
        return User::search($request->get('q'))->get();
    }
}
