<x-layouts.app :title="__('Create Booking')">
    <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200 py-4 uppercase border-b-2 border-b-gray-200 dark:border-b-neutral-700">
        {{ __('Create Booking') }}
    </h2>

    <div class="flex w-full flex-1 flex-col gap-4 rounded-xl mt-8">
        <div class="flex items-center justify-between py-4 gap-4 flex-wrap">
            <x-button color="blue" onclick="history.back()">
                ← {{ __('Back')}}
            </x-button>
        </div>

        <form wire:submit.prevent="save" action="{{ route('bookings.store') }}" method="POST" class="space-y-6" >
            @csrf

                    <flux:select
                        wire:model="user_id"
                        name="user_id"
                        id="user_id"
                        :label="__('User')"
                        :error="$errors->has('user_id')"
                        :error-message="$errors->first('user_id')"
                    >
                        @foreach ($users as $v)
                            <option 
                                value="{{ $v->id }}"
                                {{ old('user_id') == $v->id ? 'selected' : '' }}
                            >
                                {{ $v->name ?? idfmt($v->id) }}
                            </option>
                        @endforeach
                    </flux:select>

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

                        <flux:input
                            :label="__('Check In')"
                            wire:model="check_in"
                            id="check_in"
                            name="check_in"
                            type="date"
                            required
                            value="{{ old('check_in', hdfmt(now())) }}"
                            :error="$errors->has('check_in')"
                            :error-message="$errors->first('check_in')"
                        />

                        <flux:input
                            :label="__('Check Out')"
                            wire:model="check_out"
                            id="check_out"
                            name="check_out"
                            type="date"
                            required
                            value="{{ old('check_out', hdfmt(now())) }}"
                            :error="$errors->has('check_out')"
                            :error-message="$errors->first('check_out')"
                        />

                    <flux:select
                        wire:model="status"
                        name="status"
                        id="status"
                        :label="__('Status')"
                        :error="$errors->has('status')"
                        :error-message="$errors->first('status')"
                    >
                        @foreach (BookingStatus::values() as $v)
                            <option 
                                value="{{ $v }}"
                                {{ old('status') == $v ? 'selected' : '' }}
                            >
                                {{ efmt($v)  }}
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
                        value="{{ old('guest_name') }}"
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
                        value="{{ old('guest_email') }}"
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
                            :label="__('From Date')"
                            wire:model="from_date"
                            id="from_date"
                            name="from_date"
                            type="date"
                            required
                            value="{{ old('from_date', hdfmt(now())) }}"
                            :error="$errors->has('from_date')"
                            :error-message="$errors->first('from_date')"
                        />

                        <flux:input
                            :label="__('To Date')"
                            wire:model="to_date"
                            id="to_date"
                            name="to_date"
                            type="date"
                            required
                            value="{{ old('to_date', hdfmt(now())) }}"
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

