<html class="h-full bg-white">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel</title>
    @vite('resources/css/app.css')
</head>

<body class="h-full w-full flex flex-row">

@auth
<header class="h-full w-xs">
    <x-navigation.sidebar/>
</header>
@endauth

<main class="flex-grow flex items-center justify-center">
    {{ $slot }}
</main>

</body>
</html>
