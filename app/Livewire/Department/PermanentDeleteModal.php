<?php

namespace App\Livewire\Department;

use App\Models\Department;
use Livewire\Component;

class PermanentDeleteModal extends Component
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
     *      $this->dispatch('open-permanent-delete-modal');
     *
     * After successful restoration, this component notifies the parent by dispatching:
     *      $this->dispatch('delete-permanent-success');
     *
     * The parent then handles flashing success messages.
     * ===========================================================================
     */

    protected $listeners = [
        'open-permanent-delete-modal' => 'openPermanentDeleteModal',
    ];

    public $name;
    public $departmentPermanentDeleteId;
    public $openPermanentDeleteModal = false;

    /**
     * OPEN MODAL
     * Triggered by parent Archived component.
     */
    public function openPermanentDeleteModal($id)
    {
        $department = Department::onlyTrashed()->findOrFail($id);

        $this->departmentPermanentDeleteId = $id;

        $this->name = $department->name;

        $this->openPermanentDeleteModal = true;
    }

    /**
     * PERMANENT DELETE DEPARTMENT
     * Then notify parent component.
     */
    public function permanentDelete()
    {
        $department = Department::onlyTrashed()->findOrFail($this->departmentPermanentDeleteId);

        $department->forceDelete();

        // Notify parent component (Archived.php)
        $this->dispatch('delete-permanent-success');

        $this->openPermanentDeleteModal = false;
    }

    public function render()
    {
        return view('livewire.department.permanent-delete-modal');
    }
}
