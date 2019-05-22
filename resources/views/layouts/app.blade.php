<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script type="text/javascript" src="{{ asset('js/datatables.min.js') }}"></script>

    <script>
    $(document).ready( function () {
        $('#dataTables').DataTable( {
            dom: 'Bfrtip',
            lengthMenu: [
                [ 10, 25, 50, -1 ],
                [ '10 rows', '25 rows', '50 rows', 'Show all' ]
            ],
            buttons: [
                'pageLength',
                {
                extend: 'pdfHtml5',
                text: 'Export All as PDF',
                exportOptions: {
                    modifier: {
                        selected: null
                    },
                    columns: [ 0, 1, 2, 3, 4, 5, 6 ]
                },
                download: 'open'
                },
                {
                extend: 'pdfHtml5',
                text: 'Export Selected Row/s as PDF',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5, 6 ]
                },
                download: 'open'
                }
            ],
            select: true
        });

        $('#activeForms').DataTable( {
            "ordering": false,
            "lengthChange": false
        });
    });
    </script>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/datatables.min.css"/>
 
    <!--Additional view css-->
    @yield('head')
</head>
<body class="d-flex flex-column">
    <main class="flex-shrink-0" role="main">
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
