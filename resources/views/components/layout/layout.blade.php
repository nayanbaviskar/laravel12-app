<!DOCTYPE html>
<html lang="en" class="h-full">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'Idea' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="flex min-h-full flex-col bg-zinc-50 font-sans text-zinc-900 antialiased selection:bg-zinc-900 selection:text-white">
    <x-layout.nav />
    <main class="mx-auto w-full max-w-7xl flex-1 px-4 sm:px-6 lg:px-8">
        {{ $slot }}
    </main>
</body>

</html>
