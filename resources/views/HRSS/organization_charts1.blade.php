@extends('layouts.simple.candidate_master')
@section('title', 'Day Zero')

@section('css')
{{-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css"> --}}
@endsection

@section('style')
<html lang="en" class="no-js">
    <head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta name="robots" content="noindex">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=3.0, user-scalable=0" />

        <title>Onyx Web Development Nuggets - Organizational chart with D3.js, expandable, zoomable, and fully initialized (Holding Company Tree Chart)</title>

        <!-- Favicons -->
        <link rel="apple-touch-icon" sizes="180x180" href="https://onyxdev.net/files/assets/images/favicons/apple-touch-icon.png" />
        <link rel="icon" type="image/png" href="https://onyxdev.net/files/assets/images/favicons/favicon-32x32.png" sizes="32x32" />
        <link rel="icon" type="image/png" href="https://onyxdev.net/files/assets/images/favicons/favicon-16x16.png" sizes="16x16" />
        <link rel="manifest" href="https://onyxdev.net/files/assets/images/favicons/manifest.json" />
        <link rel="mask-icon" href="https://onyxdev.net/files/assets/images/favicons/safari-pinned-tab.svg" color="#34b2a7" />
        <link rel="shortcut icon" href="https://onyxdev.net/files/assets/images/favicons/favicon.ico" />
        <meta name="msapplication-config" content="https://onyxdev.net/files/assets/images/favicons/browserconfig.xml" />
        <meta name="theme-color" content="#34b2a7" />

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700&display=swap" />

        <!-- Styles -->
        <link rel="stylesheet" href="../assets/css/main.css" /><html lang="en" class="no-js">
    <head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta name="robots" content="noindex">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=3.0, user-scalable=0" />

        <title>Onyx Web Development Nuggets - Organizational chart with D3.js, expandable, zoomable, and fully initialized (Holding Company Tree Chart)</title>

        <!-- Favicons -->
        <link rel="apple-touch-icon" sizes="180x180" href="https://onyxdev.net/files/assets/images/favicons/apple-touch-icon.png" />
        <link rel="icon" type="image/png" href="https://onyxdev.net/files/assets/images/favicons/favicon-32x32.png" sizes="32x32" />
        <link rel="icon" type="image/png" href="https://onyxdev.net/files/assets/images/favicons/favicon-16x16.png" sizes="16x16" />
        <link rel="manifest" href="https://onyxdev.net/files/assets/images/favicons/manifest.json" />
        <link rel="mask-icon" href="https://onyxdev.net/files/assets/images/favicons/safari-pinned-tab.svg" color="#34b2a7" />
        <link rel="shortcut icon" href="https://onyxdev.net/files/assets/images/favicons/favicon.ico" />
        <meta name="msapplication-config" content="https://onyxdev.net/files/assets/images/favicons/browserconfig.xml" />
        <meta name="theme-color" content="#34b2a7" />

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700&display=swap" />

        <!-- Styles -->
        <link rel="stylesheet" href="./assets/css/main.css" />
    </head>
    <body>

        <!-- JS note -->
        <noscript>
            <div class="no-js-note">
                ⚠️<br />
                JavaScript is disabled in your browser!<br />
                Please activate it to view this project.
            </div>
        </noscript>

        <!-- Org Chart container -->
        <div class="chart-container">
        </div>



        <!-- Scripts -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/d3/5.16.0/d3.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script>
        // $(document).ready(function() {
             var test_data=@json($emp_data);
            //  console.log(test_data)
        // });
       </script>

        <script src="../assets/sticky_notes_js/data.js"></script>
        <script src="../assets/sticky_notes_js/main.js"></script>

    </body>
</html>
@endsection
