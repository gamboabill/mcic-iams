<?php

namespace App\Livewire\Department;

use App\Models\Department;
use Illuminate\Validation\Rule;
use Livewire\Attributes\On;
use Livewire\Component;

class EditModal extends Component
{
    public $openEditModal = false;

    public $editDepartmentId = null;
    public $name;
    public $code;
    public $description;

    // Opens the edit modal (triggered by Index parent component)
    #[On('open-edit-modal')]
    public function openEditModal($id)
    {
        $department = Department::findOrFail($id);

        if ($department) {
            $this->editDepartmentId = $id;
            $this->name = $department->name;
            $this->code = $department->code;
            $this->description = $department->description;

            $this->resetErrorBag();
            $this->openEditModal = true;
        }
    }

    public function updateDepartment()
    {
        $department = Department::findOrFail($this->editDepartmentId);

        if (
            $this->name === $department->name &&
            $this->code === $department->code &&
            $this->description === $department->description
        ) {
            // Notify parent component (Index.php)
            $this->dispatch('edit-no-changes');

            $this->openEditModal = false;
        } else {

            $this->Validate([
                'name' => 'required|string|max:255|' . Rule::unique('departments', 'name')->ignore($this->editDepartmentId),
                'code' => 'required|string|max:255|' . Rule::unique('departments', 'code')->ignore($this->editDepartmentId),
                'description' => 'nullable|string|max:1000',
            ]);

            Department::find($this->editDepartmentId)->update([
                'name' => $this->name,
                'code' => $this->code,
                'description' => $this->description,
            ]);

            // Notify parent component (Index.php)
            $this->dispatch('edit-success');

            $this->openEditModal = false;
        }
    }

    public function render()
    {
        return view('livewire.department.edit-modal');
    }
}
