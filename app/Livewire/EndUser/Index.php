<?php

namespace App\Livewire\EndUser;

use Livewire\Component;

class Index extends Component
{
    public string $title = 'End User List';

    public function render()
    {
        return view('livewire.end-user.index', [
            'title' => $this->title,
        ]);
    }
}
