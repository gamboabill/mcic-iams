<div>
    @if ($openPermanentDeleteModal)
    <div x-data @keyup.escape.window="$wire.set('openPermanentDeleteModal', false)"
        class="fixed inset-0 flex items-center justify-center bg-black/30 z-50">
        <div @click.outside="$wire.set('openPermanentDeleteModal', false)" class="bg-white p-6 rounded shadow-lg w-96">
            <h2 class="text-lg font-bold mb-3">Confirm Delete</h2>
            <p>Are you sure you want to permanently delete <b>{{$name}}</b> department? </p>
            <br>
            <p>Deleting this department is permanent. All users linked to this department will also be permanently
                deleted. This action cannot be undone. Do you want to continue? </p>

            <div class="mt-6 flex justify-end space-x-2">

                <x-button click="$set('openPermanentDeleteModal', false)" type="outline" px="4" py="2" label="Cancel" />

                <x-button click="permanentDelete" type="danger" px="4" py="2" label="Delete" />

            </div>
        </div>
    </div>
    @endif
</div>