<?php

namespace App\Livewire\Department;

use App\Models\Department;
use Livewire\Attributes\On;
use Livewire\Component;

class PermanentDeleteModal extends Component
{
    public $name;
    public $departmentPermanentDeleteId;
    public $openPermanentDeleteModal = false;

    // Opens the permanent delete modal (triggered by Archived parent component)
    #[On('open-permanent-delete-modal')]
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
        $this->dispatch('permanent-delete-success');

        $this->openPermanentDeleteModal = false;
    }

    public function render()
    {
        return view('livewire.department.permanent-delete-modal');
    }
}
