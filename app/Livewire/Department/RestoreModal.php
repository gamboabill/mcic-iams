<?php

namespace App\Livewire\Department;

use App\Models\Department;
use Livewire\Component;

class RestoreModal extends Component
{
    /**
     * ===========================================================================
     *  PARENT COMPONENT RELATION
     * ===========================================================================
     *
     * This component is controlled by the parent:
     *      App\Livewire\Department\Archived
     *
     * The parent opens this modal using:
     *      $this->dispatch('open-restore-modal');
     *
     * After successful restoration, this component notifies the parent by dispatching:
     *      $this->dispatch('restore-success');
     *
     * The parent then handles flashing success messages.
     * ===========================================================================
     */
    protected $listeners = [
        'open-restore-modal' => 'openRestoreModal'
    ];

    public $name;
    public $departmentRestoreId = null;
    public $openRestoreModal = false;

    /**
     * OPEN MODAL
     * Triggered by parent Archived component.
     */
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
