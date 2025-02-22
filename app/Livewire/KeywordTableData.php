<?php

namespace App\Livewire;

use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

use App\Models\Keyword;

class KeywordTableData extends Component
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
        $keyword = Keyword::find($id);
        $keyword->delete();

        session()->flash('success', 'Keyword successfully deleted!');
    }

     // ==========Add New Keyword============
     public $newKeywordName = null;

     public function saveNewKeyword()
     {
         try {
             $validated = $this->validate([
                 'newKeywordName' => 'required|string|max:255|unique:keywords,name',
             ]);

             Keyword::create([
                 'name' => $this->newKeywordName,
             ]);

             session()->flash('success', 'Add New Keyword successfully!');

             $this->reset(['newKeywordName']);

         } catch (\Illuminate\Validation\ValidationException $e) {
             session()->flash('error', $e->validator->errors()->all());
         }
     }

     public $editId = null;
     public $name;

     public function setEdit($id) {
        $keyword = Keyword::find($id);
        $this->editId = $id;
        $this->name = $keyword->name;
     }

     public function cancelUpdateKeyword() {
        $this->editId = null;
        $this->name = null;
        $this->gender = null;
     }

     public function updateKeyword($id) {
        try {
            $validated = $this->validate([
                'name' => 'required|string|max:255|unique:keywords,name,' . $id,
            ]);

            $keyword = Keyword::find($id);
            $keyword->update([
                'name' => $this->name,
            ]);

            session()->flash('success', 'Keyword successfully edited!');

            $this->reset(['name', 'editId']);

        } catch (\Illuminate\Validation\ValidationException $e) {
            session()->flash('error', $e->validator->errors()->all());
        }
     }

    public function render(){

        $items = Keyword::where(function($query){
                                $query->where('name', 'LIKE', "%$this->search%");
                            })
                            ->orderBy($this->sortBy, $this->sortDir)
                            ->paginate($this->perPage);

        return view('livewire.keyword-table-data', [
            'items' => $items,
        ]);
    }
}
