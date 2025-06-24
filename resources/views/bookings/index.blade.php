<x-layouts.app :title="__('Bookings')">
    <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200 py-4 uppercase border-b-2 border-b-stone-700">
       {{ __('Bookings') }}
    </h2>

    @if(session('success'))
        <div class="p-4 mt-2 mb-4 text-green-700 bg-green-100 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="p-4 mt-2 mb-4 text-red-700 bg-red-100 rounded-lg">
            {{ session('error') }}
        </div>
    @endif

    <div class="flex w-full flex-1 flex-col gap-4 rounded-xl mt-8">
        <div class="flex items-center justify-between px-2 py-4 gap-4 flex-wrap">
            <!-- Left Side: Back Button -->
            <button
                type="button"
                onclick="history.back()"
                class="inline-flex items-center rounded-lg bg-gray-200 px-4 py-2 text-sm font-medium text-gray-800 shadow hover:bg-gray-300 dark:bg-neutral-700 dark:text-white dark:hover:bg-neutral-600">
                ← Back
            </button>

            <!-- Middle: Search Input -->
            <input
                type="text"
                placeholder="Search..."
                class="flex-1 min-w-[200px] rounded-lg border border-neutral-300 bg-white px-4 py-2 text-sm text-gray-900 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500 dark:border-neutral-600 dark:bg-neutral-800 dark:text-white" />

            <!-- Right Side: Add Button -->
            <a
                href="{{route('bookings.create')}}"
                type="button"
                class="inline-flex items-center rounded-lg bg-blue-600 px-4 py-2 text-sm font-semibold text-white shadow hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:bg-blue-500 dark:hover:bg-blue-600">
                + Add
            </a>
        </div>
        <div class="overflow-x-auto rounded-xl border border-neutral-200 dark:border-neutral-700">
            <table class="min-w-full divide-y divide-neutral-200 dark:divide-neutral-700 w-full">
                <thead class="dark:bg-neutral-100 bg-neutral-800">
                    <tr class="*:px-4 *:py-3 *:text-left *:text-sm *:font-semibold dark:text-gray-700 text-gray-200">
                        <th>User</th>
                        <th>Room</th>
                        <th>Check In</th>
                        <th>Check Out</th>
                        <th>Status</th>
                        <th>Guest Name</th>
                        <th>Guest Email</th>
                        <th>Guest Phone</th>
                        <th class="w-1">
                            <div class="text-center">Actions</div>
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-neutral-200 dark:divide-neutral-700">

                @forelse ($bookings as $v)
                    <tr class="hover:bg-neutral-50 dark:hover:bg-neutral-800/50">
                        <td class="px-4 py-3 text-sm text-gray-900 dark:text-gray-100">
                                <a 
                                    href="{{route('users.show', $v?->user_id)}}"
                                    class="underline text-blue-500"
                                >
                                    {{$v->user?->name ?? idfmt($v->user_id)}}
                                </a>
                            </td>
                            <td class="px-4 py-3 text-sm text-gray-900 dark:text-gray-100">
                                <a 
                                    href="{{route('rooms.show', $v?->room_id)}}"
                                    class="underline text-blue-500"
                                >
                                    {{$v->room?->name ?? idfmt($v->room_id)}}
                                </a>
                            </td>
                            <td class="px-4 py-3 text-sm text-gray-900 dark:text-gray-100">
                                {{tfmt($v->check_in)}}
                            </td>
                            <td class="px-4 py-3 text-sm text-gray-900 dark:text-gray-100">
                                {{tfmt($v->check_out)}}
                            </td>
                            <td class="px-4 py-3 text-sm text-gray-900 dark:text-gray-100">
                                {{efmt($v->status)}}
                            </td>
                            <td class="px-4 py-3 text-sm text-gray-900 dark:text-gray-100">
                                {{$v->guest_name}}
                            </td>
                            <td class="px-4 py-3 text-sm text-gray-900 dark:text-gray-100">
                                {{$v->guest_email}}
                            </td>
                            <td class="px-4 py-3 text-sm text-gray-900 dark:text-gray-100">
                                {{$v->guest_phone}}
                            </td>

                        <td class="px-4 py-2">
                            <div class="flex gap-2">
                                <!-- View -->
                                <a
                                    href="{{route('bookings.show', $v->id)}}"
                                    class="p-2 rounded-lg bg-blue-600 text-white shadow hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:bg-blue-500 dark:hover:bg-blue-600"
                                    title="Details"
                                    aria-label="View Details"
                                >
                                    <x-heroicon-o-eye class="w-4 h-4" />
                                </a>

                                <!-- Edit -->
                                <a
                                    href="{{route('bookings.edit', $v->id)}}"
                                    class="p-2 rounded-lg bg-yellow-600 text-white shadow hover:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2 dark:bg-yellow-500 dark:hover:bg-yellow-600"
                                    title="Edit"
                                    aria-label="Edit Item"
                                >
                                    <x-heroicon-o-pencil-square class="w-4 h-4" />
                                </a>

                                <!-- Delete -->
                                <form
                                    action="{{route('bookings.destroy', $v->id)}}"
                                    method="POST"
                                    onsubmit="return confirm('Are you sure you want to delete this item?');"
                                >
                                    @csrf
                                    @method('DELETE')
                                    <button
                                        type="submit"
                                        class="p-2 rounded-lg bg-red-600 text-white shadow hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 dark:bg-red-500 dark:hover:bg-red-600"
                                        title="Delete"
                                        aria-label="Delete Item"
                                    >
                                        <x-heroicon-o-trash class="w-4 h-4" />
                                    </button>
                                </form>
                            </div>
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
        <!-- Pagination Links -->
        <div class="px-4 py-3 bg-white border-t border-gray-200 dark:bg-gray-800 dark:border-gray-700 sm:px-6">
           {{ $bookings->links() }}
        </div>
    </div>
</x-layouts.app>

