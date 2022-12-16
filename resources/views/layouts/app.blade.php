<!DOCTYPE html>
<html lang="en">
<head>
    <title>Test Project</title>
    <meta name="description" content="Transimpex courier service"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta charset="utf-8"/>
    <meta name="_token" content="{{ csrf_token() }}" id="_token">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700"/>
    <link href="/css/app.css" rel="stylesheet" type="text/css"/>
</head>
<body>
<div id="app">
    @yield('content')
</div>
<script src="/js/app.js"></script>
</body>
</html>
