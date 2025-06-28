<x-layouts.app :title="__('Bookings Report')">
    <h2
        class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200 py-4 uppercase border-b-2 border-b-gray-200 dark:border-b-neutral-700">
        <div class="flex justify-between">
            <div>
                <span onclick="history.back()" class="pr-8 cursor-pointer inline-block">←</span>
                {{ __('Bookings Report') }}
            </div>
            <a href="{{ route('bookings.report.export', request()->all()) }}"
                class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg text-sm font-medium dark:bg-green-500 dark:hover:bg-green-600">
                Export XLS
            </a>
        </div>
    </h2>

    <div class="mt-8">
        <form method="GET" action="{{ route('bookings.report') }}" class="flex flex-wrap gap-2 mb-6">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search..."
                class="flex-1 min-w-[200px] rounded-lg border border-neutral-300 px-4 py-2 text-sm shadow-sm dark:border-neutral-600 dark:bg-neutral-800 dark:text-white" />

            <input type="date" name="start_date" value="{{ request('start_date') }}"
                class="rounded-lg border border-neutral-300 px-4 py-2 text-sm dark:border-neutral-600 dark:bg-neutral-800 dark:text-white" />

            <input type="date" name="end_date" value="{{ request('end_date') }}"
                class="rounded-lg border border-neutral-300 px-4 py-2 text-sm dark:border-neutral-600 dark:bg-neutral-800 dark:text-white" />

            <select name="status"
                class="rounded-lg border border-neutral-300 px-4 py-2 text-sm dark:border-neutral-600 dark:bg-neutral-800 dark:text-white">
                <option value="">All Statuses</option>
                @foreach (\App\Enums\BookingStatus::values() as $case)
                    <option value="{{ $case }}" @selected(request('status') === $case)>
                        {{ ucwords(str_replace('_', ' ', $case)) }}
                    </option>
                @endforeach
            </select>

            <button type="submit"
                class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-medium dark:bg-blue-500 dark:hover:bg-blue-600">
                Filter
            </button>

            <a href="{{ route('bookings.report') }}"
                class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg text-sm font-medium dark:bg-red-500 dark:hover:bg-red-600">
                Reset
            </a>
        </form>
    </div>

    <div class="overflow-x-auto rounded-xl border border-neutral-200 dark:border-neutral-700">
        <table class="min-w-full divide-y divide-neutral-200 dark:divide-neutral-700 w-full table-auto">
            <thead class="bg-gray-50 dark:bg-neutral-100">
                <tr class="*:px-4 *:py-3 *:text-left *:text-sm *:font-semibold dark:text-gray-700 text-gray-800">
                    <th>Room</th>
                    <th>Guest</th>
                    <th>Book</th>
                    <th>Stay</th>
                    <th class="w-1 text-center">Status</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-neutral-200 dark:divide-neutral-700">
                @forelse($bookings as $b)
                    <tr class="hover:bg-neutral-50 dark:hover:bg-neutral-800/50">
                        <td class="px-4 py-3 text-sm text-neutral-700 dark:text-gray-100">
                            <dl>
                                <dt>Number</dt>
                                <dd>{{ $b->room?->number }}</dd>
                                <dt>Status</dt>
                                <dd class="text-sm text-neutral-500 dark:text-neutral-400">
                                    {{ efmt($b->room?->status) }}
                                </dd>
                            </dl>
                        </td>
                        <td class="px-4 py-3 text-sm text-neutral-700 dark:text-gray-100">
                            <dl>
                                <dt>Name</dt>
                                <dd class="text-sm text-neutral-500 dark:text-neutral-400">{{ $b->guest_name }}</dd>

                                <dt>Email</dt>
                                <dd class="text-sm text-neutral-500 dark:text-neutral-400">{{ $b->guest_email }}</dd>

                                <dt>Phone</dt>
                                <dd class="text-sm text-neutral-500 dark:text-neutral-400">{{ $b->guest_phone }}</dd>
                            </dl>
                        </td>
                        <td class="px-4 py-3 text-sm text-neutral-700 dark:text-gray-100">
                            <dl>
                                <dt>From</dt>
                                <dd class="text-sm text-neutral-500 dark:text-neutral-400">{{ dfmt($b->from_date, 'N/A') }}</dd>
                                <dt>To</dt>
                                <dd class="text-sm text-neutral-500 dark:text-neutral-400">{{ dfmt($b->to_date, 'N/A') }}</dd>
                            </dl>
                        </td>
                        <td class="px-4 py-3 text-sm text-neutral-700 dark:text-gray-100">
                            <dl>
                                <dt>Check In</dt>
                                <dd class="text-sm text-neutral-500 dark:text-neutral-400">{{ tfmt($b->check_in) }}</dd>
                                <dt>Check Out</dt>
                                <dd class="text-sm text-neutral-500 dark:text-neutral-400">{{ tfmt($b->check_out) }}</dd>
                            </dl>
                        </td>
                        <td class="px-4 py-3 text-sm text-neutral-700 dark:text-gray-100 w-1 whitespace-nowrap text-center">
                            <span
                                class="inline-block rounded-full px-3 py-1 text-sm font-medium
                                {{ match ($b->status) {
                                    'confirmed' => 'bg-yellow-100 text-yellow-800',
                                    'checked_in' => 'bg-blue-100 text-blue-800',
                                    'checked_out' => 'bg-green-100 text-green-800',
                                    default => 'bg-gray-100 text-gray-800',
                                } }}">
                                {{ efmt($b->status) }}
                            </span>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-4 py-3 text-sm text-center text-gray-500 dark:text-gray-400">
                            No bookings found
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="px-4 py-3 sm:px-6">
        {{ $bookings->appends(request()->all())->links() }}
    </div>
</x-layouts.app>
