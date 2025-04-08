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
<body class="h-full p-8 bg-slate-700 grid grid-cols-[1fr_4fr] gap-8">
    <aside class="h-full bg-slate-800 p-6 rounded-2xl">
        <h1 class="text-2xl font-semibold text-white mb-4">{{config('app.name')}}</h1>
        <hr class="bg-slate-500 mb-6">
        
        {{-- Links --}}
        
    </aside>
    <main class="h-full p-6 bg-slate-300 rounded-2xl overflow-y-auto">
        {{$slot}}
    </main>
    @livewireScripts
</body>
</html>