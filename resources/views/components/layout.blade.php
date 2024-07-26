<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Accent city</title>
</head>
<body>
<header class="header">
    {{$city->name}}
    <div>
        <a href="/">Main</a>
        <a href="{{route('about')}}">About</a>
        <a href="{{route('news')}}">News</a>
    </div>
</header>
{{$slot}}
<style>
    .header {
        background-color: #d1d5db;
        display: flex;
        padding: 10px;
        gap: 10px;
    }

    a {
        text-decoration: none;
    }

    a:hover {
        text-decoration: underline;
    }
</style>
</body>
</html>
