<?php

namespace App\Livewire;

use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

use Spatie\Permission\Models\Permission;

class PermissionTableData extends Component
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
        $permission = Permission::find($id);
        $permission->delete();

        session()->flash('success', 'Permission successfully deleted!');
    }

     // ==========Add New Permission============
     public $newPermissionName = null;

     public function saveNewPermission()
     {
         try {
             $validated = $this->validate([
                 'newPermissionName' => 'required|string|max:255|unique:permissions,name',
             ]);

             Permission::create([
                 'name' => $this->newPermissionName,
             ]);

             session()->flash('success', 'Add New Permission successfully!');

             $this->reset(['newPermissionName']);

         } catch (\Illuminate\Validation\ValidationException $e) {
             session()->flash('error', $e->validator->errors()->all());
         }
     }

     public $editId = null;
     public $name;

     public function setEdit($id) {
        $permission = Permission::find($id);
        $this->editId = $id;
        $this->name = $permission->name;
     }

     public function cancelUpdatePermission() {
        $this->editId = null;
        $this->name = null;
        $this->gender = null;
     }

     public function updatePermission($id) {
        try {
            $validated = $this->validate([
                'name' => 'required|string|max:255|unique:permissions,name,' . $id,
            ]);

            $permission = Permission::find($id);
            $permission->update([
                'name' => $this->name,
            ]);

            session()->flash('success', 'Permission successfully edited!');

            $this->reset(['name', 'editId']);

        } catch (\Illuminate\Validation\ValidationException $e) {
            session()->flash('error', $e->validator->errors()->all());
        }
     }

    public function render(){

        $items = Permission::where(function($query){
                                $query->where('name', 'LIKE', "%$this->search%");
                            })
                            ->orderBy($this->sortBy, $this->sortDir)
                            ->paginate($this->perPage);

        return view('livewire.permission-table-data', [
            'items' => $items,
        ]);
    }
}
