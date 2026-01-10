<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<x-head />

<body class="  ">
    <x-header />
    <main class=" ">
        {{ $slot }}
    </main>
    @unless (request()->is('admin/*'))
       
    <x-chat-widget />
        
    @endunless

    <x-notif/>
</body>

</html>
