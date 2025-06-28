<div>

    <flux:navlist.item icon="" 
        :href="route('dashboard.reservations', ['status' => BookingStatus::CONFIRMED])"
        :current="request()->routeIs('dashboard.reservations')" 
        :class="request()->routeIs('dashboard.reservations') ? '' : '*:text-zinc-200 *:hover:text-zinc-400'" 
        wire:navigate
    >
        {{ __('Reservations') }}
    </flux:navlist.item> 

    <flux:navlist.item icon="" 
        :href="route('dashboard.rooms', ['status' => RoomStatus::AVAILABLE])"
        :current="request()->routeIs('dashboard.rooms')" 
        :class="request()->routeIs('dashboard.rooms') ? '' : '*:text-zinc-200 *:hover:text-zinc-400'" 
        wire:navigate
    >
        {{ __('Rooms') }}
    </flux:navlist.item> 

</div>


