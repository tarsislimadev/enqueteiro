<?php

namespace App\Http\Controllers;

class HomeController extends Controller {

    public function index() {
        $oneHourAgo = \Carbon\Carbon::now()->subHour();
        $forms = \App\Form::query()
            ->skip(0)
            ->take(12)
            ->where('updated_at', '<', $oneHourAgo)
            ->orderBy('id', 'desc')
            ->get();

        return view('home.index')->with(\compact('forms'));
    }

    public function about() {
        return view('home.about');
    }

    public function clear() {
        $_30minutesAgo = \Carbon\Carbon::now()->subMinute(30);

        \App\Form::query()
            ->where('title', 'Enquete')
            ->where('created_at', '<', $_30minutesAgo)
            ->whereRaw('forms.created_at = forms.updated_at')
            ->delete();
    }

}
