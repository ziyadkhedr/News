<x-mail::message>
    # Introduction

    Thanks for subscribing!

    <x-mail::button :url="route('frontend.index')">
        Visit our website
    </x-mail::button>

    Thanks,<br>
    {{ config('app.name') }}
</x-mail::message>