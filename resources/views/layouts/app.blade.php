<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Rise||Admin</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Rise of Bengal Tiger" name="description" />
        <meta content="Spellbound" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        @include('layouts.css')
        <style>
            table.dataTable.nowrap th, table.dataTable.nowrap td {
                white-space: normal !important;
            }
            .action{
                width:100px;
                
            }
            .action a{
                margin-bottom: 3px;
            }
            
            td ul li{
                list-style-type:disc;
                margin-left:25px;
            }
            [type=button], [type=reset], [type=submit], button {
                color : black !important;
            }
            .btn-close{
                color : white !important;
            }
        </style>
    </head>
    <!-- body start -->
    <body>
        <!-- Begin page -->
        <div id="wrapper">
            @include('layouts.topbar')
            @include('layouts.sidebar-left')
            <div class="content-page">
                <div class="notification">
                    @include('notify::components.notify')
                </div>
                <div class="content">
                    <div class="container-fluid">
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.footer')
        @include('layouts.js')
    </body>
</html>