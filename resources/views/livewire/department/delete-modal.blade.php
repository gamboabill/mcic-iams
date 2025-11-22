<div x-data="{ open: @entangle('openDeleteModal') }" @keyup.escape.window="open = false">

    <div x-show="open" x-transition.opacity class="fixed inset-0 bg-black/30 flex items-center justify-center z-50">

        <div @click.outside="$wire.set('openDeleteModal', false)" x-show="open"
            x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 scale-50"
            x-transition:enter-end="opacity-100 scale-100" class="bg-white p-6 rounded-lg w-full max-w-md">

            <h2 class="text-lg font-bold mb-3">Confirm Delete</h2>
            <p>Are you sure you want to delete <b>{{$name}}</b> department?</p>
            <br>

            <p>Archiving this department will remove it from the active list. Any users connected to this department
                will remain in the system. This action is
                reversible and you can restore the department at any time</p>

            <div class="mt-6 flex justify-end space-x-2">
                <x-button click="$set('openDeleteModal', false)" type="outline" label="Cancel" px="4" py="2" />
                <x-button click="deleteDepartment" type="danger" px="4" py="2" label="Delete" />
            </div>
        </div>
    </div>
</div>