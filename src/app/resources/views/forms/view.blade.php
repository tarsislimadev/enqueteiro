@extends('layout.default')

@section('meta')
<meta property="og:title" content="{{ \config('app.name') }}" />
<meta property="og:description" content="{{ $form['title'] }}" />
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <h1>{{ $form['title'] }}</h1>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <h2>Respostas</h2>
        <ul>
        @foreach($answers as $answer)
            <li>{{ \json_decode($form->answers, true)[$answer->answer] }} - {{ $answer->sum }} voto{{ $answer->sum < 2 ? '' : 's' }}</li>
        @endforeach
        </ul>
    </div>
    <div class="col-md-6" id="share">
        <h2>Compartilhar</h2>
        <label>Script</label>
        <p class="script-box">
            &lt;iframe src="{{ route('iframe', ['hash' => $form['hash']]) }}" width="360" height="480" frameBorder="0" style="border: 1px solid #000; border-radius:  5px"&gt;&lt;/iframe&gt;
        </p>

        <label>Link</label>
        <p class="script-box">{{ route('form', ['hash' => $form['hash']]) }}</p>
    </div>
</div>
@endsection