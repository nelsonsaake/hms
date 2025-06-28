<x-layouts.app :title="__('Reservations')">
    <h2
        class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200 py-4 uppercase border-b-2 border-b-gray-200 dark:border-b-neutral-700">
        <div class="flex justify-between">

            <div>
                {{ __('Reservations') }}
            </div>

            <!-- Right Side: Add Button -->
            <a href="{{ route('reservations.create') }}"
                class="inline-flex items-center rounded-[9px] bg-neutral-600 px-4 py-2 text-sm font-semibold text-white shadow hover:bg-neutral-700 focus:outline-none focus:ring-2 focus:ring-neutral-500 focus:ring-offset-2 dark:bg-neutral-500 dark:hover:bg-neutral-600 capitalize">
                Make Reservation
            </a>
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

    <div class="flex w-full flex-1 flex-col gap-4 rounded-xl mt-8">
        <div class="flex items-center justify-between px-2 py-4 gap-4 flex-wrap">
            <!-- Left Side: Back Button -->
            <x-button onclick="history.back()">
                ← {{ __('Back') }}
            </x-button>

            <!-- Middle: Search Input -->
            <form method="GET" action="{{ route('reservations.my') }}" class="flex flex-1 gap-2">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search..."
                    class="flex-1 min-w-[200px] rounded-lg border border-neutral-300 bg-white px-4 py-2 text-sm text-neutral-700 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500 dark:border-neutral-600 dark:bg-neutral-800 dark:text-white" />
                <button type="submit"
                    class="rounded-lg px-4 py-2 bg-blue-600 text-white hover:bg-blue-700 text-sm font-medium dark:bg-blue-500 dark:hover:bg-blue-600">
                    Search
                </button>
            </form>
        </div>
        <div class="overflow-x-auto rounded-xl border border-neutral-200 dark:border-neutral-700">
            <table class="min-w-full divide-y divide-neutral-200 dark:divide-neutral-700 w-full table-auto">
                <thead class="dark:bg-neutral-100 bg-gray-50">
                    <tr class="*:px-4 *:py-3 *:text-left *:text-sm *:font-semibold dark:text-gray-700 text-gray-800">
                        <th>Room</th>
                        <th>Guest</th>
                        <th>Reserved</th>
                        <th>Stay</th>
                        <th class="w-1">
                            <div class="text-center">Actions</div>
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-neutral-200 dark:divide-neutral-700">

                    @forelse ($reservations as $v)
                        <tr class="hover:bg-neutral-50 dark:hover:bg-neutral-800/50">
                            <td class="px-4 py-3 text-sm text-neutral-700 dark:text-gray-100">
                                <dl>
                                    <dd>
                                        <x-image-display :src="$v->room->roomImages[0]->url" size="xs" label="" />
                                    </dd>
                                    <dt>Number</dt>
                                    <dd>
                                        <a href="{{ route('rooms.show', $v?->room_id) }}"
                                            class="underline text-blue-900 dark:text-blue-500">
                                            {{ $v->room->number }}
                                        </a>
                                    </dd>
                                    <dt>Status</dt>
                                    <dd>{{ efmt($v->status) }}</dd>
                                </dl>
                            </td>
                            <td class="px-4 py-3 text-sm text-neutral-700 dark:text-gray-100">
                                <dl>
                                    <dt>Name</dt>
                                    <dd>{{ $v->guest_name }}</dd>
                                    <dt>Email</dt>
                                    <dd>{{ $v->guest_email }}</dd>
                                    <dt>Phone</dt>
                                    <dd>{{ $v->guest_phone }}</dd>
                                </dl>
                            </td>
                            <td class="px-4 py-3 text-sm text-neutral-700 dark:text-gray-100">
                                <dl>
                                    <dt>From</dt>
                                    <dd>{{ dfmt($v->from_date, 'N/A') }}</dd>
                                    <dt>to</dt>
                                    <dd>{{ dfmt($v->to_date, 'N/A') }}</dd>
                                </dl>
                            </td>
                            <td class="px-4 py-3 text-sm text-neutral-700 dark:text-gray-100">
                                <dl>
                                    <dt>Check In</dt>
                                    <dd>{{ tfmt($v->check_in) }}</dd>
                                    <dt>Check Out</dt>
                                    <dd>{{ tfmt($v->check_out) }}</dd>
                                </dl>
                            </td>

                            <td class="px-4 py-2">
                                <div class="flex gap-2">
                                    <!-- View (always allowed) -->
                                    <a href="{{ route('reservations.show', $v->id) }}"
                                        class="p-2 rounded-lg bg-blue-600 text-white shadow hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:bg-blue-500 dark:hover:bg-blue-600"
                                        title="View Details" aria-label="View">
                                        <x-heroicon-o-eye class="w-4 h-4" />
                                    </a>

                                    <!-- Edit -->
                                    @can('modify', $v)
                                        <a href="{{ route('reservations.edit', $v->id) }}"
                                            class="p-2 rounded-lg bg-yellow-600 text-white shadow hover:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2 dark:bg-yellow-500 dark:hover:bg-yellow-600"
                                            title="Edit reservation" aria-label="Edit">
                                            <x-heroicon-o-pencil-square class="w-4 h-4" />
                                        </a>
                                    @else
                                        <button disabled
                                            class="p-2 rounded-lg bg-yellow-300 text-white opacity-60 cursor-not-allowed dark:bg-yellow-700"
                                            title="Cannot edit this reservation">
                                            <x-heroicon-o-pencil-square class="w-4 h-4" />
                                        </button>
                                    @endcan

                                    <!-- Delete -->
                                    @can('modify', $v)
                                        <form action="{{ route('reservations.destroy', $v->id) }}" method="POST"
                                            onsubmit="return confirm('Are you sure you want to delete this reservation?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="p-2 rounded-lg bg-red-600 text-white shadow hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 dark:bg-red-500 dark:hover:bg-red-600"
                                                title="Delete reservation" aria-label="Delete">
                                                <x-heroicon-o-trash class="w-4 h-4" />
                                            </button>
                                        </form>
                                    @else
                                        <button disabled
                                            class="p-2 rounded-lg bg-red-300 text-white opacity-60 cursor-not-allowed dark:bg-red-700"
                                            title="Cannot delete this reservation">
                                            <x-heroicon-o-trash class="w-4 h-4" />
                                        </button>
                                    @endcan
                                </div>
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-4 py-3 text-sm text-center text-gray-500 dark:text-gray-400">
                                No reservations found
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <!-- Pagination Links -->
        <div class="px-4 py-3 sm:px-6">
            {{ $reservations->links() }}
        </div>
    </div>
</x-layouts.app>
