<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" href="/favicon.ico">

        <title>{{ \config('app.name') }}</title>

        <link href="{{ \asset('css/app.css') }}" rel="stylesheet">
        @yield('styles')
    </head>

    <body>

        <div class="container">
            <div class="header clearfix">
                <nav>
                    <ul class="nav nav-pills pull-right">
                        <li role="presentation" class="active"><a href="#">Home</a></li>
                        <li role="presentation"><a href="#">About</a></li>
                        <li role="presentation"><a href="#">Contact</a></li>
                    </ul>
                </nav>
                <h3 class="text-muted">{{ \config('app.name') }}</h3>
            </div>

            @yield('content')

            <footer class="footer">
                <hr>
                <p class="text-center">&copy; TL 2017</p>
            </footer>

        </div> <!-- /container -->

        <script src="{{ asset('js/app.js') }}"></script>
        @yield('scripts')

    </body>
</html>
