@props(['reservation'])

@php
    use App\Enums\BookingStatus;
    use App\Enums\BookingStatusNextOptions;

    $current = $reservation->status;
    $next = BookingStatusNextOptions::options($current);
@endphp

@foreach ($next as $toStatus)
    @php
        $label = ucwords(str_replace('_', ' ', $toStatus));
        $baseClasses = "px-3 py-1.5 text-xs font-medium rounded-full border transition";

        $styles = match ($toStatus) {
            BookingStatus::CANCELLED     => "border-red-500 text-red-600 hover:bg-red-100 dark:hover:bg-red-900",
            BookingStatus::CONFIRMED     => "border-green-500 text-green-600 hover:bg-green-100 dark:hover:bg-green-900",
            BookingStatus::ON_HOLD       => "border-yellow-500 text-yellow-600 hover:bg-yellow-100 dark:hover:bg-yellow-900",
            BookingStatus::RESCHEDULED   => "border-blue-400 text-blue-600 hover:bg-blue-100 dark:hover:bg-blue-900",
            BookingStatus::FAILED        => "border-gray-500 text-gray-600 hover:bg-gray-100 dark:hover:bg-neutral-700",
            BookingStatus::CHECKED_IN    => "border-indigo-500 text-indigo-600 hover:bg-indigo-100 dark:hover:bg-indigo-800",
            BookingStatus::CHECKED_OUT   => "border-purple-500 text-purple-600 hover:bg-purple-100 dark:hover:bg-purple-800",
            default                      => "border-gray-400 text-gray-600 hover:bg-gray-100 dark:text-white dark:border-neutral-600 dark:hover:bg-neutral-800",
        };
    @endphp

    <form action="{{ route('reservations.updateStatus', $reservation->id) }}" method="POST" class="inline-block mt-1 mr-1">
        @csrf
        <input type="hidden" name="status" value="{{ $toStatus }}">
        <button type="submit"
            class="{{ $baseClasses }} {{ $styles }}"
            title="Mark as {{ $label }}">
            {{ $label }}
        </button>
    </form>
@endforeach
