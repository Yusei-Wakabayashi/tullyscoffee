<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Minecraft Book</title>
    <link rel="icon" href="{{ asset('/all.ico') }}">
    @vite(['resources/css/app.css', 'resources/js/main.js'])
    <link href="https://fonts.googleapis.com/css2?family=DotGothic16&display=swap" rel="stylesheet">
</head>

<body>
    <div id="app"></div>
</body>

</html>
