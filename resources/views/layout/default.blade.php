<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <meta name="csrf-token" content="{{ csrf_token() }}" id="meta-csrf">
        @yield('meta')
        <link rel="icon" href="/favicon.ico">

        <title>{{ \config('app.name') }}</title>

        <link href="/css/app.css" rel="stylesheet">
        @yield('styles')
    </head>

    <body>

        <div class="container">
            <div class="header clearfix">
                <nav>
                    <ul class="nav nav-pills pull-right">
                        <li role="presentation"><a href="{{ route('create') }}">Criar Enquete</a></li>
                    </ul>
                </nav>
                <h3 class="text-muted"><a href="{{ route('home.index') }}">{{ \config('app.name') }}</a></h3>
            </div>

            @yield('content')

            <div class="row">
                <div class="col-md-3">
                    <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                    <!-- enqueteiro-01 -->
                    <ins class="adsbygoogle"
                         style="display:block"
                         data-ad-client="ca-pub-5531736754810756"
                         data-ad-slot="4142471053"
                         data-ad-format="auto"></ins>
                    <script>
                        (adsbygoogle = window.adsbygoogle || []).push({});
                    </script>
                </div>
                <div class="col-md-3">
                    <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                    <!-- enqueteiro-02 -->
                    <ins class="adsbygoogle"
                         style="display:block"
                         data-ad-client="ca-pub-5531736754810756"
                         data-ad-slot="7584211987"
                         data-ad-format="auto"></ins>
                    <script>
                        (adsbygoogle = window.adsbygoogle || []).push({});
                    </script>
                </div>
                <div class="col-md-3">
                    <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                    <!-- enqueteiro-03 -->
                    <ins class="adsbygoogle"
                         style="display:block"
                         data-ad-client="ca-pub-5531736754810756"
                         data-ad-slot="9522790243"
                         data-ad-format="auto"></ins>
                    <script>
                        (adsbygoogle = window.adsbygoogle || []).push({});
                    </script>
                </div>
                <div class="col-md-3">
                    <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                    <!-- enqueteiro-04 -->
                    <ins class="adsbygoogle"
                         style="display:block"
                         data-ad-client="ca-pub-5531736754810756"
                         data-ad-slot="4681527101"
                         data-ad-format="auto"></ins>
                    <script>
                        (adsbygoogle = window.adsbygoogle || []).push({});
                    </script>
                </div>
            </div>

            <footer class="footer">
                <br>
                <hr>
                <p class="text-center">&copy; TL 2017</p>
            </footer>

        </div> <!-- /container -->

        <script src="/js/app.js"></script>
        @yield('scripts')

    </body>
</html>
