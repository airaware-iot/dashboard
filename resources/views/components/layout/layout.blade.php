<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
<head>
    @props([
	    'title' => config('app.name'),
    ])
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/x-icon" href="favicon.ico">
    <title>{{$title}} | AirAware</title>
</head>
<body class="h-full bg-turquoise-background overflow-y-hidden">
<x-dock/>
<main class="h-full md:m-12 md:mr-0 md:pr-12 ml-2 mr-0 my-6 p-2 pr-4  rounded-2xl overscroll-y-none overflow-y-auto">
        {{$slot}}
    </main>
    @livewireScripts
</body>
</html>