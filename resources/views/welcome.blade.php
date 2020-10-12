<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
    
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>iDiary</title>

        <link type="text/css" rel="stylesheet" href="./css/blog.css" />
        <link type="text/css" rel="stylesheet" href="./css/nav.css" />
        <link type="text/css" rel="stylesheet" href="./css/common.css" />
        <link type="text/css" rel="stylesheet" href="./css/login.css" />

        <link type="text/css" rel="stylesheet" href="//unpkg.com/bootstrap/dist/css/bootstrap.min.css" />
        <link type="text/css" rel="stylesheet" href="//unpkg.com/bootstrap-vue@latest/dist/bootstrap-vue.min.css" />

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Delius&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Kaushan+Script&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500&display=swap" rel="stylesheet">        
        <!-- Load polyfills to support older browsers -->
        <script src="//polyfill.io/v3/polyfill.min.js?features=es2015%2CIntersectionObserver" crossorigin="anonymous"></script>

        <!-- Load Vue followed by BootstrapVue -->
        <script src="//unpkg.com/vue@latest/dist/vue.min.js"></script>
        <script src="//unpkg.com/bootstrap-vue@latest/dist/bootstrap-vue.min.js"></script>

        <!-- Load the following for BootstrapVueIcons support -->
        <script src="//unpkg.com/bootstrap-vue@latest/dist/bootstrap-vue-icons.min.js"></script>

        <script>

            (function () {
                window.Laravel = {
                    csrfToken: '{{ csrf_token() }}'
                };
            })();

        </script>

    </head>
    <body>
        <div id="app">
            @if(Auth::check())
            <main-page :user="{{Auth::user()}}"></main-page>
            @else
            <main-page :user="false"></main-page>
            @endif            
        </div>
    </body>

    <script src="{{mix('/js/app.js')}}"></script>
</html>
