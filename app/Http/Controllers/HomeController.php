<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jobs\ProcessParsing;
use Illuminate\Support\Facades\Http;
use Goutte\Client;

class HomeController extends Controller
{
    public function index()
    {
        return view('welcome');
    }

    public function getUrl(Request $request)
    {
        $request->validate([
            'url' => 'required|url'
        ]);

        ProcessParsing::dispatch($request->url);

        return redirect()->route('home');
    }
}
