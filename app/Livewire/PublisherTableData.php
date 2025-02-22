<?php

namespace App\Livewire;

use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

use App\Models\Publisher;

class PublisherTableData extends Component
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
        $publisher = Publisher::find($id);
        $publisher->delete();

        session()->flash('success', 'Publisher successfully deleted!');
    }

     // ==========Add New Publisher============
     public $newPublisherName = null;
     public $newPublisherGender = null;

     public function saveNewPublisher()
     {
         try {
             $validated = $this->validate([
                 'newPublisherName' => 'required|string|max:255|unique:publishers,name',
             ]);

             Publisher::create([
                 'name' => $this->newPublisherName,
                 'gender' => $this->newPublisherGender,
             ]);

             session()->flash('success', 'Add New Publisher successfully!');

             $this->reset(['newPublisherName', 'newPublisherGender']);

         } catch (\Illuminate\Validation\ValidationException $e) {
             session()->flash('error', $e->validator->errors()->all());
         }
     }

     public $editId = null;
     public $name;
     public $gender;

     public function setEdit($id) {
        $publisher = Publisher::find($id);
        $this->editId = $id;
        $this->name = $publisher->name;
        $this->gender = $publisher->gender;
     }

     public function cancelUpdatePublisher() {
        $this->editId = null;
        $this->name = null;
        $this->gender = null;
     }

     public function updatePublisher($id) {
        try {
            $validated = $this->validate([
                'name' => 'required|string|max:255|unique:publishers,name,' . $id,
            ]);

            $publisher = Publisher::find($id);
            $publisher->update([
                'name' => $this->name,
                'gender' => $this->gender,
            ]);

            session()->flash('success', 'Publisher successfully edited!');

            $this->reset(['name', 'gender', 'editId']);

        } catch (\Illuminate\Validation\ValidationException $e) {
            session()->flash('error', $e->validator->errors()->all());
        }
     }

    public function render(){

        $items = Publisher::where(function($query){
                                $query->where('name', 'LIKE', "%$this->search%");
                            })
                            ->orderBy($this->sortBy, $this->sortDir)
                            ->paginate($this->perPage);

        return view('livewire.publisher-table-data', [
            'items' => $items,
        ]);
    }
}
