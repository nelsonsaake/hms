<div>
    <flux:navlist.item icon="" 
        :href="route('rooms.index')" 
        :current="request()->routeIs('rooms.index')" 
        :class="request()->routeIs('rooms.index') ? '' : '*:text-zinc-200 *:hover:text-zinc-400 *:font-light'" 
        wire:navigate
    >
        {{ __('Rooms') }}
    </flux:navlist.item>
    <flux:navlist.item icon="" 
        :href="route('users.index')" 
        :current="request()->routeIs('users.index')" 
        :class="request()->routeIs('users.index') ? '' : '*:text-zinc-200 *:hover:text-zinc-400'" 
        wire:navigate
    >
        {{ __('Users') }}
    </flux:navlist.item>
    <flux:navlist.item icon="" 
        :href="route('bookings.index')" 
        :current="request()->routeIs('bookings.index')" 
        :class="request()->routeIs('bookings.index') ? '' : '*:text-zinc-200 *:hover:text-zinc-400'" 
        wire:navigate
    >
        {{ __('Bookings') }}
    </flux:navlist.item>
    <flux:navlist.item icon="" 
        :href="route('room_images.index')" 
        :current="request()->routeIs('room_images.index')" 
        :class="request()->routeIs('room_images.index') ? '' : '*:text-zinc-200 *:hover:text-zinc-400'" 
        wire:navigate
    >
        {{ __('Room Images') }}
    </flux:navlist.item>

</div>
