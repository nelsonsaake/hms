<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Blue Top Hotel</title>
    <link rel="icon" href="/favicon.ico" sizes="any">
    <link rel="icon" href="/favicon.svg" type="image/svg+xml">
    <link rel="apple-touch-icon" href="/apple-touch-icon.png">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body 
    class="bg-gray-100 text-gray-900 font-instrument-sans bg-repeat" 
    style="background-image: url('/bg.jpg'); background-size: 18%"
>

    <!-- Header -->
    <header class="bg-white shadow">
        <div class="container mx-auto px-6 py-4 flex items-center justify-between">
            <h1 class="text-2xl font-bold text-blue-900">Blue Top Hotel</h1>
            @if (Route::has('login'))
                <nav class="space-x-6 text-sm">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="text-gray-600 hover:text-blue-950">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="text-gray-600 hover:text-blue-950">Log in</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="text-gray-600 hover:text-blue-950">Register</a>
                        @endif
                    @endauth
                </nav>
            @endif
        </div>
    </header>

    <!-- Hero -->
    <section class="relative h-[70vh] bg-cover bg-center" style="background-image: url('/hero-1280x853.jpg')">
        <div class="absolute inset-0 bg-black bg-opacity-40"></div>
        <div class="relative z-10 container mx-auto h-full flex flex-col justify-center items-center text-center px-4">
            <h2 class="text-5xl md:text-6xl font-extrabold text-white mb-4">Relax. Recharge. Reconnect.</h2>
            <p class="text-lg md:text-xl text-gray-100 mb-8 max-w-xl">
                Experience modern comfort and unforgettable stays in every room at Blue Top Hotel.
            </p>
            <a href="#rooms"
                class="bg-blue-900 hover:bg-blue-950 text-white px-8 py-3 text-sm rounded-full font-medium transition">
                View Rooms
            </a>
        </div>
    </section>

    <!-- Rooms Showcase -->
    <section id="rooms" class="py-16">
        <div class="container mx-auto px-6">
            <h3 class="text-3xl md:text-4xl font-semibold text-center mb-12 text-blue-900">Our Rooms</h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse ($rooms as $room)
                    <div class="rounded-xl overflow-hidden shadow-md hover:shadow-xl transition bg-white">
                        <img loading="lazy" src="{{ $room->roomImages?->first()?->url ?? '/images/default-room.jpg' }}"
                            alt="{{ $room->type }}" class="w-full h-56 object-cover">
                        <div class="p-6 flex flex-col justify-between">
                            <h4 class="text-xl font-semibold capitalize">{{ str_replace('_', ' ', $room->type) }}</h4>
                            <p class="text-gray-600 mt-2 mb-4 text-sm">{{ $room->description }}</p>
                            <div class="flex items-center justify-between">
                                <span class="text-xl font-bold">GH₵{{ nfmt($room->price) }}</span>
                                <a href="{{ route('bookings.create', $room->id) }}"
                                    class="bg-blue-900 hover:bg-blue-950 text-white text-sm px-4 py-2 rounded-full font-medium transition">
                                    Book Now
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="col-span-full text-center text-gray-500">No rooms available right now.</p>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-white py-8 mt-12 shadow-inner">
        <div class="container mx-auto text-center text-gray-600 text-sm">
            &copy; {{ date('Y') }} Blue Top Hotel. All Rights Reserved.
        </div>
    </footer>

</body>

</html>
