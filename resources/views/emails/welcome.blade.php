<x-mail::message>
    # Hello {{$user->first_name}} {{$user->last_name}}

    Welcome to the Darajat platform
    <!--    <x-mail::button :url="''">-->
    <!--        Button Text-->
    <!--    </x-mail::button>-->

    Thanks,<br>
    {{ config('app.name') }}
</x-mail::message>
