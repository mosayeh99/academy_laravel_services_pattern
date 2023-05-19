<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title>@yield('title')</title>
    <!-- CSS files -->
    <base href="/">
    @notifyCss
    <link rel="shortcut icon" href="{{asset('assets/static/favicon.png')}}" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;500;600;700;800;900;1000&display=swap" rel="stylesheet">
    <link href="{{asset('assets/dist/css/bootstrap.min.css')}}" rel="stylesheet"/>
    <link href="{{asset('assets/dist/css/demo.min.css')}}" rel="stylesheet"/>
    @yield('stylesheets')
    <style>
        body {
            font-family: 'Cairo', sans-serif;
            overflow-y: auto;
        }
    </style>
</head>
