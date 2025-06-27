<x-layouts.app :title="__('Create Room')">
    <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200 py-4 uppercase border-b-2 border-b-gray-200 dark:border-b-neutral-700">
        {{ __('Create Room') }}
    </h2>

    <div class="flex w-full flex-1 flex-col gap-4 rounded-xl mt-8">
        <div class="flex items-center justify-between py-4 gap-4 flex-wrap">
            <x-button color="blue" onclick="history.back()">
                ← {{ __('Back')}}
            </x-button>
        </div>

        <form wire:submit.prevent="save" action="{{ route('rooms.store') }}" method="POST" class="space-y-6" >
            @csrf

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
                                {{ old('type') == $v ? 'selected' : '' }}
                            >
                                {{ efmt($v)  }}
                            </option>
                        @endforeach
                    </flux:select>

                    <flux:input
                        :label="__('Price')"
                        wire:model="price"
                        id="price"
                        name="price"
                        type="text"
                        required
                        value="{{ old('price') }}"
                        :error="$errors->has('price')"
                        :error-message="$errors->first('price')"
                    />

                    <flux:input
                        :label="__('Beds')"
                        wire:model="beds"
                        id="beds"
                        name="beds"
                        type="text"
                        required
                        value="{{ old('beds') }}"
                        :error="$errors->has('beds')"
                        :error-message="$errors->first('beds')"
                    />

                    <flux:input
                        :label="__('Description')"
                        wire:model="description"
                        id="description"
                        name="description"
                        type="text"
                        required
                        value="{{ old('description') }}"
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
                                {{ old('status') == $v ? 'selected' : '' }}
                            >
                                {{ efmt($v)  }}
                            </option>
                        @endforeach
                    </flux:select>

                    <flux:input
                        :label="__('Floor')"
                        wire:model="floor"
                        id="floor"
                        name="floor"
                        type="text"
                        required
                        value="{{ old('floor') }}"
                        :error="$errors->has('floor')"
                        :error-message="$errors->first('floor')"
                    />

                    <flux:input
                        :label="__('Number')"
                        wire:model="number"
                        id="number"
                        name="number"
                        type="text"
                        required
                        value="{{ old('number') }}"
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

