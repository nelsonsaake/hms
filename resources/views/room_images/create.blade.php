<x-layouts.app :title="__('Create Room Image')">
    <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200 py-4 uppercase border-b-2 border-b-stone-700">
        {{ __('Create Room Image') }}
    </h2>

    <div class="flex w-full flex-1 flex-col gap-4 rounded-xl mt-8">
        <div class="flex items-center justify-between py-4 gap-4 flex-wrap">
            <button type="button" onclick="history.back()"
                class="inline-flex items-center rounded-lg bg-blue-600 px-4 py-2 text-sm font-medium text-gray-800 shadow hover:bg-blue-500 dark:bg-neutral-700 dark:text-white dark:hover:bg-neutral-600">
                ← Back
            </button>
        </div>

        <form wire:submit.prevent="save" action="{{ route('room_images.store') }}" method="POST" class="space-y-6">
            @csrf

                    <flux:input
                        :label="__('Path')"
                        wire:model="path"
                        id="path"
                        name="path"
                        type="text"
                        required
                        value="{{ old('path') }}"
                        :error="$errors->has('path')"
                        :error-message="$errors->first('path')"
                    />

                    <flux:select
                        wire:model="room_id"
                        name="room_id"
                        id="room_id"
                        :label="__('Room')"
                        :error="$errors->has('room_id')"
                        :error-message="$errors->first('room_id')"
                    >
                        @foreach ($rooms as $v)
                            <option 
                                value="{{ $v->id }}"
                                {{ old('room_id') == $v->id ? 'selected' : '' }}
                            >
                                {{ $v->name ?? idfmt($v->id) }}
                            </option>
                        @endforeach
                    </flux:select>

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

