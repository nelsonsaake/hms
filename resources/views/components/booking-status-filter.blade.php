@php
    use App\Enums\BookingStatus;
    $currentStatus = request('status');
    $statuses = BookingStatus::values();
@endphp

<style>
    .scrollbar-hide {
        scrollbar-width: none;
        -ms-overflow-style: none;
    }
    .scrollbar-hide::-webkit-scrollbar {
        display: none;
    }
</style>

<div x-data="{ scroll: null }" class="relative mb-2 w-full">
    <!-- Scroll Left Button -->
    <button @click="scroll.scrollBy({ left: -150, behavior: 'smooth' })"
        class="absolute left-0 z-10 h-full px-1 bg-gradient-to-r from-white dark:from-neutral-900 to-transparent">
        <div class="rounded-full bg-gray-200 p-1 shadow-sm dark:bg-neutral-700">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 text-gray-600 dark:text-white" fill="none"
                viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
        </div>
    </button>

    <!-- Scroll Right Button -->
    <button @click="scroll.scrollBy({ left: 150, behavior: 'smooth' })"
        class="absolute right-0 z-10 h-full px-1 bg-gradient-to-l from-white dark:from-neutral-900 to-transparent">
        <div class="rounded-full bg-gray-200 p-1 shadow-sm dark:bg-neutral-700">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 text-gray-600 dark:text-white" fill="none"
                viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
            </svg>
        </div>
    </button>

    <!-- Scrollable Status Pills -->
    <div x-ref="scroll" x-init="scroll = $refs.scroll"
        class="flex gap-1.5 overflow-x-auto scrollbar-hide whitespace-nowrap px-8">
        <div class="flex gap-1.5 ml-[14px]">
            @foreach ($statuses as $status)
                <a href="{{ route('dashboard.reservations', array_merge(request()->except('page'), ['status' => $status])) }}"
                    class="px-3 py-1.5 rounded-full text-xs font-medium border transition
                        {{ $currentStatus === $status
                            ? 'bg-blue-600 text-white border-blue-600'
                            : 'bg-white text-gray-700 border-gray-300 dark:bg-neutral-800 dark:text-white dark:border-neutral-600' }}">
                    {{ efmt($status) }}
                </a>
            @endforeach

            @if ($currentStatus)
                <a href="{{ route('dashboard.reservations', request()->except('status', 'page')) }}"
                    class="px-3 py-1.5 rounded-full text-xs font-medium bg-gray-100 text-gray-700 border border-gray-300 dark:bg-neutral-700 dark:text-white dark:border-neutral-600">
                    Clear
                </a>
            @endif
        </div>
    </div>
</div>
