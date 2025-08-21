<x-layouts.app :title="__('Update Booking')">
    <h2
        class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200 py-4 uppercase border-b-2 border-b-gray-200 dark:border-b-neutral-700">
        <div x-data="{ canGoBack: false }" x-init="canGoBack = history.length > 1">
            <span x-show="canGoBack" onclick="history.back()" class="pr-8 cursor-pointer mr-8 inline-block">
                ←
            </span>
            {{ __('Update Booking') }}
        </div>
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

        <form wire:submit.prevent="save" action="{{ route('bookings.update', $booking) }}" method="POST"
            class="space-y-6">
            @csrf
            @method('PUT')

            <flux:select wire:model="user_id" name="user_id" id="user_id" :label="__('User')"
                :error="$errors->has('user_id')" :error-message="$errors->first('user_id')">
                @foreach ($users as $v)
                    <option value="{{ $v->id }}" {{ $booking->user_id == $v->id ? 'selected' : '' }}>
                        {{ $v->name ?? idfmt($v->id) }}
                    </option>
                @endforeach
            </flux:select>

            <flux:select wire:model="room_id" name="room_id" id="room_id" :label="__('Room')"
                :error="$errors->has('room_id')" :error-message="$errors->first('room_id')">
                @foreach ($rooms as $v)
                    <option value="{{ $v->id }}" {{ $booking->room_id == $v->id ? 'selected' : '' }}>
                        {{ $v->name ?? idfmt($v->id) }}
                    </option>
                @endforeach
            </flux:select>

            <flux:input wire:model="check_in" name="check_in" id="check_in" type="date" :label="__('Check In')"
                :value="hdfmt($booking->check_in)" :error="$errors->has('check_in')"
                :error-message="$errors->first('check_in')" />

            <flux:input wire:model="check_out" name="check_out" id="check_out" type="date" :label="__('Check Out')"
                :value="hdfmt($booking->check_out)" :error="$errors->has('check_out')"
                :error-message="$errors->first('check_out')" />

            <flux:select wire:model="status" name="status" id="status" :label="__('Status')"
                :error="$errors->has('status')" :error-message="$errors->first('status')">
                @foreach (BookingStatus::values() as $v)
                    <option value="{{ $v }}" {{ $booking->status == $v ? 'selected' : '' }}>
                        {{ efmt($v) }}
                    </option>
                @endforeach
            </flux:select>

            <flux:input wire:model="guest_name" name="guest_name" id="guest_name" type="text"
                :label="__('Guest Name')" :value="$booking->guest_name" :error="$errors->has('guest_name')"
                :error-message="$errors->first('guest_name')" />

            <flux:input wire:model="guest_email" name="guest_email" id="guest_email" type="text"
                :label="__('Guest Email')" :value="$booking->guest_email" :error="$errors->has('guest_email')"
                :error-message="$errors->first('guest_email')" />

            <flux:input wire:model="guest_phone" name="guest_phone" id="guest_phone" type="number"
                :label="__('Guest Phone')" :value="$booking->guest_phone" :error="$errors->has('guest_phone')"
                :error-message="$errors->first('guest_phone')" />

            <flux:input wire:model="from_date" name="from_date" id="from_date" type="date" :label="__('From Date')"
                :value="hdfmt($booking->from_date)" :error="$errors->has('from_date')"
                :error-message="$errors->first('from_date')" />

            <flux:input wire:model="to_date" name="to_date" id="to_date" type="date" :label="__('To Date')"
                :value="hdfmt($booking->to_date)" :error="$errors->has('to_date')"
                :error-message="$errors->first('to_date')" />

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
