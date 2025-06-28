<x-layouts.app :title="__('Update Room')">
    <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200 py-4 uppercase border-b-2 border-b-gray-200 dark:border-b-neutral-700">
        <div x-data="{ canGoBack: false }" x-init="canGoBack = history.length > 1">
            <span
                x-show="canGoBack"
                onclick="history.back()"
                class="pr-8 cursor-pointer mr-8 inline-block"
            >
                ←
            </span>
            {{ __('Update Room') }}
        </div>
    </h2>

    @if(session('success'))
        <div class="p-4 mt-2 mb-4 text-green-700 bg-green-100 rounded-lg">
            {{  session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="p-4 mt-2 mb-4 text-red-700 bg-red-100 rounded-lg">
            {{  session('error') }}
        </div>
    @endif

    <div class="flex w-full flex-1 flex-col gap-4 rounded-xl mt-8">

        <form wire:submit.prevent="save" action="{{ route('rooms.update', $room) }}"   method="POST" class="space-y-6">
            @csrf
            @method('PUT')

                    <flux:select
                        wire:model="type"
                        name="type"
                        id="type"
                        :label="__('Type')"
                        :error="$errors->has('type')"
                        :error-message="$errors->first('type')"
                    >
                        @foreach (RoomType::values() as $v)
                            <option 
                                value="{{ $v }}"
                                {{ $room->type == $v ? 'selected' : '' }}
                            >
                                {{ efmt($v)  }}
                            </option>
                        @endforeach
                    </flux:select>

                    <flux:input
                        wire:model="price"
                        name="price"
                        id="price"
                        type="text"

                        :label="__('Price')"
                        :value="$room->price"
                        :error="$errors->has('price')"
                        :error-message="$errors->first('price')"
                    />

                    <flux:input
                        wire:model="beds"
                        name="beds"
                        id="beds"
                        type="text"

                        :label="__('Beds')"
                        :value="$room->beds"
                        :error="$errors->has('beds')"
                        :error-message="$errors->first('beds')"
                    />

                    <flux:input
                        wire:model="description"
                        name="description"
                        id="description"
                        type="text"

                        :label="__('Description')"
                        :value="$room->description"
                        :error="$errors->has('description')"
                        :error-message="$errors->first('description')"
                    />

                    <flux:select
                        wire:model="status"
                        name="status"
                        id="status"
                        :label="__('Status')"
                        :error="$errors->has('status')"
                        :error-message="$errors->first('status')"
                    >
                        @foreach (RoomStatus::values() as $v)
                            <option 
                                value="{{ $v }}"
                                {{ $room->status == $v ? 'selected' : '' }}
                            >
                                {{ efmt($v)  }}
                            </option>
                        @endforeach
                    </flux:select>

                    <flux:input
                        wire:model="floor"
                        name="floor"
                        id="floor"
                        type="text"

                        :label="__('Floor')"
                        :value="$room->floor"
                        :error="$errors->has('floor')"
                        :error-message="$errors->first('floor')"
                    />

                    <flux:input
                        wire:model="number"
                        name="number"
                        id="number"
                        type="text"

                        :label="__('Number')"
                        :value="$room->number"
                        :error="$errors->has('number')"
                        :error-message="$errors->first('number')"
                    />

            <!-- Submit and Cancel Buttons -->
            <div class="flex justify-between gap-4">
                <button type="button" onclick="history.back()"
                    class="inline-flex items-center rounded-md bg-red-800 px-8 py-2 text-sm font-medium text-gray-50 shadow hover:bg-red-700">
                    Cancel
                </button>
                <button type="submit"
                    class="inline-flex items-center rounded-md bg-green-600 px-8 py-2 text-sm font-medium text-white shadow hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                    Submit
                </button>
            </div>
        </form>
    </div>
</x-layouts.app>

