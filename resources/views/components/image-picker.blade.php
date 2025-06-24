@props([
'label' => 'Image',
'name' => 'image',
'required' => false,
'src' => null, // Accept existing image source
'error' => false,
'errorMessage' => '',
])

@php
$hasImage = !empty($src);
@endphp

<div>
    <label for="{{ $name }}" class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-1">
        {{ __($label) }}
    </label>

    <!-- Image Preview Area -->
    <div class="mt-2 flex items-end gap-2">

        <!-- Clickable Preview -->
        <div onclick="document.getElementById('{{  $name }}').click()" class="cursor-pointer">
            <img
                id="{{ $name }}-preview"
                src="{{ $hasImage ? $src : '#' }}"
                alt="Image Preview"
                class="{{ $hasImage ? '' : 'hidden' }} max-w-xs m-w-52 w-52 min-h-52 h-52 max-h-56 rounded-lg border border-gray-400 object-cover" />

            <div
                id="placeholder-{{ $name }}-preview"
                class="{{ $hasImage ? 'hidden' : '' }} max-w-xs h-52 w-52 rounded-lg border border-dashed border-gray-400 dark:bg-neutral-800 flex justify-center items-center text-gray-500 dark:text-neutral-400">
                Select Photo
            </div>
        </div>

        <!-- Icons -->
        <div class="flex flex-col items-center h-full py-2 px-1.5 dark:bg-neutral-100 border border-gray-400 rounded-md gap-3 mt-1">
            <!-- Select Icon -->
            <x-heroicon-o-photo
                onclick="document.getElementById('{{ $name }}').click()"
                class="text-neutral-800 hover:text-neutral-900 cursor-pointer size-5 stroke-2" />

            <!-- Clear Icon -->
            <x-heroicon-o-x-mark
                onclick="clearImage('{{ $name }}')"
                class="text-red-500 hover:text-red-600 cursor-pointer size-5 stroke-2" />
        </div>
    </div>

    @if ($error)
    <div class="text-red-700 mt-2">
        {{ $errorMessage }}
    </div>
    @endif

    <!-- Hidden File Input -->
    <input
        type="file"
        id="{{ $name }}"
        name="{{ $name }}"
        accept="image/*"
        onchange="previewImage(event, '{{ $name }}')"
        class="hidden"
        @if($required) required @endif>

    <!-- JavaScript -->
    <script>
        function previewImage(event, name) {
            const input = event.target;
            const preview = document.getElementById(`${name}-preview`);
            const placeholder = document.getElementById(`placeholder-${name}-preview`);

            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.classList.remove('hidden');
                    placeholder.classList.add('hidden');
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

        function clearImage(name) {
            const input = document.getElementById(name);
            const preview = document.getElementById(`${name}-preview`);
            const placeholder = document.getElementById(`placeholder-${name}-preview`);

            input.value = '';
            preview.src = '#';
            preview.classList.add('hidden');
            placeholder.classList.remove('hidden');
        }
    </script>
</div>