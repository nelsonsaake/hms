<x-layouts.app :title="__('Create Reservation')">
    <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200 py-4 uppercase border-b-2 border-b-gray-200 dark:border-b-neutral-700">
        {{ __('Create Reservation') }}
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
        <div class="flex items-center justify-between py-4 gap-4 flex-wrap">
            <x-button color="blue" onclick="history.back()">
                ← {{ __('Back')}}
            </x-button>
        </div>

        <form wire:submit.prevent="save" action="{{ route('reservations.store') }}" method="POST" class="space-y-6" >
            @csrf
                    @php
                        $roomId = old('room_id', request('room_id'));
                    @endphp
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
                                {{ $roomId == $v->id ? 'selected' : '' }}
                            >
                                Room {{ $v->number }}, {{ efmt($v->type) }}, Floor {{ $v->floor }}
                            </option>
                        @endforeach
                    </flux:select>

                    <flux:input
                        :label="__('Guest Name')"
                        wire:model="guest_name"
                        id="guest_name"
                        name="guest_name"
                        type="text"
                        required
                        value="{{ old('guest_name', authUser()->name) }}"
                        :error="$errors->has('guest_name')"
                        :error-message="$errors->first('guest_name')"
                    />

                    <flux:input
                        :label="__('Guest Email')"
                        wire:model="guest_email"
                        id="guest_email"
                        name="guest_email"
                        type="text"
                        required
                        value="{{ old('guest_email', authUser()->email) }}"
                        :error="$errors->has('guest_email')"
                        :error-message="$errors->first('guest_email')"
                    />

                    <flux:input
                        :label="__('Guest Phone')"
                        wire:model="guest_phone"
                        id="guest_phone"
                        name="guest_phone"
                        type="text"
                        required
                        value="{{ old('guest_phone') }}"
                        :error="$errors->has('guest_phone')"
                        :error-message="$errors->first('guest_phone')"
                    />

                    <flux:input
                        :label="__('From Date (Optional)')"
                        wire:model="from_date"
                        id="from_date"
                        name="from_date"
                        type="date" 
                        value="{{ old('from_date') }}"
                        :error="$errors->has('from_date')"
                        :error-message="$errors->first('from_date')"
                    />

                    <flux:input
                        :label="__('To Date (Optional)')"
                        wire:model="to_date"
                        id="to_date"
                        name="to_date"
                        type="date" 
                        value="{{ old('to_date') }}"
                        :error="$errors->has('to_date')"
                        :error-message="$errors->first('to_date')"
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

