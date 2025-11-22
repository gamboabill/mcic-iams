<div x-data="{ open: @entangle('openRestoreModal') }" x-cloak @keyup.escape.window="open = false">

    <div x-show="open" x-transition.opacity class="fixed inset-0 bg-black/30 flex items-center justify-center z-50">

        <div @click.outside="$wire.set('openRestoreModal', false)" x-show="open"
            x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 scale-50"
            x-transition:enter-end="opacity-100 scale-100" class="bg-white p-6 rounded-lg w-full max-w-md">
            <h2 class="text-lg font-bold mb-3">Confirm Restore</h2>
            <p>Are you sure you want to restore <b>{{$name}}</b> department?</p>

            <div class="mt-6 flex justify-end space-x-2">

                <x-button click="$set('openRestoreModal', false)" type="outline" label="Cancel" />

                <x-button click="restoreDepartment" type="success" label="Restore" hover="blue-600" />

            </div>
        </div>
    </div>
</div>