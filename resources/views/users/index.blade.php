<x-layouts.app :title="__('Users')">
    <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200 py-4 uppercase border-b-2 border-b-gray-200 dark:border-b-neutral-700">
        <div x-data="{ canGoBack: false }" x-init="canGoBack = history.length > 1">
            <span
                x-show="canGoBack"
                onclick="history.back()"
                class="pr-2 cursor-pointer mr-2 inline-block"
            >
                ←
            </span>
            {{ __('Users') }}
        </div>
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
        <div class="flex items-center justify-between px-2 py-2 gap-4">

            <!-- Right Side: Add Button -->
            <a
                href="{{route('users.create')}}"
                type="button"
                class="inline-flex items-center rounded-lg bg-blue-600 px-4 py-2 text-sm font-semibold text-white shadow hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:bg-blue-500 dark:hover:bg-blue-600">
                + Add
            </a>

            <form method="GET" class="flex justify-end items-end gap-2 w-fullx"> 
                <!-- Middle: Search Input -->
                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Search..."
                    class="flex-1 min-w-[200px] rounded-lg border border-neutral-300 bg-white px-4 py-2 text-sm text-neutral-700 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500 dark:border-neutral-600 dark:bg-neutral-800 dark:text-white" />
                    <!-- Right Side: Add Button -->
                    <x-button variant="primary" type="submit">
                        Search
                    </x-button>
            </form>
        </div>
        <div class="overflow-x-auto rounded-xl border border-neutral-200 dark:border-neutral-700">
            <table class="min-w-full divide-y divide-neutral-200 dark:divide-neutral-700 w-full table-auto">
                <thead class="dark:bg-neutral-100 bg-gray-50">
                    <tr class="*:px-4 *:py-3 *:text-left *:text-sm *:font-semibold dark:text-gray-700 text-gray-800">
                        <th>Name</th>
                        <th>Email</th>
                        <th class="w-1">
                            <div class="text-center">Actions</div>
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-neutral-200 dark:divide-neutral-700">

                @forelse ($users as $v)
                    <tr class="hover:bg-neutral-50 dark:hover:bg-neutral-800/50">
                        <td class="px-4 py-3 text-sm text-neutral-700 dark:text-gray-100">
                                {{$v->name}}
                            </td>
                            <td class="px-4 py-3 text-sm text-neutral-700 dark:text-gray-100">
                                {{$v->email}}
                            </td>

                        <td class="px-4 py-2">
                            <div class="flex gap-2">
                                <!-- View -->
                                <a
                                    href="{{route('users.show', $v->id)}}"
                                    class="p-2 rounded-lg bg-blue-600 text-white shadow hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:bg-blue-500 dark:hover:bg-blue-600"
                                    title="Details"
                                    aria-label="View Details"
                                >
                                    <x-heroicon-o-eye class="w-4 h-4" />
                                </a>

                                <!-- Edit -->
                                <a
                                    href="{{route('users.edit', $v->id)}}"
                                    class="p-2 rounded-lg bg-yellow-500 text-white shadow hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2 dark:bg-yellow-500 dark:hover:bg-yellow-600"
                                    title="Edit"
                                    aria-label="Edit User"
                                >
                                    <x-heroicon-o-pencil-square class="w-4 h-4" />
                                </a>

                                <!-- Delete -->
                                <form
                                    action="{{route('users.destroy', $v->id)}}"
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
                            No users found
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
        <!-- Pagination Links -->
        <div class="px-4 py-3 sm:px-6">
           {{ $users->links() }}
        </div>
    </div>
</x-layouts.app>

