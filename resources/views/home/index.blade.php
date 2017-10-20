@extends('layout.default')

@section('meta')
<meta property="og:title" content="{{ \config('app.name') }}" />
<meta property="og:description" content="Crie suas enquetes de maneira rápida e prática." />
@endsection

@section('content')
<div class="jumbotron text-center">
    <h1>Crie suas enquetes</h1>
    <p class="lead">de maneira rápida e prática.</p>
    <p><a class="btn btn-lg btn-primary" href="{{ route('create') }}" role="button">Vamos lá!</a></p>
</div>

<div class="row marketing">
    @foreach($forms->chunk(4) as $line)
    <div class="col-lg-4">
        @foreach($line as $form)
        <h4>{{ $form['title'] }}</h4>
        <p><a href="{{ route('form', ['hash' => $form['hash']]) }}">responder</a></p>

        @endforeach
    </div>
    @endforeach
</div>
@endsection