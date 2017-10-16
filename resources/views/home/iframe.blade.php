<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="{{ $form['title'] }}">
        <meta name="author" content="{{ $form['owner'] }}">
        <link rel="icon" href="/favicon.ico">

        <title>{{ \config('app.name') }}</title>

        <link href="{{ \asset('css/app.css') }}" rel="stylesheet">
    </head>

    <body>

        <form class="container" action="{{ route('send', ['id' => $form['id']]) }}">
            <h1>{{ $form['title'] }}</h1>
            <small class="danger">{{ $errors->first() }}</small>
            
            @foreach(\json_decode($form['options']) as $id => $option)
            <div class="radio">
                <label>
                    <input type="radio" name="answer" value="{{ $id }}"> {{ $option }}
                </label>
            </div>            
            @endforeach
            
            <a class="btn btn-success pull-right">Enviar</a>
        </form><!-- /container -->

    </body>
</html>
