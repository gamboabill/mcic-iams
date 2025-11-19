<?php

namespace App\Livewire\Department;

use App\Models\Department;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public string $title = 'Department List';

    protected $listeners = [
        'department-created-success' => 'createFlashMessage',
        'department-update-success' => 'editFlashMessage',
        'delete-success' => 'deleteFlashMessage',
    ];

    public $search = '';

    #[On('departmentCreated')]
    public function refreshDepartment()
    {
        Department::orderBy('id', 'desc')->paginate(10);
    }


    public function createFlashMessage()
    {
        session()->flash('success', 'Department successfully created');
    }

    public function editFlashMessage()
    {
        session()->flash('success', 'Department successfully updated');
    }

    public function deleteFlashMessage()
    {
        session()->flash('success', 'Department successfully deleted');
    }


    public function openCreateModal()
    {
        $this->dispatch('open-create-modal');
    }

    public function openEditModal($id)
    {
        $this->dispatch('open-edit-modal', id: $id);
    }

    public function openDeleteModal($id)
    {
        $this->dispatch('open-delete-modal', id: $id);
    }




    public function updatingSearch()
    {
        $this->resetPage();
    }


    public function render()
    {
        $departments = Department::orderBy('id', 'desc')->paginate(10);

        $departments = Department::where('name', 'like', '%' . $this->search . '%')
            ->orWhere('code', 'like', '%' . $this->search . '%')
            ->orderBy('id', 'desc')
            ->paginate(10);


        return view('livewire.department.index', [
            'title' => $this->title,
            'departments' => $departments,
        ]);
    }
}
