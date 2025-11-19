@section('title', $title)

<section>

    @if (session('success'))
    <x-alert type="success" message="{{ session('success') }}" timeout="5000">
    </x-alert>
    @endif

    @if (session('error'))
    <x-alert type="error" message="{{ session('error') }}" timeout="5000">
    </x-alert>
    @endif

    <div>
        <div class="flex justify-between items-center mb-4">
            <h1 class="text-2xl font-bold">{{$title}}</h1>
        </div>
        <hr>

        <table class="min-w-full border border-gray-300 mt-4">
            <thead class="bg-gray-100">
                <tr>
                    <th class="border px-4 py-2">No</th>
                    <th class="border px-4 py-2">Name</th>
                    <th class="border px-4 py-2">Code</th>
                    <th class="border px-4 py-2 w-28">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($departments as $department)
                <tr>
                    <td class="border px-4 py-2">{{ $loop->iteration }}</td>
                    <td class="border px-4 py-2">{{ $department->name }}</td>
                    <td class="border px-4 py-2">{{ $department->code }}</td>
                    <td class="border px-4 py-2">
                        <center>
                            <x-button click="openRestoreModal({{$department->id}})" type="success-outline" px="2" py="1"
                                icon="fa fa-undo" /> |
                            <x-button click="openPermanentDeleteModal({{ $department->id }})" type="danger-outline"
                                icon="fa fa-times" px="2" py="1" />
                        </center>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="border px-4 py-2 text-center">No deleted departments found.</td>
                </tr>
                @endforelse
            </tbody>

        </table>

        <livewire:department.permanent-delete-modal />

        <livewire:department.restore-modal />

    </div>
</section>