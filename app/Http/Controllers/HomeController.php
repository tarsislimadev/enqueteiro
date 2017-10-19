<?php

namespace App\Http\Controllers;

class HomeController extends Controller {

    public function index() {
        $forms = \App\Form::query()->skip(0)->take(24)->orderBy('id', 'desc')->get();
        
        return view('home.index')->with(\compact('forms'));
    }
    
    public function about() {
        return view('home.about');
    }

}
