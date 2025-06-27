<div>

    <flux:navlist.item icon="" 
        :href="route('reservations.index')" 
        :current="request()->routeIs('reservations.index')" 
        :class="request()->routeIs('reservations.index') ? '' : '*:text-zinc-200 *:hover:text-zinc-400'" 
        wire:navigate
    >
        {{ __('Reservation History') }}
    </flux:navlist.item> 

    <flux:navlist.item icon="" 
        :href="route('reservations.create')" 
        :current="request()->routeIs('reservations.create')" 
        :class="request()->routeIs('reservations.create') ? '' : '*:text-zinc-200 *:hover:text-zinc-400 *:font-light'" 
        wire:navigate
    >
        {{ __('Make Reservation') }}
    </flux:navlist.item>

</div>
