<?php

namespace App\Livewire\Department;

use App\Models\Department;
use Livewire\Component;
use Livewire\WithPagination;

class Archived extends Component
{
    use WithPagination;
    public string $title = 'Archived Departments';

    /**
     * ----------------------------------------------------
     *  EVENTS FROM CHILD COMPONENTS (RestoreModal / PermanentDeleteModal)
     * ----------------------------------------------------
     * These listeners capture success events dispatched
     * from the child modal components:
     *
     * - PermanentDeleteModal.php → department-permanent-success
     * - RestoreModal → restore-success
     * 
     * Purpose:
     *      Display flash messages in the Archived view.
     */
    protected $listeners = [
        'restore-success' => 'restoreFlashMessage',
        'delete-permanent-success' => 'deletePermanentFlashMessage',
    ];

    /**
     * ----------------------------
     * FLASH MESSAGE HANDLERS
     * Triggered by child components.
     * ----------------------------
     */
    public function restoreFlashMessage()
    {
        session()->flash('success', 'Department successfully restored!');
    }

    public function deletePermanentFlashMessage()
    {
        session()->flash('success', 'Department successfully removed permanently!');
    }

    /**
     * ====================================================
     *  OPEN CHILD MODALS
     *  Called from buttons inside the Index table.
     * ====================================================
     *
     * These dispatch events to the child components:
     *      - RestoreModal
     *      - PermanentDeleteModal
     */
    public function openRestoreModal($id)
    {
        $this->dispatch('open-restore-modal', id: $id);
    }

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
        $departments = Department::onlyTrashed()->orderBy('deleted_at', 'desc')->get();

        return view('livewire.department.archived', [
            'title' => $this->title,
            'departments' => $departments,
        ]);
    }
}
