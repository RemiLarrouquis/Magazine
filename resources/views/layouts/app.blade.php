<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Magazine') }}</title>

    <!-- Bootstrap Styles -->
    <link href="{{ asset('css/framework/vendor.css') }}" type="text/css" rel="stylesheet">
    <link href="{{ asset('css/framework/app-purple.css') }}" type="text/css" rel="stylesheet">

    <!-- Plugin autocomplete -->
    <link href="{{ asset('css/framework/jquery.magicsearch.css') }}" rel="stylesheet">

    <!-- Custom styles -->
    <link href="{{ asset('css/app-custom.css') }}" type="text/css" rel="stylesheet">


</head>
<body>

    <script src="{{ asset('js/framework/jquery-3.2.1.min.js') }}"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>-->
    <script src="{{ asset('js/app-custom.js') }}"></script>

    @yield('app')

    <!-- Scripts -->
    <script src="{{ asset('js/framework/vendor.js') }}"></script>
    <script src="{{ asset('js/framework/app.js') }}"></script>
    <script src="{{ asset('js/framework/dropzone.js') }}"></script>
    <script src="{{ asset('js/framework/jquery.magicsearch.js') }}"></script>

</body>

</html>
