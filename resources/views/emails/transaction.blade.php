<!DOCTYPE html>
<html>
<head>
    <title>Geral.com</title>
</head>
<body>
<h1>{{ $details['title'] }}</h1>


@component('mail::message')
    Hello **{{$name}}**,  {{-- use double space for line break --}}
    {{ $details['body'] }}

<p>Obrigado!</p>
</body>
</html>
