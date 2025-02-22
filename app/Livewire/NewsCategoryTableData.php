<?php

namespace App\Livewire;

use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

use App\Models\NewsCategory as Category;

class NewsCategoryTableData extends Component
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
        $category = Category::find($id);
        $category->delete();

        session()->flash('success', 'Category successfully deleted!');
    }

     // ==========Add New Category============
     public $newName = null;
     public $newName_kh = null;

     public function save()
     {
         try {
             $validated = $this->validate([
                 'newName' => 'required|string|max:255|unique:news_categories,name',
                 'newName_kh' => 'required|string|max:255',
             ]);

             Category::create([
                 'name' => $this->newName,
                 'name_kh' => $this->newName_kh,
             ]);

             session()->flash('success', 'Add New Category successfully!');

             $this->reset(['newName', 'newName_kh']);

         } catch (\Illuminate\Validation\ValidationException $e) {
             session()->flash('error', $e->validator->errors()->all());
         }
     }

     public $editId = null;
     public $name;
     public $name_kh;

     public function setEdit($id) {
        $category = Category::find($id);
        $this->editId = $id;
        $this->name = $category->name;
        $this->name_kh = $category->name_kh;
     }

     public function cancelUpdate() {
        $this->editId = null;
        $this->name = null;
        $this->name_kh = null;
        $this->gender = null;
     }

     public function update($id) {
        try {
            $validated = $this->validate([
                'name' => 'required|string|max:255|unique:news_categories,name,' . $id,
                'name_kh' => 'required|string|max:255',
            ]);

            $category = Category::find($id);
            $category->update([
                'name' => $this->name,
                'name_kh' => $this->name_kh,
            ]);

            session()->flash('success', 'Category successfully edited!');

            $this->reset(['name', 'name_kh', 'editId']);

        } catch (\Illuminate\Validation\ValidationException $e) {
            session()->flash('error', $e->validator->errors()->all());
        }
     }

    public function render(){

        $items = Category::where(function($query){
                                $query->where('name', 'LIKE', "%$this->search%")
                                ->orWhere('name_kh', 'LIKE', "%$this->search%");
                            })
                            ->orderBy($this->sortBy, $this->sortDir)
                            ->paginate($this->perPage);

        return view('livewire.news-category-table-data', [
            'items' => $items,
        ]);
    }
}
