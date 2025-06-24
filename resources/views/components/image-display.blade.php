@props([
    'label' => 'Image',
    'src' => null,
    'size' => 'md', // Accepts: xs, sm, md, lg, xl
])

@php
    $hasImage = !empty($src);

    $sizeClasses = [
        'xs' => 'min-w-16 w-16 min-h-16 h-16',  // 64px
        'sm' => 'min-w-24 w-24 min-h-24 h-24',  // 96px
        'md' => 'min-w-40 w-40 min-h-40 h-40',  // 160px
        'lg' => 'min-w-60 w-60 min-h-60 h-60',  // 240px
        'xl' => 'min-w-80 w-80 min-h-80 h-80',  // 320px
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
            <div class="{{ $imageClass }} flex items-center justify-center rounded-lg border border-dashed border-gray-400 text-gray-400 dark:text-neutral-500 p-2 text-xs">
                {{ __('Not Available') }}
            </div>
        @endif
    </div>
</div>
