<?php

namespace App\Http\Controllers;

class HomeController extends Controller {

    public function index() {
        $forms = \App\Form::query()->skip(0)->take(24)->orderBy('id', 'desc')->get();
        
        return view('home.index')->with(\compact('forms'));
    }
    
    public function create() {
        $form = new \App\Form([
            'title' => 'Enquete', 
            'options' => \json_encode(['Opção 1', 'Opção 2']),
            'hash' => \App\Utils\Str::unique(),
        ]);
        
        $form->save();
        
        return \view('home.create')->with('form', $form->toArray());
    }
    
    public function save() {
        $form = \App\Form::query()->where('hash', \request('hash'))->first();
        $form->title = \request('title');
        $form->options = \json_encode(\request('options'));
        $form->owner = \request('owner');
        
        $form->save();
    }
    
    public function iframe ($hash) {
        $form = \App\Form::query()->where('hash', $hash)->first();
        
        return \view('home.iframe')->with('form', $form->toArray());
    }
    
    public function send($hash) {
        $option = \request('option');
        
        if ($option == null || $option == '') {
            return \redirect()->back()->withErrors([
                'error' => 'Selecione uma opção.'
            ]);
        }

        $form = \App\Form::query()->where('hash', $hash)->first();
        
        $answer = new \App\Answer();
        
        $answer->form_id = $form->id;
        $answer->option = $option;
        $answer->ip = \request()->ip();
        
        $answer->save();
        
        return view('home.answered')->with([
            'title' => 'Enviado', 
            'message' => 'Obrigado por responder a essa enquete.'
        ]);
    }
    
    public function about() {
        return view('home.about');
    }

}
