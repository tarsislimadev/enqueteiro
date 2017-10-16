<?php

namespace App\Http\Controllers;

class HomeController extends Controller {

    public function index() {
        return view('home.index');
    }
    
    public function create() {
        $form = new \App\Form([
            'title' => 'Enquete', 
            'options' => \json_encode(['Opção 1', 'Opção 2'])
        ]);
        
        $form->save();
        
        return \view('home.create')->with('form', $form->toArray());
    }
    
    public function save() {
        $form = \App\Form::query()->where('id', \request('id'))->first();
        $form->title = \request('title');
        $form->title = \json_encode(\request('options'));
        $form->owner = \request('owner');
        
        if ($form->save()) {
            return view('home.saved');
        }
        
        return 'Erro!';
    }
    
    public function iframe () {
        $id = \request('id');
        $form = \App\Form::query()->where('id', $id)->first();
        
        return \view('home.iframe')->with('form', $form->toArray());
    }
    
    public function send() {
        return \redirect()->back()->withErrors([
            'error' => 'Erro!'
        ]);
    }

}
