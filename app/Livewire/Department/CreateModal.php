<?php

namespace App\Livewire\Department;

use App\Models\Department;
use Livewire\Attributes\On;
use Livewire\Component;

class CreateModal extends Component
{

    public $openCreateModal = false;

    public $name;
    public $code;
    public $description;

    // Opens the create modal (triggered by Index parent component)
    #[On('open-create-modal')]
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

        // Notify parent component (Index.php)
        $this->dispatch('create-success');

        $this->reset();

        $this->openCreateModal = false;
    }

    public function render()
    {
        return view('livewire.department.create-modal');
    }
}
