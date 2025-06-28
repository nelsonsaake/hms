<div>

    <flux:navlist.item icon="" 
        :href="route('bookings.report')"
        :current="request()->routeIs('bookings.report')" 
        :class="request()->routeIs('bookings.report') ? '' : '*:text-zinc-200 *:hover:text-zinc-400'" 
        wire:navigate
    >
        {{ __('Booking Report') }}
    </flux:navlist.item>  

</div>


