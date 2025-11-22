<?php

namespace App\Livewire\Department;

use App\Models\Department;
use Livewire\Attributes\On;
use Livewire\Component;

class DeleteModal extends Component
{

    public $name;

    public $confirmingDeleteId = null;
    public $openDeleteModal = false;

    // Opens the delete confirmation modal (triggered by Index parent component)
    #[On('open-delete-modal')]
    public function openDeleteModal($id)
    {
        $department = Department::findOrFail($id);

        $this->confirmingDeleteId = $id;

        $this->name = $department->name;

        $this->openDeleteModal = true;
    }

    public function deleteDepartment()
    {
        $department = Department::findOrFail($this->confirmingDeleteId);

        $department->delete();

        // Notify parent component (Index.php)
        $this->dispatch('delete-success');

        $this->openDeleteModal = false;
    }

    public function render()
    {
        return view('livewire.department.delete-modal');
    }
}
