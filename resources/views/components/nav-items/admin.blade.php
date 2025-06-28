<div>

    <flux:navlist.item icon="" 
        :href="route('reservations.index', ['status' => BookingStatus::CONFIRMED])"
        :current="request()->routeIs('reservations.index')" 
        :class="request()->routeIs('reservations.index') ? '' : '*:text-zinc-200 *:hover:text-zinc-400'" 
        wire:navigate
    >
        {{ __('Reservations') }}
    </flux:navlist.item> 

    <flux:navlist.item icon="" 
        :href="route('rooms.available')"
        :current="request()->routeIs('rooms.available')" 
        :class="request()->routeIs('rooms.available') ? '' : '*:text-zinc-200 *:hover:text-zinc-400'" 
        wire:navigate
    >
        {{ __('Rooms') }}
    </flux:navlist.item> 

</div>


