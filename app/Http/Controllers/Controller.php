<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;


abstract class Controller
{
    protected $pageData;
    public function __construct()
    {
        // $this->middleware('Client')->except('logout');
        $this->pageData = [
            'page_title' => 'What Public See',
            'page_url' => base_url('login-url'),
            'custom_date_format' => "ddd, DD MMM YYYY, h:mm:ss A",

        ];
        Session::put('page', $this->pageData);
    }


    ///////////////////////////// QUOTE GETTER ////////////////////////////
    public function getQuote()
    {
        $quote = trim(strip_tags(Inspiring::quote()));
        $quote = htmlspecialchars_decode($quote, ENT_QUOTES);
        $lastHyphenPos = strrpos($quote, '—');
        if ($lastHyphenPos !== false) {
            $text = trim(substr($quote, 0, $lastHyphenPos));
            $author = trim(substr(utf8_decode($quote), $lastHyphenPos - 2));
        } else {
            $text = $quote;
            $author = '';
        }
        return [
            'text' => $text,
            'author' => $author
        ];
        // Note (in the view):<div><p><strong>{{ $quote['text'] }}</strong><span style="color: gray;"> {{ '  —' . $quote['author'] }}</span></p></div>
    }



    ///////////////////////////// PAGE SETTER ////////////////////////////
    public function setPageSession($pageTitle, $pageUrl)
    {
        $pageData = Session::get('page');
        $pageData['page_title'] = $pageTitle;
        $pageData['page_url'] = $pageUrl;

        // Store the updated array back in the session
        Session::put('page', $pageData);
        return true;
    }


    public function setReturnView($viewurl, $loadDatasFromDB = [])
    {
        $pageData = Session::get('page');
        $mergedData = array_merge($loadDatasFromDB, ['pageData' => $pageData]);
        return view($viewurl, $mergedData);
    }
}
