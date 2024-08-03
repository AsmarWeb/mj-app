<x-mail::message>
    # Thank you, for contacting {{ config('app.name') }}! 🎉

    Name : {{ $contactMessage['fullname'] }}
    Email: {{ $contactMessage['email'] }}
    Phone: {{ $contactMessage['phone'] }}

    Message: {{ $contactMessage['message'] }}

    Your messages will be answered as soon as possible.

    Thanks - {{ config('app.name') }}
</x-mail::message>
