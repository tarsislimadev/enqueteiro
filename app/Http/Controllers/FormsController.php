<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FormsController extends Controller
{

    public function create()
    {
        $form = new \App\Form([
            'title' => 'Enquete',
            'options' => \json_encode(['Opção 1', 'Opção 2']),
            'hash' => \App\Utils\Str::unique(),
        ]);

        $form->save();

        return \view('forms.create')->with('form', $form->toArray());
    }

    public function save()
    {
        $form          = \App\Form::query()->where('hash', \request('hash'))->first();
        $form->title   = \request('title');
        $form->options = \json_encode(\request('options'));
        $form->owner   = \request('owner');

        $form->save();
    }

    public function form($hash)
    {
        $form = \App\Form::query()->where('hash', $hash)->first();

        return \view('forms.form')->with('form', $form->toArray())->with('iframe', false);
    }

    public function iframe($hash)
    {
        $form = \App\Form::query()->where('hash', $hash)->first();

        return \view('forms.iframe')->with('form', $form->toArray())->with('iframe', true);
    }

    public function send($hash)
    {
        $option = \request('option');
        $iframe = \request('iframe');

        if ($option == null || $option == '') {
            return \redirect()->back()->withErrors([
                    'error' => 'Selecione uma opção.'
            ]);
        }

        $form = \App\Form::query()->where('hash', $hash)->first();

        $answer = new \App\Answer();

        $answer->form_id = $form->id;
        $answer->option  = $option;
        $answer->ip      = \request()->ip();

        $answer->save();

        return view('forms.answered')->with([
                'title' => 'Enviado',
                'message' => 'Obrigado por responder a essa enquete.',
                'iframe' => $iframe,
        ]);
    }
}