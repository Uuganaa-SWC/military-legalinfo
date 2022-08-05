<!doctype html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Админ</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{url("photos/Soyombo.png")}}">
    <meta name="description" content="Sufee Admin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="apple-touch-icon" href="apple-icon.png">
    <link rel="shortcut icon" href="favicon.ico">
    <link rel="stylesheet" href="{{url("vendors/bootstrap/dist/css/bootstrap.min.css")}}">
    <link rel="stylesheet" href="{{url("vendors/font-awesome/css/font-awesome.min.css")}}">
    <link rel="stylesheet" href="{{url("vendors/themify-icons/css/themify-icons.css")}}">
    <link rel="stylesheet" href="{{url("vendors/flag-icon-css/css/flag-icon.min.css")}}">
    <link rel="stylesheet" href="{{url("vendors/selectFX/css/cs-skin-elastic.css")}}">
    <link rel="stylesheet" href="{{url("vendors/jqvmap/dist/jqvmap.min.css")}}">
    <link rel="stylesheet" href="{{url("assets/css/style.css")}}">
    <link rel="stylesheet" href="{{url("assets/alert/css/alertify.min.css")}}">
    <link rel="stylesheet" href="{{url("assets/alert/css/themes/bootstrap.min.css")}}">
    <link rel="stylesheet" href="{{url("assets/alert/css/themes/semantic.min.css")}}">
    <link rel="stylesheet" href="{{url("myStyle/adminPanel.css")}}">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>
</head>

<body>
    <!-- Left Panel -->
        @include("layouts.sub.leftMenu")
    <!-- /#left-panel -->
    <div id="right-panel" class="right-panel">
    <!-- Header-->
        @include("layouts.sub.header")
    <!-- Header end-->
        <div class="content mt-3">
            @yield("content")
        </div>

    <script src="{{url("alertifyjs/alertify.min.js")}}"></script>
    <script src="{{url("vendors/jquery/dist/jquery.min.js")}}"></script>
    <script src="{{url("vendors/popper.js/dist/umd/popper.min.js")}}"></script>
    <script src="{{url("vendors/bootstrap/dist/js/bootstrap.min.js")}}"></script>
    <script src="{{url("assets/js/main.js")}}"></script>
    <script src="{{url("vendors/chart.js/dist/Chart.bundle.min.js")}}"></script>
    <script src="{{url("assets/js/dashboard.js")}}"></script>
    <script src="{{url("assets/js/widgets.js")}}"></script>
    <script src="{{url("vendors/jqvmap/dist/jquery.vmap.min.js")}}"></script>
    <script src="{{url("vendors/jqvmap/examples/js/jquery.vmap.sampledata.js")}}"></script>
    <script src="{{url("vendors/jqvmap/dist/maps/jquery.vmap.world.js")}}"></script>
                @yield("js")
</body>

</html>
