<?php

namespace App\Livewire\Department;

use App\Models\Department;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public string $title = 'Department List';

    public $search = '';

    // Shows flash message (triggered from child component, CreateModal)
    #[On('create-success')]
    public function createFlashMessage()
    {
        session()->flash('success', 'Department successfully created');
    }

    // Shows flash message (triggered from child component, EditModal)
    #[On('edit-success')]
    public function editFlashMessage()
    {
        session()->flash('success', 'Department successfully updated');
    }

    // Shows flash message (triggered from child component, EditModal)
    #[On('edit-no-changes')]
    public function editNoChangesFlashMessage()
    {
        session()->flash('error', 'No changes were made to the department.');
    }

    // Shows flash message (triggered from child component, DeleteModal)
    #[On('delete-success')]
    public function deleteFlashMessage()
    {
        session()->flash('success', 'Department successfully deleted');
    }

    // Opens the restore modal (triggered from CreateModal child)
    public function openCreateModal()
    {
        $this->dispatch('open-create-modal');
    }

    // Opens the restore modal (triggered from EditModal child)
    public function openEditModal($id)
    {
        $this->dispatch('open-edit-modal', id: $id);
    }

    // Opens the restore modal (triggered from DeleteModal child)
    public function openDeleteModal($id)
    {
        $this->dispatch('open-delete-modal', id: $id);
    }

    /**
     * Refresh table data automatically.
     *
     * This method is triggered by wire:poll to keep the table updated
     * without requiring a manual reload. Useful when departments are
     * created/edited/deleted from other components or other users.
     */
    public function refreshDepartment()
    {
        Department::orderBy('id', 'desc')->paginate(10);
    }

    /**
     * Reset pagination whenever the search term changes.
     *
     * Prevents the table from showing empty results when the user
     * is on a higher page number and starts searching. Returning
     * to page 1 ensures the correct data always appears.
     */
    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $departments = Department::orderBy('id', 'desc')->paginate(10);

        $departments = Department::where('name', 'like', '%' . $this->search . '%')
            ->orWhere('code', 'like', '%' . $this->search . '%')
            ->orderBy('id', 'desc')
            ->paginate(10);


        return view('livewire.department.index', [
            'title' => $this->title,
            'departments' => $departments,
        ]);
    }
}
