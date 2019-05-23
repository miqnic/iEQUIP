<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    {{-- <script type="text/javascript" src="{{ asset('js/datatables.min.js') }}"></script> --}}
    <script type="text/javascript" src="{{ asset('js/pdfmake.min.js')}}"></script>
    <script type="text/javascript" src="{{ asset('js/vfs_fonts.js')}}"></script>
    <script type="text/javascript" src="{{ asset('js/jquery.dataTables.min.js')}}"></script>
    <script type="text/javascript" src="{{ asset('js/dataTables.bootstrap4.min.js')}}"></script>
    <script type="text/javascript" src="{{ asset('js/dataTables.editor.min.js')}}"></script>
    <script type="text/javascript" src="{{ asset('js/editor.bootstrap4.min.js')}}"></script>
    <script type="text/javascript" src="{{ asset('js/dataTables.buttons.min.js')}}"></script>
    <script type="text/javascript" src="{{ asset('js/buttons.bootstrap4.min.js')}}"></script>
    <script type="text/javascript" src="{{ asset('js/buttons.html5.min.js')}}"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    {{-- <link rel="stylesheet" type="text/css" href="css/datatables.min.css"/> --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('css/dataTables.bootstrap4.min.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/editor.bootstrap4.min.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/buttons.bootstrap4.min.css')}}"/>

    <!--Additional view css-->
    @yield('head')
</head>
<body>
    <main>
        @yield('navi')
        <div class="container inside pt-2">
        @include('inc.messages')
        @yield('content')
        </div>
        <footer class="footer bg-dark">
            <div class="container text-light pt-3">
                <span>&copy; 2019 iACADEMY | All rights reserved.</span>
                <span class="float-right">
                    <i class="fas fa-envelope"></i> facilities@iacademy.edu.ph
                    &nbsp;
                    <i class="fas fa-phone"></i> 889 5555 ext. 2234 - 2235
                </span>
            </div>
        </footer>
    </main>
    @yield('modal')
</body>
</html>
