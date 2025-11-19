<?php

namespace App\Livewire\Department;

use App\Models\Department;
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
            'name' => 'required|string|max:255|unique:departments,name',
            'code' => 'required|string|max:255|unique:departments,code',
            'description' => 'nullable|string|max:1000',
        ]);

        Department::find($this->editDepartmentId)->update([
            'name' => $this->name,
            'code' => $this->code,
            'description' => $this->description,
        ]);

        session()->flash('success', 'Department updated successfully');

        $this->dispatch('department-update-success');

        $this->openEditModal = false;
    }

    public function render()
    {
        return view('livewire.department.edit-modal');
    }
}
