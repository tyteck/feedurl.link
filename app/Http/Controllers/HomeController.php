<?php

namespace App\Http\Controllers;

use App\Http\Requests\UrlRequest;
use App\Modules\ItunesFeed;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $itunesUrl = $feedUrl = null;
        if (session('itunesUrl')!== null) {
            $itunesUrl = session('itunesUrl');
            $feedUrl = session('feedUrl');
        }

        return View::make("home", compact('itunesUrl', 'feedUrl'));
    }

    public function getFeed(UrlRequest $request)
    {
        $url = $request->validated()['url'];
        try {
            $feedUrl = ItunesFeed::getFeedFrom($url);
        } catch (Exception $exception) {
            return redirect()->back()->withErrors($exception->getMessage());
        }
        session(['itunesUrl' => $url, 'feedUrl' => $feedUrl]);
        return redirect()->route('home');
    }
}
