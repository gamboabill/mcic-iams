<?php

namespace App\Livewire\Department;

use App\Models\Department;
use Livewire\Attributes\On;
use Livewire\Component;

class RestoreModal extends Component
{

    public $name;
    public $departmentRestoreId = null;
    public $openRestoreModal = false;


    // Opens the restore modal (triggered by Archived parent component)
    #[On('open-restore-modal')]
    public function openRestoreModal($id)
    {
        $department = Department::onlyTrashed()->findOrFail($id);

        $this->departmentRestoreId = $id;

        $this->name = $department->name;

        $this->openRestoreModal = true;
    }

    /**
     * RESTORE DEPARTMENT
     * Then notify parent component.
     */
    public function restoreDepartment()
    {
        $department = Department::onlyTrashed()->findOrFail($this->departmentRestoreId);

        $department->restore();

        // Notify parent component (Archived.php)
        $this->dispatch('restore-success');

        $this->openRestoreModal = false;
    }

    public function render()
    {
        return view('livewire.department.restore-modal');
    }
}
