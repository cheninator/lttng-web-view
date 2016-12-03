<html>
    <head>
        <base href="/"></base>
        <meta charset="utf-8">
        <title>LTTng Web View</title>

        <link rel="stylesheet" href="{{ URL::asset('css/app.css') }}">
        <link rel="stylesheet" href="{{ URL::asset('css/sb-admin.css') }}">
        <link rel="stylesheet" href="{{ URL::asset('gridstack/dist/gridstack.min.css') }}">

        <script src="{{ URL::asset('jquery/dist/jquery.min.js') }}"></script>
        <script src="{{ URL::asset('chartjs/dist/Chart.min.js') }}"></script>
        <script src="{{ URL::asset('bootstrap/assets/javascripts/bootstrap.min.js') }}"></script>

        <script src="{{ URL::asset('js/loader.js') }}"></script>
        <script src="{{ URL::asset('js/app.js') }}"></script>

        <script src="{{ URL::asset('core-js/client/shim.min.js') }}"></script>
        <script src="{{ URL::asset('zonejs/dist/zone.min.js') }}"></script>
        <script src="{{ URL::asset('reflect-metadata/Reflect.js') }}"></script>
        <script src="{{ URL::asset('systemjs/dist/system.src.js') }}"></script>
        <script src="{{ URL::asset('systemjs.config.js') }}"></script>
        <script src="{{ URL::asset('ng2-charts/bundles/ng2-charts.js') }}"></script>
        <script src="{{ URL::asset('gridstack/dist/gridstack.min.js') }}"></script>
        <script src="{{ URL::asset('jquery-ui-dist/jquery-ui.min.js') }}"></script>

        <script>
            System.import('app').catch(function(err) { 
                console.error(err); 
            });
        </script>
    </head>
    @section('content')
    @show
</html>