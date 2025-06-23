<div>

    <flux:navlist.item icon="" :href="route('rooms.index')" :current="request()->routeIs('rooms.index')" wire:navigate>
        {{ __('Rooms') }}
    </flux:navlist.item>

    <flux:navlist.item icon="" :href="route('users.index')" :current="request()->routeIs('users.index')" wire:navigate>
        {{ __('Users') }}
    </flux:navlist.item>

    <flux:navlist.item icon="" :href="route('bookings.index')" :current="request()->routeIs('bookings.index')" wire:navigate>
        {{ __('Bookings') }}
    </flux:navlist.item>

    <flux:navlist.item icon="" :href="route('room_images.index')" :current="request()->routeIs('room_images.index')" wire:navigate>
        {{ __('Room Images') }}
    </flux:navlist.item>

</div>
