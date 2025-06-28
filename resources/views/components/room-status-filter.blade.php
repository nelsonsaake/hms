{{-- Status Pills --}}
@php
    use App\Enums\RoomStatus;
    $curr = request('status');
@endphp
<div class="overflow-x-auto scrollbar-hide my-4">
    <div class="flex gap-2 whitespace-nowrap px-8">
        @foreach (RoomStatus::values() as $status)
            <a href="{{ route('rooms.index', array_merge(request()->except('page'), ['status' => $status])) }}"
                class="px-4 py-2 rounded-full border
                       {{ $curr === $status ? 'bg-blue-600 text-white' : 'bg-white text-gray-700' }}">
                {{ ucwords(str_replace('_', ' ', $status)) }}
            </a>
        @endforeach
        @if ($curr)
            <a href="{{ route('rooms.index', request()->except('status', 'page')) }}"
                class="px-4 py-2 rounded-full bg-gray-200 text-gray-700">
                {{ __('Clear') }}
            </a>
        @endif
    </div>
</div>
