<?php

namespace App\Livewire\Department;

use App\Models\Department;
use Livewire\Component;

class DeleteModal extends Component
{
    protected $listeners = [
        'open-delete-modal' => 'openDeleteModal',
    ];

    public $name;

    public $confirmingDeleteId = null;
    public $openDeleteModal = false;

    public function openDeleteModal($id)
    {
        $department = Department::findOrFail($id);

        $this->confirmingDeleteId = $id;

        $this->name = $department->name;

        $this->openDeleteModal = true;
    }

    /**
     * This is the actual delete query
     */
    public function deleteDepartment()
    {
        $department = Department::findOrFail($this->confirmingDeleteId);

        $department->delete();

        $this->dispatch('delete-success');

        $this->openDeleteModal = false;
    }

    public function render()
    {
        return view('livewire.department.delete-modal');
    }
}
