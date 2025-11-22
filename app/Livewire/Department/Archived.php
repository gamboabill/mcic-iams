<?php

namespace App\Livewire\Department;

use App\Models\Department;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class Archived extends Component
{
    use WithPagination;

    public string $title = 'Archived Departments';

    public $search = '';

    // Shows flash message (triggered from child component, RestoreModal)
    #[On('restore-success')]
    public function restoreFlashMessage()
    {
        session()->flash('success', 'Department successfully restored!');
    }

    // Shows flash message (triggered from child component, PermanentDeleteModal)
    #[On('permanent-delete-success')]
    public function permanentDeleteFlashMessages()
    {
        session()->flash('success', 'Department successfully removed permanently!');
    }

    // Opens the restore modal (triggered from PermanentDeleteModal child)
    public function openRestoreModal($id)
    {
        $this->dispatch('open-restore-modal', id: $id);
    }

    // Opens the permanent delete modal (triggered from PermanentDeleteModal child)
    public function openPermanentDeleteModal($id)
    {
        $this->dispatch('open-permanent-delete-modal', id: $id);
    }

    /**
     * -----------------------------
     *  RENDER SOFT DELETES DEPARTMENT TABLE
     * -----------------------------
     */
    public function render()
    {
        $departments = Department::onlyTrashed()->orderBy('deleted_at', 'desc')->paginate(10);

        return view('livewire.department.archived', [
            'title' => $this->title,
            'departments' => $departments,
        ]);
    }
}
