<?php

namespace App\Livewire\Department;

use App\Models\Department;
use Livewire\Component;

class CreateModal extends Component
{
    protected $listeners = ['open-create-modal' => 'openCreateModal'];

    public $openCreateModal = false;

    public $name;
    public $code;
    public $description;

    public function openCreateModal()
    {
        $this->openCreateModal = true;
    }

    public function saveDepartment()
    {
        $data = $this->Validate([
            'name' => 'required|string|max:255|unique:departments,name',
            'code' => 'required|string|max:50|unique:departments,code',
            'description' => 'nullable|string|max:1000',
        ]);

        Department::create($data);

        session()->flash('success', 'Department created successfully!');

        $this->dispatch('created-success');

        $this->reset();

        $this->openCreateModal  = false;
    }

    public function render()
    {
        return view('livewire.department.create-modal');
    }
}
