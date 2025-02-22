<?php

namespace App\Livewire;

use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\File;

class UserTableData extends Component
{
    use WithPagination;

    #[Url(history: true)]
    public $search = '';

    #[Url(history: true)]
    public $perPage = 10;

    #[Url(history: true)]
    public $filter = '';

    #[Url(history: true)]
    public $sortBy = 'created_at';

    #[Url(history: true)]
    public $sortDir = 'DESC';

    public function setFilter($value) {
        $this->filter = $value;
        $this->resetPage();
    }

    public function setSortBy($newSortBy) {
        if($this->sortBy == $newSortBy){
            $newSortDir = ($this->sortDir == 'DESC') ? 'ASC' : 'DESC';
            $this->sortDir = $newSortDir;
        }else{
            $this->sortBy = $newSortBy;
        }
    }

    // ResetPage when updated search
    public function updatedSearch() {
        $this->dispatch('livewire:updated');
        $this->resetPage();

    }
    public function updatingPage(){
        $this->dispatch('livewire:updated');
    }


    public function delete($id) {
        $user = User::findOrFail($id);
        $user->delete();

        session()->flash('success', 'Delete Successfully!');
    }

    public function render(){

        $items = User::where(function($query) {
                            $query->where('name', 'LIKE', "%{$this->search}%")
                                ->orWhere('gender', 'LIKE', "%{$this->search}%")
                                ->orWhere('phone', 'LIKE', "%{$this->search}%")
                                ->orWhere('email', 'LIKE', "%{$this->search}%");
                        })
                        ->when($this->filter != '', function($query) {
                            $query->whereHas('roles', function ($q) {
                                $q->where('name', $this->filter);
                            });
                        })
                        ->orderBy($this->sortBy, $this->sortDir)
                        ->paginate($this->perPage);

        $categories = Role::latest()->get();
        $selectedCategory = Role::find($this->filter);

        return view('livewire.user-table-data', [
            'items' => $items,
            'categories' => $categories,
            'selectedCategory' => $selectedCategory,
        ]);
    }
}
