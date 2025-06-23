@props([
    'label' => 'Image',
    'src' => null,
    'size' => 'md', // Accepts: xs, sm, md, lg, xl
])

@php
    $hasImage = !empty($src);

    $sizeClasses = [
        'xxs' => 'w-10 h-10',  // 40px
        'xs' => 'w-16 h-16',  // 64px
        'sm' => 'w-24 h-24',  // 96px
        'md' => 'w-40 h-40',  // 160px
        'lg' => 'w-60 h-60',  // 240px
        'xl' => 'w-80 h-80',  // 320px
    ];

    $imageClass = $sizeClasses[$size] ?? $sizeClasses['md'];
@endphp

<div>
    <label class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-1">
        {{ __($label) }}
    </label>

    <div class="mt-2">
        @if ($hasImage)
            <img
                src="{{ $src }}"
                alt="Image"
                class="{{ $imageClass }} rounded-lg border border-gray-400 object-cover" />
        @else
            <div class="{{ $imageClass }} flex items-center justify-center rounded-lg border border-dashed border-gray-400 text-gray-400 dark:text-neutral-500">
                {{ __('No image available') }}
            </div>
        @endif
    </div>
</div>
