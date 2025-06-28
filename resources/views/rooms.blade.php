<x-layouts.app :title="__('Rooms')">
    <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200 py-4 uppercase border-b-2 border-b-gray-200 dark:border-b-neutral-700">
        <div class="flex justify-between">
            <div>
                <span onclick="history.back()" class="pr-8 cursor-pointer inline-block">←</span>
                {{ __('Rooms') }}
            </div>
        </div>
    </h2>

    @if (session('success'))
        <div class="p-4 mt-2 mb-4 text-green-700 bg-green-100 rounded-lg">
            {{ session('success') }}
        </div>
    @endif
    @if (session('error'))
        <div class="p-4 mt-2 mb-4 text-red-700 bg-red-100 rounded-lg">
            {{ session('error') }}
        </div>
    @endif

    {{-- Filters --}}
    <div class="mt-4">
        <form method="GET" action="{{ route('dashboard.rooms', ['status' => RoomStatus::AVAILABLE]) }}" class="flex flex-wrap gap-2">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="{{ __('Search rooms...') }}"
                class="flex-1 min-w-[200px] rounded-lg border border-neutral-300 bg-white px-4 py-2 text-sm text-neutral-700 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500 dark:border-neutral-600 dark:bg-neutral-800 dark:text-white" />

            <button type="submit"
                class="rounded-lg px-4 py-2 bg-blue-600 text-white hover:bg-blue-700 text-sm font-medium dark:bg-blue-500 dark:hover:bg-blue-600">
                {{ __('Search') }}
            </button>
        </form>
    </div>

    {{-- Rooms Table --}}
    <div class="overflow-x-auto rounded-xl border border-neutral-200 dark:border-neutral-700 mt-6">
        <table class="min-w-full divide-y divide-neutral-200 dark:divide-neutral-700 w-full table-auto">
            <thead class="dark:bg-neutral-100 bg-gray-50">
                <tr class="*:px-4 *:py-3 *:text-left *:text-sm *:font-semibold dark:text-gray-700 text-gray-800">
                    <th>{{ __('Image') }}</th>
                    <th>{{ __('Number') }}</th>
                    <th>{{ __('Type') }}</th>
                    <th>{{ __('Beds') }}</th>
                    <th>{{ __('Price') }}</th>
                    <th>{{ __('Status') }}</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-neutral-200 dark:divide-neutral-700">
                @forelse ($rooms as $room)
                    <tr class="hover:bg-neutral-50 dark:hover:bg-neutral-800/50">
                        <td class="px-4 py-3 text-sm text-neutral-700 dark:text-gray-100">
                            <x-image-display :src="$room->roomImages()->first()?->url" size="xs" label="" />
                        </td>
                        <td class="px-4 py-3 text-sm text-neutral-700 dark:text-gray-100">{{ $room->number }}</td>
                        <td class="px-4 py-3 text-sm text-neutral-700 dark:text-gray-100">{{ ucwords(str_replace('_',' ',$room->type)) }}</td>
                        <td class="px-4 py-3 text-sm text-neutral-700 dark:text-gray-100">{{ $room->beds }}</td>
                        <td class="px-4 py-3 text-sm text-neutral-700 dark:text-gray-100">{{ mfmt($room->price) }}</td>
                        <td class="px-4 py-3 text-sm">
                            <span class="inline-block rounded-full px-3 py-1 text-xs font-medium
                                {{ $room->status === App\Enums\RoomStatus::AVAILABLE ? 'text-green-800 bg-green-100 dark:text-green-100 dark:bg-green-800' :
                                   ($room->status === App\Enums\RoomStatus::BOOKED ? 'text-yellow-800 bg-yellow-100 dark:text-yellow-100 dark:bg-yellow-700' :
                                   'text-red-800 bg-red-100 dark:text-red-100 dark:bg-red-700') }}">
                                {{ efmt($room->status) }}
                            </span>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-4 py-3 text-sm text-center text-gray-500 dark:text-gray-400">
                            {{ __('No rooms found') }}
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="px-4 py-3 sm:px-6">
        {{ $rooms->appends(request()->all())->links() }}
    </div>
</x-layouts.app>
