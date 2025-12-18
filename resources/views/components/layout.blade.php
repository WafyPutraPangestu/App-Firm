<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<x-head />

<body class="  ">
    <x-header />
    <main class=" ">
        {{ $slot }}
    </main>
    <x-footer />
</body>

</html>
