<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <style>
        body{
        /* Safari 4-5, Chrome 1-9 */
            background: -webkit-gradient(radial, center center, 0, center center, 460, from(#1a82f7), to(#2F2727));

        /* Safari 5.1+, Chrome 10+ */
            background: -webkit-radial-gradient(circle, #1a82f7, #2F2727);

        /* Firefox 3.6+ */
            background: -moz-radial-gradient(circle, #1a82f7, #2F2727);

        /* IE 10 */
            background: -ms-radial-gradient(circle, #1a82f7, #2F2727);
            height:600px;
        }

    #l1{border:1px solid #f1c40f;}
    #l2{border:1px solid #2ecc71;}
    #l3{border:1px solid #3498db;}        
    #l4{border:1px solid #f39c12;}
    #l5{border:1px solid #c0392b;}

    #l1after{
        border:1px solid #f1c40f;
        background-color: #aaaaaa;
    }
    .important{
        transition: background-color 1s;
        padding:5px;
        cursor:pointer;
        margin:5px;
    }
    .btn-urgency{
        padding: 15px 25px 15px 25px !important;
    }

    .btn-urgency:hover{
        box-shadow: inset 0 0 0 5px #53a7ea;
    }
    </style>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'TODO') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    {{--  <link rel="icon" type="image/x-icon" href="/favicon.ico">  --}}
    
</head>
<body>
    <div id="app" >
        @include('layouts.navbar')
        <div class="container">
            @include('layouts.messages')
        </div>

        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>

</html>
