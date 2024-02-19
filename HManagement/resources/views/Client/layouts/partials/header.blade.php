<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://bootswatch.com/5/lumen/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="">
    <title>@yield('title') | Système Hôteliers</title>

    @livewireStyles()
    @vite([
        'resources/css/app.css',
        'resources/js/app.js',
    ])
</head>
<body>

    @include('Client.layouts.partials.navbar')
    <div class="container my-4">
        @yield('content')
    </div>
