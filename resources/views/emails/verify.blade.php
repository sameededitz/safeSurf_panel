<x-mail::message>
<h1 style="text-align: center; color: #333; font-size: 24px;">
    {{ config('app.name') }} Email Verification
</h1>

Hello <span style="color: #333; text-transform: capitalize; font-weight: bold;">{{ $user->name }}</span>,

Thank you for registering! Please verify your email address by clicking the button below:

<x-mail::button :url="$verificationUrl" color="primary">
Verify Email Address
</x-mail::button>

If you did not create an account, no further action is required.

Best Regards,<br>
{{ config('app.name') }} Team
</x-mail::message>