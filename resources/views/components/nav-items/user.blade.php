<div>

    <flux:navlist.item icon="" 
        :href="route('reservations.my')" 
        :current="request()->routeIs('reservations.my')" 
        :class="request()->routeIs('reservations.my') ? '' : '*:text-zinc-200 *:hover:text-zinc-400'" 
        wire:navigate
    >
        {{ __('My Reservations') }}
    </flux:navlist.item> 

    {{-- <flux:navlist.item icon="" 
        :href="route('reservations.create')" 
        :current="request()->routeIs('reservations.create')" 
        :class="request()->routeIs('reservations.create') ? '' : '*:text-zinc-200 *:hover:text-zinc-400 *:font-light'" 
        wire:navigate
    >
        {{ __('Make Reservation') }}
    </flux:navlist.item> --}}

</div>
