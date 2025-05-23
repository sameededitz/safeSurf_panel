@props(['url'])
<tr>
    <td class="header">
        <a href="{{ $url }}" style="display: inline-block;">
            @if (trim($slot) === 'Laravel')
                <img src="{{ asset('assets/images/logo-mail.png') }}" class="logo" alt="{{ config('app.name') }} Logo">
            @else
                <img src="{{ asset('assets/images/logo-mail.png') }}" class="logo" alt="{{ config('app.name') }} Logo">
            @endif
        </a>
    </td>
</tr>
