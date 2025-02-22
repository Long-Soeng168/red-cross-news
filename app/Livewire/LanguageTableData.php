<?php

namespace App\Livewire;

use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

use App\Models\Language;

class LanguageTableData extends Component
{
    use WithPagination;

    #[Url(history: true)]
    public $search = '';

    #[Url(history: true)]
    public $perPage = 10;

    #[Url(history: true)]
    public $filter = 0;

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
        $this->resetPage();
    }

    public function delete($id)
    {
        $language = Language::find($id);
        $language->delete();

        session()->flash('success', 'Language successfully deleted!');
    }

     // ==========Add New Language============
     public $newName = null;
     public $newName_kh = null;

     public function save()
     {
         try {
             $validated = $this->validate([
                 'newName' => 'required|string|max:255|unique:languages,name',
             ]);

             Language::create([
                 'name' => $this->newName,
                 'name_kh' => $this->newName_kh,
             ]);

             session()->flash('success', 'Add New Language successfully!');

             $this->reset(['newName', 'newName_kh']);

         } catch (\Illuminate\Validation\ValidationException $e) {
             session()->flash('error', $e->validator->errors()->all());
         }
     }

     public $editId = null;
     public $name;
     public $name_kh;

     public function setEdit($id) {
        $language = Language::find($id);
        $this->editId = $id;
        $this->name = $language->name;
        $this->name_kh = $language->name_kh;
     }

     public function cancelUpdate() {
        $this->editId = null;
        $this->name = null;
        $this->name_kh = null;
     }

     public function update($id) {
        try {
            $validated = $this->validate([
                'name' => 'required|string|max:255|unique:languages,name,' . $id,
            ]);

            $language = Language::find($id);
            $language->update([
                'name' => $this->name,
                'name_kh' => $this->name_kh,
            ]);

            session()->flash('success', 'Language successfully edited!');

            $this->reset(['name', 'editId']);

        } catch (\Illuminate\Validation\ValidationException $e) {
            session()->flash('error', $e->validator->errors()->all());
        }
     }

    public function render(){

        $items = Language::where(function($query){
                                $query->where('name', 'LIKE', "%$this->search%");
                            })
                            ->orderBy($this->sortBy, $this->sortDir)
                            ->paginate($this->perPage);

        return view('livewire.language-table-data', [
            'items' => $items,
        ]);
    }
}
