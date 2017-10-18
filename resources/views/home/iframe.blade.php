@extends('layout.iframe')

@section('author', $form['owner'])
@section('description', $form['title'])

@section('meta')
<meta property="og:title" content="Criar enquetes" />
<meta property="og:description" content="{{ $form['title'] }}" />
@endsection

@section('content')
<form action="{{ route('send', ['id' => $form['id']]) }}" method="POST">
    {{ csrf_field() }}

    <h1>{{ $form['title'] }}</h1>
    <small class="danger">{{ $errors->first() }}</small>

    @foreach(\json_decode($form['options']) as $id => $option)
    <div class="radio">
        <label>
            <input type="radio" name="option" value="{{ $id }}"> {{ $option }}
        </label>
    </div>
    @endforeach

    <button type="submit" class="btn btn-default btn-block pull-right">Enviar</button>
</form><!-- /container -->
@endsection