<?php

namespace App\Livewire;

use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

use App\Models\Database;

class DatabaseTableData extends Component
{
    use WithPagination;

    #[Url(history: true)]
    public $search = '';

    #[Url(history: true)]
    public $perPage = 10;

    #[Url(history: true)]
    public $sortBy = 'order_index';

    #[Url(history: true)]
    public $sortDir = 'ASC';

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
    public function delete($id) {
        $item = Database::findOrFail($id);
        if($item->slug && !$item->link) {
            session()->flash('success', 'Cannot Delete!');
            return;
        }
        $item->delete();

        session()->flash('success', 'Successfully deleted!');
    }

    // ResetPage when updated search
    public function updatedSearch() {
        $this->resetPage();
    }
    public function toggleActive($id) {
        $database = Database::findOrFail($id);
        $database->update([
            'status' => !$database->status,
        ]);
        session()->flash('success', 'Successfully updated!');
        return redirect('/admin/settings/databases');
    }

    public function render(){

        $items = Database::where(function($query){
                                $query->where('name', 'LIKE', "%$this->search%")
                                    ->orWhere('name_kh', 'LIKE', "%$this->search%");
                            })

                            ->orderBy($this->sortBy, $this->sortDir)
                            ->paginate($this->perPage);

        return view('livewire.database-table-data', [
            'items' => $items,
        ]);
    }
}
