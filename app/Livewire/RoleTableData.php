<?php

namespace App\Livewire;

use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleTableData extends Component
{
    use WithPagination;

    #[Url(history: true)]
    public $search = '';

    #[Url(history: true)]
    public $perPage = 10;

    #[Url(history: true)]
    public $filter = 0;

    #[Url(history: true)]
    public $sortBy = 'id';

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
        $this->resetPage();
    }

    public function delete($id)
    {
        $role = Role::find($id);
        $role->delete();

        session()->flash('success', 'Role successfully deleted!');
    }

     // ==========Add New Role============
     public $newRoleName = null;

     public function saveNewRole()
     {
         try {
             $validated = $this->validate([
                 'newRoleName' => 'required|string|max:255|unique:roles,name',
             ]);

             Role::create([
                 'name' => $this->newRoleName,
             ]);

             session()->flash('success', 'Add New Role successfully!');

             $this->reset(['newRoleName']);

         } catch (\Illuminate\Validation\ValidationException $e) {
             session()->flash('error', $e->validator->errors()->all());
         }
     }

     public $editId = null;
     public $name;

     public function setEdit($id) {
        $role = Role::find($id);
        $this->editId = $id;
        $this->name = $role->name;
     }

     public function cancelUpdateRole() {
        $this->editId = null;
        $this->name = null;
        $this->gender = null;
     }

     public function updateRole($id) {
        try {
            $validated = $this->validate([
                'name' => 'required|string|max:255|unique:roles,name,' . $id,
            ]);

            $role = Role::find($id);
            $role->update([
                'name' => $this->name,
            ]);

            session()->flash('success', 'Role successfully edited!');

            $this->reset(['name', 'editId']);

        } catch (\Illuminate\Validation\ValidationException $e) {
            session()->flash('error', $e->validator->errors()->all());
        }
     }

    public function render(){

        $items = Role::where(function($query){
                                $query->where('name', 'LIKE', "%$this->search%");
                            })
                            ->orderBy($this->sortBy, $this->sortDir)
                            ->paginate($this->perPage);

        return view('livewire.role-table-data', [
            'items' => $items,
        ]);
    }
}
