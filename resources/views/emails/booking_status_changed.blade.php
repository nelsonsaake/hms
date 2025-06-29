@php
    use App\Mail\BookingStatusChanged;

    $logo = env('app_logo');
    $heading = (new BookingStatusChanged($reservation))->heading();
    $message = (new BookingStatusChanged($reservation))->messageText();
@endphp

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>{{ $heading }} – {{ config('app.name') }}</title>
</head>
<body style="background-color: #f4f4f5; padding: 24px; font-family: 'Segoe UI', Roboto, sans-serif; color: #1f1f1f;">

    {{-- Logo --}}
    <div style="text-align: center; margin-top: 24px; margin-bottom: 32px;">
        <img src="{{ $logo }}" alt="{{ config('app.name') }} Logo" style="height: 64px; border-radius: .8rem;" />
        <div style="font-size: 18px; font-weight: 600; color: #040420; margin-top: 4px;">{{ config('app.name') }}</div>
    </div>

    {{-- Spacer between logo and card --}}
    <div style="height: 16px;"></div>

    <div style="max-width: 600px; margin: 0 auto; background-color: #ffffff; border-radius: 16px; box-shadow: 0 4px 12px rgba(0,0,0,0.08); padding: 24px;">

        <h2 style="margin-top: 0; color: #1a1a1a; text-align: center;">
            {{ $heading }}
        </h2>

        <p style="line-height: 1.6; font-size: 14px; color: #52565a; margin-top: 3rem;">
            Hi {{ $reservation->user->name ?? $reservation->guest_name ?? 'Guest' }},
        </p>

        @if ($message)
        <p style="line-height: 1.6; font-size: 14px; color: #52565a;">
            {{ $message }}
        </p>
        @endif

        {{-- Booking Table --}}
        <table width="100%" cellpadding="0" cellspacing="0" style="font-size: 15px; border-collapse: collapse; margin-top: 32px;">
            <!-- Booking Section Header -->
            <tr>
                <td colspan="2" style="font-weight: 600; padding: 12px 0; font-size: 16px;">Booking</td>
            </tr>
            @if ($reservation->from_date)
            <tr style="border-top: 1px solid #e0e0e0;">
                <th style="width: 90px; padding: 8px 12px; background-color: #f9f9f9; text-align: right; vertical-align: top;
                    border-right: 1px solid #e0e0e0; color: #5f6368; font-weight: 600;">
                    From
                </th>
                <td style="padding: 8px 12px; text-align: left;">{{ dfmt($reservation->from_date) }}</td>
            </tr>
            @endif
            @if ($reservation->to_date)
            <tr style="border-top: 1px solid #e0e0e0;">
                <th style="width: 90px; padding: 8px 12px; background-color: #f9f9f9; text-align: right; vertical-align: top;
                    border-right: 1px solid #e0e0e0; color: #5f6368; font-weight: 600;">
                    To
                </th>
                <td style="padding: 8px 12px; text-align: left;">{{ dfmt($reservation->to_date) }}</td>
            </tr>
            @endif
            @if ($reservation->status)
            <tr style="border-top: 1px solid #e0e0e0;">
                <th style="width: 90px; padding: 8px 12px; background-color: #f9f9f9; text-align: right; vertical-align: top;
                    border-right: 1px solid #e0e0e0; color: #5f6368; font-weight: 600;">
                    Status
                </th>
                <td style="padding: 8px 12px; text-align: left;">{{ efmt($reservation->status) }}</td>
            </tr>
            @endif

            <!-- Room Section Header -->
            @if ($reservation->room)
            <tr>
                <td colspan="2" style="font-weight: 600; padding: 24px 0 12px; font-size: 16px;">Room</td>
            </tr>
                <tr style="border-top: 1px solid #e0e0e0;">
                    <th style="width: 90px; padding: 8px 12px; background-color: #f9f9f9; text-align: right; vertical-align: top;
                        border-right: 1px solid #e0e0e0; color: #5f6368; font-weight: 600;">
                        Number
                    </th>
                    <td style="padding: 8px 12px; text-align: left;">{{ $reservation->room->number }}</td>
                </tr>
                <tr style="border-top: 1px solid #e0e0e0;">
                    <th style="width: 90px; padding: 8px 12px; background-color: #f9f9f9; text-align: right; vertical-align: top;
                        border-right: 1px solid #e0e0e0; color: #5f6368; font-weight: 600;">
                        Floor
                    </th>
                    <td style="padding: 8px 12px; text-align: left;">{{ $reservation->room->floor }}</td>
                </tr>
            @endif

            <!-- Guest Section Header -->
            <tr>
                <td colspan="2" style="font-weight: 600; padding: 24px 0 12px; font-size: 16px;">Guest</td>
            </tr>
            @if ($reservation->guest_name)
            <tr style="border-top: 1px solid #e0e0e0;">
                <th style="width: 90px; padding: 8px 12px; background-color: #f9f9f9; text-align: right; vertical-align: top;
                    border-right: 1px solid #e0e0e0; color: #5f6368; font-weight: 600;">
                    Name
                </th>
                <td style="padding: 8px 12px; text-align: left;">{{ $reservation->guest_name }}</td>
            </tr>
            @endif
            @if ($reservation->guest_email)
            <tr style="border-top: 1px solid #e0e0e0;">
                <th style="width: 90px; padding: 8px 12px; background-color: #f9f9f9; text-align: right; vertical-align: top;
                    border-right: 1px solid #e0e0e0; color: #5f6368; font-weight: 600;">
                    Email
                </th>
                <td style="padding: 8px 12px; text-align: left;">{{ $reservation->guest_email }}</td>
            </tr>
            @endif
            @if ($reservation->guest_phone)
            <tr style="border-top: 1px solid #e0e0e0;">
                <th style="width: 90px; padding: 8px 12px; background-color: #f9f9f9; text-align: right; vertical-align: top;
                    border-right: 1px solid #e0e0e0; color: #5f6368; font-weight: 600;">
                    Phone
                </th>
                <td style="padding: 8px 12px; text-align: left;">{{ $reservation->guest_phone }}</td>
            </tr>
            @endif
        </table>

        <hr style="border: none; border-top: 1px solid #e0e0e0; margin: 32px 0;">

        <p style="font-size: 14px; color: #8a8d91; text-align: center;">
            Have questions or need to make changes? Just reply to this email or reach us at<br>
            <a href="mailto:{{ config('mail.from.address') }}" style="color: #8a8d91; text-decoration: underline;">{{ config('mail.from.address') }}</a>
        </p>

        <p style="margin-top: 32px; font-weight: 500; color: #8a8d91; text-align: center;">
            Sincerely,<br>The {{ config('app.name') }} Team
        </p>
    </div>

</body>
</html>
