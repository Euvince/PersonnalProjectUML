<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://bootswatch.com/5/lumen/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('lumen.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="">
    <title>@yield('title') | Système Hôteliers</title>

    <style>
        .universite-details {
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 2px 2px 4px 4px rgba(0,0,0,0.1);
            padding: 20px;
            margin-bottom: 20px;
        }
        .universite-details h2 {
            color: #333333;
            margin-bottom: 20px;
            border-bottom: 2px solid #158cba;
            padding-bottom: 10px;
        }
        .universite-details p {
            margin-bottom: 10px;
            color: #666666;
        }
    </style>

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
