@extends($iframe ? 'layout.iframe' : 'layout.default');

@section('content')
<h1>{{ $title }}</h1>
<p>{{ $message }}</p>
@endsection