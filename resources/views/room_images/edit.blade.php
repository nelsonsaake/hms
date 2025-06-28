<x-layouts.app :title="__('Update Room Image')">
    <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200 py-4 uppercase border-b-2 border-b-gray-200 dark:border-b-neutral-700">
        <div x-data="{ canGoBack: false }" x-init="canGoBack = history.length > 1">
            <span
                x-show="canGoBack"
                onclick="history.back()"
                class="pr-8 cursor-pointer mr-8 inline-block"
            >
                ←
            </span>
            {{ __('Update Room Image') }}
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

        <form wire:submit.prevent="save" action="{{ route('room_images.update', $roomImage) }}"   enctype="multipart/form-data"  method="POST" class="space-y-6">
            @csrf
            @method('PUT')

                    <!-- Image Upload with Preview -->            
                    <x-image-picker 
                        label="Select Path" 
                        name="path" 
                        :src="$roomImage->url" 
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
                                {{ $roomImage->room_id == $v->id ? "selected" : "" }}
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

