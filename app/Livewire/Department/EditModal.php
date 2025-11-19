<?php

namespace App\Livewire\Department;

use App\Models\Department;
use Illuminate\Validation\Rule;
use Livewire\Component;

class EditModal extends Component
{
    protected $listeners = ['open-edit-modal' => 'openEditModal'];

    public $openEditModal = false;

    public $editDepartmentId = null;
    public $name;
    public $code;
    public $description;

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
        $this->Validate([
            'name' => 'required|string|max:255|' . Rule::unique('departments', 'name')->ignore($this->editDepartmentId),
            'code' => 'required|string|max:255|' . Rule::unique('departments', 'code')->ignore($this->editDepartmentId),
            'description' => 'nullable|string|max:1000',
        ]);

        $department = Department::findOrFail($this->editDepartmentId);


        Department::find($this->editDepartmentId)->update([
            'name' => $this->name,
            'code' => $this->code,
            'description' => $this->description,
        ]);


        if (
            $this->name === $department->name &&
            $this->code === $department->code &&
            $this->description === $department->description
        ) {
            // No changes
            $this->dispatch('edit-no-changes');
            $this->openEditModal = false;
        } else {
            $this->dispatch('edit-success');
            $this->openEditModal = false;
        }
    }

    public function render()
    {
        return view('livewire.department.edit-modal');
    }
}
