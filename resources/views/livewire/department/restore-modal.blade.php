<div>
    @if ($openRestoreModal)
    <div x-data @keyup.escape.window="$wire.set('openRestoreModal', false)"
        class="fixed inset-0 flex items-center justify-center bg-black/30 z-50">
        <div @click.outside="$wire.set('openRestoreModal', false)" class="bg-white p-6 rounded shadow-lg w-96">
            <h2 class="text-lg font-bold mb-3">Confirm Restore</h2>
            <p>Are you sure you want to restore <b>{{$name}}</b> department?</p>

            <div class="mt-6 flex justify-end space-x-2">

                <x-button click="$set('openRestoreModal', false)" type="outline" label="Cancel" />

                <x-button click="restoreDepartment" type="success" label="Restore" hover="blue-600" />

            </div>
        </div>
    </div>
    @endif
</div>