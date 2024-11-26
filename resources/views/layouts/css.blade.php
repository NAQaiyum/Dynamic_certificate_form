<!-- App favicon -->
<link rel="shortcut icon" href="{{ asset(SiteSetting() ? SiteSetting()->icon : 'assets/images/favicon.ico') }}">

<!-- plugin css -->
<link href="{{ asset('assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.css') }}" rel="stylesheet" type="text/css" />

<!-- App css -->
<link href="{{ asset('assets/css/config/modern/bootstrap.min.css') }}" rel="stylesheet" type="text/css" id="bs-default-stylesheet" />
<link href="{{ asset('assets/css/config/modern/app.min.css') }}" rel="stylesheet" type="text/css" id="app-default-stylesheet" />

<link href="{{ asset('assets/css/config/modern/bootstrap-dark.min.css') }}" rel="stylesheet" type="text/css" id="bs-dark-stylesheet" />
<link href="{{ asset('assets/css/config/modern/app-dark.min.css') }}" rel="stylesheet" type="text/css" id="app-dark-stylesheet" />

<!-- icons -->
<link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />

@yield('css')
@notifyCss
<style>
    .fixed{
        z-index: 9999999;
    }
    .audio, canvas, embed, iframe, img, object, svg, video{
        display: initial !important;
    }
    .img, video{
        height:1 !important;
    }
    .p-4 {
        padding: 1rem !important;
    }
    .modal-header{
        background-color:#454e58;
    }
    .modal-header h4{
        color:{{ SiteSetting() ? 'white' : 'gray'}};
    }
    .modal-footer{
        background-color:whitesmoke;
    }
    [type=button], [type=reset], [type=submit], button {
        color : black !important;
    }
</style>
<style>
    .ck-rounded-corners .ck.ck-balloon-panel, .ck.ck-balloon-panel.ck-rounded-corners {
        z-index: 10055 !important;
    }
    .ck-balloon-panel_visible{
        z-index: 99999999 !important;
        top: 100px !important;
        left: 50% !important;
    }
    /* .image-inline{
        width: 50%;
        float : left
    } */
    
</style>