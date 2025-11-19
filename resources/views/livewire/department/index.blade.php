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

        <x-button click="openCreateModal" bg="blue-500" px="2" py="2" label="Add Department" icon="fa fa-plus-circle"
            mt="3" />

        <input type="text" wire:model.live="search" placeholder="Search departments..."
            class="border rounded px-2 py-1 float-right mt-4">

        <div wire:listen="departmentCreated">
            <table class="min-w-full border border-gray-300 mt-5">
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
                        <td class="border px-4 py-2">{{ $departments->firstItem() + $loop->index }}</td>
                        <td class="border px-4 py-2">{{ $department->name }}</td>
                        <td class="border px-4 py-2">{{ $department->code }}</td>
                        <td class="border px-4 py-2">
                            <center>
                                <x-button click="openEditModal({{ $department->id }})" type="primary-outline"
                                    icon="fa fa-edit" px="2" py="1" /> |
                                <x-button click="openDeleteModal({{ $department->id }})" type="danger-outline"
                                    icon="fa fa-trash" px="2" py="1" />
                            </center>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="border px-4 py-2 text-center">No departments found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $departments->links() }}
        </div>

        <livewire:department.create-modal />

        <livewire:department.edit-modal />

        <livewire:department.delete-modal />

    </div>
</section>