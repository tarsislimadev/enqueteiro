@extends('layout.default')

@section('meta')
<meta property="og:title" content="{{ \config('app.name') }}" />
<meta property="og:description" content="{{ $form['title'] }}" />
@endsection

@section('content')
<form action="{{ route('send', ['hash' => $form['hash'], 'iframe' => $iframe]) }}" method="POST">
    {{ csrf_field() }}

    <h1>{{ $form['title'] }}</h1>
    <small class="danger">{{ $errors->first() }}</small>

    @foreach(\json_decode($form['answers']) as $id => $answer)
    <div class="radio">
        <label>
            <input type="radio" name="answer" value="{{ $id }}"> {{ $answer }}
        </label>
    </div>
    @endforeach

    <button type="submit" class="btn btn-default btn-block pull-right">Enviar</button>
</form><!-- /container -->
@endsection