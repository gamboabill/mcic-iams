{{-- <div>
    @if ($openCreateModal)
    <div x-data @keyup.escape.window="$wire.set('openCreateModal', false)"
        class="fixed inset-0 bg-black/30 flex items-center justify-center z-50">

        <div @click.outside="$wire.set('openCreateModal', false)" x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100"
            class="bg-white p-6 rounded-lg w-full max-w-lg">

            <h2 class="text-xl font-bold mb-4">Edit Department</h2>

            <div class="space-y-3">
                <div>
                    <label>Name</label>
                    <input type="text" wire:model="name"
                        class="w-full border rounded p-2 @error('name') border-red-600 @else border-gray-300 @enderror transition duration-200 ">
                    @error('name') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label>Code</label>
                    <input type="text" wire:model="code"
                        class="w-full border rounded p-2 @error('code') border-red-600 @else border-gray-300 @enderror transition duration-200">
                    @error('code') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label>Description</label>
                    <textarea wire:model="description" class="w-full border rounded p-2"></textarea>
                </div>
            </div>

            <div class="mt-5 flex justify-end gap-3">
                <x-button click="$set('openCreateModal', false)" label="Cancel" px="4" py="2" type="outline" />
                <x-button click="saveDepartment" px="4" py="2" type="primary" label="Create" />
            </div>

        </div>
    </div>
    @endif
</div> --}}

<div x-data="{ open: @entangle('openCreateModal') }" @keyup.escape.window="open = false">

    <div x-show="open" x-transition.opacity class="fixed inset-0 bg-black/30 flex items-center justify-center z-50">

        <div @click.outside="$wire.set('openCreateModal', false)" x-show="open"
            x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 scale-90"
            x-transition:enter-end="opacity-100 scale-100" class="bg-white p-6 rounded-lg w-full max-w-lg">

            <h2 class="text-xl font-bold mb-4">Add Department</h2>

            <div class="space-y-3">
                <div>
                    <label>Name</label>
                    <input type="text" wire:model="name"
                        class="w-full border rounded p-2 @error('name') border-red-600 @else border-gray-300 @enderror transition duration-200 ">
                    @error('name') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label>Code</label>
                    <input type="text" wire:model="code"
                        class="w-full border rounded p-2 @error('code') border-red-600 @else border-gray-300 @enderror transition duration-200">
                    @error('code') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label>Description</label>
                    <textarea wire:model="description" class="w-full border rounded p-2"></textarea>
                </div>
            </div>

            <div class="mt-5 flex justify-end gap-3">
                <x-button click="$set('openCreateModal', false)" label="Cancel" px="4" py="2" type="outline" />
                <x-button click="saveDepartment" px="4" py="2" type="primary" label="Create" />
            </div>

        </div>
    </div>

</div>