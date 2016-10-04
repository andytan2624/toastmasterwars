<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\User;
use \Symfony\Component\HttpFoundation\Response;

class SearchController extends Controller
{
    // From Scotch.io tutorials, https://scotch.io/tutorials/implementing-smart-search-with-laravel-and-typeahead-js
    public function findUser(Request $request)
    {
        $results = User::search($request->get('q'))->get(['id', 'first_name', 'last_name']);
        return response()->json($results);
    }
}
