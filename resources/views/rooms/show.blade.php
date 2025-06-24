<x-layouts.app :title="__('Room Details')">
    <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200 py-4 uppercase border-b-2 border-b-stone-700">
        {{ __('Room Details') }}
    </h2>

    <div class="flex w-full flex-1 flex-col gap-4 rounded-xl mt-8">
        <!-- Header buttons -->
        <div class="flex items-center justify-between py-4 gap-4 flex-wrap">
            <x-button color="blue" onclick="history.back()">
                ← {{ __('Back')}}
            </x-button>

            <div class="flex gap-2">
                <a href="{{route('rooms.edit', $room->id)}}"
                   class="inline-flex items-center rounded-md bg-yellow-500 px-4 py-2.5 text-xs font-medium text-white shadow hover:bg-yellow-600">
                    {{ __('Edit') }}
                </a>

                <form method="POST"
                      action="{{route('rooms.destroy', $room->id)}}"
                      onsubmit="return confirm('Are you sure you want to delete this?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" 
                            class="inline-flex items-center rounded-md bg-red-500 px-4 py-2.5 text-xs font-medium text-white shadow hover:bg-red-600"
                    >
                        {{ __('Delete') }}
                    </button>
                </form>
            </div>
        </div>

        <!-- Details -->

        <div class="bg-white dark:bg-neutral-800 rounded-xl divide-y divide-gray-200 dark:divide-gray-700">

                    <div class="pr-4 py-4 sm:grid sm:grid-cols-3 sm:gap-4">
                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">
                            {{ __('Type') }}
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 dark:text-gray-100 sm:col-span-2 sm:mt-0">
                            {{ efmt($room->type) }}

                        </dd>
                    </div>

                    <div class="pr-4 py-4 sm:grid sm:grid-cols-3 sm:gap-4">
                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">
                            {{ __('Price') }}
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 dark:text-gray-100 sm:col-span-2 sm:mt-0">

                                {{ $room->price }}

                        </dd>
                    </div>

                    <div class="pr-4 py-4 sm:grid sm:grid-cols-3 sm:gap-4">
                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">
                            {{ __('Beds') }}
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 dark:text-gray-100 sm:col-span-2 sm:mt-0">

                                {{ $room->beds }}

                        </dd>
                    </div>

                    <div class="pr-4 py-4 sm:grid sm:grid-cols-3 sm:gap-4">
                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">
                            {{ __('Description') }}
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 dark:text-gray-100 sm:col-span-2 sm:mt-0">

                                {{ $room->description }}

                        </dd>
                    </div>

                    <div class="pr-4 py-4 sm:grid sm:grid-cols-3 sm:gap-4">
                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">
                            {{ __('Status') }}
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 dark:text-gray-100 sm:col-span-2 sm:mt-0">
                            {{ efmt($room->status) }}

                        </dd>
                    </div>

        </div>
    </div>
</x-layouts.app>

