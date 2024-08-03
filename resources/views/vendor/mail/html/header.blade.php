@props(['url'])
<tr>
    <td class="header">
        <a href="{{ $url }}" style="display: inline-block;">
            @if (trim($slot) === 'Laravel')
                <img src="https://lh3.googleusercontent.com/a/ACg8ocLbKTjedZulHpjDSy6aqzi_oWyxiC7hGbmjuSfBkKn-1Nvevic=s576-c-no"
                    class="logo" alt="Laravel Logo">
            @else
                {{ $slot }}
            @endif
        </a>
    </td>
</tr>
