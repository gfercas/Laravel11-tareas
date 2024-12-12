<?php

namespace App\Livewire;

use App\Models\Task;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class TaskComponent extends Component
{
    public $user;
    public $tasks = [];
    public $modal = false;
    public $title;
    public $description;
    
    public function render()
    {
        return view('livewire.task-component');
    }

    public function mount(){
        $this->user = Auth::user()->name;
        $this->getTask();
    }

    public function getTask(){
        $this->tasks = Auth::user()->tasks;
    }

    public function clearFields(){
        $this->title = '';
        $this->description = '';
    }

    public function openCreateModal(){
        $this->clearFields();
        $this->modal = true;
    }

    public function closeCreateModal(){
        $this->modal = false;
    }

    public function createTask(){
        Task::create([
            'user_id' => Auth::id(),
            'title' => $this->title,
            'description' => $this->description
        ]);
        $this->closeCreateModal();
        $this->getTask();
    }
}
