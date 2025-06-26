<x-layouts.app :title="__('Create User')">
    <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200 py-4 uppercase border-b-2 border-b-gray-200 dark:border-b-neutral-700">
        {{ __('Create User') }}
    </h2>

    <div class="flex w-full flex-1 flex-col gap-4 rounded-xl mt-8">
        <div class="flex items-center justify-between py-4 gap-4 flex-wrap">
            <x-button color="blue" onclick="history.back()">
                ← {{ __('Back')}}
            </x-button>
        </div>

        <form wire:submit.prevent="save" action="{{ route('users.store') }}" method="POST" class="space-y-6" >
            @csrf

                    <flux:input
                        :label="__('Name')"
                        wire:model="name"
                        id="name"
                        name="name"
                        type="text"
                        required
                        value="{{ old('name') }}"
                        :error="$errors->has('name')"
                        :error-message="$errors->first('name')"
                    />

                    <flux:input
                        :label="__('Email')"
                        wire:model="email"
                        id="email"
                        name="email"
                        type="text"
                        required
                        value="{{ old('email') }}"
                        :error="$errors->has('email')"
                        :error-message="$errors->first('email')"
                    />

            <!-- Submit and Cancel Buttons -->
            <div class="flex justify-between gap-4">
                <button type="button" onclick="history.back()"
                    class="inline-flex items-center rounded-md bg-red-800 px-8 py-2 text-sm font-medium text-gray-50 shadow hover:bg-red-700">
                    Cancel
                </button>
                <button type="submit"
                    class="inline-flex items-center rounded-md bg-green-600 px-8 py-2 text-sm font-medium text-white shadow hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                    Submit
                </button>
            </div>
        </form>
    </div>
</x-layouts.app>

