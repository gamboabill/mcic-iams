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

    public bool $shouldPoll = false;

    /**
     * ----------------------------------------------------
     *  EVENTS FROM CHILD COMPONENTS (CreateModal / EditModal / DeleteModal)
     * ----------------------------------------------------
     * These listeners capture success events dispatched
     * from the child modal components:
     *
     * - PermanentDeleteModal.php → department-permanent-success
     * - CreateModal.php → create-success
     * - EditModal.php → edit-success
     * - DeleteModal.php → delete-success
     * 
     * Purpose:
     *      Display flash messages in the Archived view.
     */
    protected $listeners = [
        'created-success' => 'createFlashMessage',
        'edit-success' => 'editFlashMessage',
        'edit-no-changes' => 'editNoChangesFlashMessage',
        'delete-success' => 'deleteFlashMessage',
    ];

    /**
     * ----------------------------
     * FLASH MESSAGE HANDLERS
     * Triggered by child components.
     * ----------------------------
     */
    public function createFlashMessage()
    {
        session()->flash('success', 'Department successfully created');
    }

    public function editFlashMessage()
    {
        session()->flash('success', 'Department successfully updated');
    }

    public function editNoChangesFlashMessage()
    {
        session()->flash('error', 'No changes were made to the department.');
    }

    public function deleteFlashMessage()
    {
        session()->flash('success', 'Department successfully deleted');
    }

    /**
     * ====================================================
     *  OPEN CHILD MODALS
     *  Called from buttons inside the Index table.
     * ====================================================
     *
     * These dispatch events to the child components:
     *      - CreateModal.php
     *      - EditModal.php
     *      - DeleteModal.php
     */
    public function openCreateModal()
    {
        $this->dispatch('open-create-modal');
    }

    public function openEditModal($id)
    {
        $this->dispatch('open-edit-modal', id: $id);
    }

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
