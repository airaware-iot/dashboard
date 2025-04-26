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
    <title>{{$title}}</title>
</head>
<body class="h-full p-8 bg-turquoise-background grid gap-8">
    <main class="h-full p-6  rounded-2xl overflow-y-auto">
        {{$slot}}
    </main>
    @livewireScripts
</body>
</html>