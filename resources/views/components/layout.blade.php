<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>Employee Management</title>
</head>
<body class="min-h-screen">
<section class="w-full px-8 text-gray-700 bg-white shadow">
    <div class="container flex flex-col flex-wrap items-center justify-between py-5 mx-auto md:flex-row max-w-7xl">
        <div class="relative flex flex-col md:flex-row">
            <a href="{{route("employees.home")}}"
               class="flex items-center mb-5 font-medium text-gray-900 lg:w-auto lg:items-center lg:justify-center md:mb-0">
                <img src="{{ asset("assets/logosip.png") }}" alt="logo-sip" class="w-24">
            </a>
        </div>
    </div>
</section>

<main class="flex justify-center py-8">
    <div class="px-8 md:px-16 max-w-7xl w-full">
        @if(isset($title))
            <h1 class="text-3xl font-bold pb-12">{{ $title }}</h1>
        @endif
        {{ $slot }}
    </div>
</main>

</body>
</html>
