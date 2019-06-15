<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

</head>
<body>
    <div id="app">
        <h1>
            <span id="logo">🃏</span>
            <span class="text">Crash Card Club</span>
        </h1>
        <h2>Outils de création et d'annimation de workshop.</h2>
        <h3>Inspirée des stratégies Obliques de Brian Eno.</h3>
        <p>Bientôt disponible.</p>
        <p>Par <a href="http://robinmoretti.eu" target="_blank">Robin Moretti</a>, <a href="http://theogoedert.com/" target="_blank">Théo Paolo</a> et <a href="http://www.abstractmachine.net" target="_blank">Douglas E. Stanley</a></p>
    </div>

</body>
</html>
