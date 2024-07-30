<x-mail::message>
    # Hurray, a new contact lead! 🎉

    Name : {{ $contactMessage['fullname'] }}
    Email: {{ $contactMessage['email'] }}
    Phone: {{ $contactMessage['phone'] }}

    Message: {{ $contactMessage['message'] }}

    Thanks - {{ config('app.name') }}
</x-mail::message>
