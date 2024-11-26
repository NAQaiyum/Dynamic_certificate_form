<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>{{ SiteSetting() ? SiteSetting()->site_title : null }}</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="{{ SiteSetting() ? SiteSetting()->site_title : null }}" name="description" />
        <meta content="Optimum" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        @include('layouts.css')
        
    </head>
    <!-- body start -->
    <body class="loading" data-layout-mode="detached" data-layout='{"mode": "light", "width": "fluid", "menuPosition": "fixed", "sidebar": { "color": "light", "size": "default", "showuser": true}, "topbar": {"color": "dark"}, "showRightSidebarOnPageLoad": true}'>
        <!-- Begin page -->
        <div id="wrapper">
            <div class="" style="margin-top:20px;height:100%;">
                <div class="content">
                @yield('content')
                </div>
            </div>
        </div>
        @include('layouts.footer')
        @include('layouts.js')
    </body>
</html>