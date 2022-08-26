<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Smart Health') }}</title>
    <!-- Favicon-->
    <link rel="icon" href="{{ asset('img/logoPT.png') }}" type="image/x-icon">

    <!-- Fonts -->
    {{--
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    --}}

    <!-- Styles -->
    <style>
        html,
        body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Comfortaa', sans-serif;
            font-weight: 200;
            height: 100vh;
            margin: 0;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 70px;
        }

        .title2 {
            font-size: 65px;
        }

        .links>a {
            color: #636b6f;
            padding: 0 7px;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;
        }

    </style>
    @if (app()->getLocale() == 'ar')
        <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@300&display=swap" rel="stylesheet">
        <style>
            html,
            body,
            div,
            span,
            h1,
            h2,
            h3,
            h4,
            h5,
            h6,
            p {
                font-family: 'Tajawal', "Comfortaa" !important;
            }

        </style>
    @endif
</head>

<body>
    <div class="flex-center position-ref full-height">
        @if (Route::has('login'))
            <div class="top-right links">
                @auth
                    <a href="{{ route('home') }}">{{ __('lang.dashboard') }}</a>
                    <a href="{{ route('setlocale', 'en') }}"><img src="{{ asset('img/us-flag.png') }}" width="20px" /></a>
                    <a href="{{ route('setlocale', 'ar') }}"><img src="{{ asset('img/ksa-flag.png') }}" width="20px" /></a>
                @else
                    <a href="{{ route('login') }}">{{ __('lang.login') }}</a>
                    <a href="{{ route('setlocale', 'en') }}"><img src="{{ asset('img/us-flag.png') }}" width="20px" /></a>
                    <a href="{{ route('setlocale', 'ar') }}"><img src="{{ asset('img/ksa-flag.png') }}" width="20px" /></a>

                    {{-- @if (Route::has('register'))
                        <a href="{{ route('register') }}">{{ __('lang.register') }}</a>
                    @endif --}}
                @endauth
            </div>
        @endif

        <div class="content">
            <img src="{{ asset('img/logoPT.png') }}" width="200px" />
            <div class="title m-b-md">
                {{ __('lang.pandemic-tracker-intro') }}
                <br />
                {{--  <span class="title2 m-b-md">
                    {{ __('lang.covid-tracker') }}
                </span>  --}}
            </div>

            <div class="links">
                <a href="https://www.youtube.com/channel/UCpGlRB6m-B7SOOTqy3SpAIQ">Smart Health Youtube Channel</a>
            </div>
        </div>
    </div>
</body>

</html>
