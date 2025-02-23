<?php

namespace App\Livewire;

use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;


use App\Models\NewsCategory as Category;
use Image;

class NewsCategoryTableData extends Component
{
    use WithPagination;
    use WithFileUploads;


    public $image;


    #[Url(history: true)]
    public $search = '';

    #[Url(history: true)]
    public $perPage = 10;

    #[Url(history: true)]
    public $filter = 0;

    #[Url(history: true)]
    public $sortBy = 'order_index';

    #[Url(history: true)]
    public $sortDir = 'ASC';

    public function updatedImage()
    {
        $this->validate([
            'image' => 'image|max:2048', // 2MB Max
        ]);

        session()->flash('success', 'Image successfully uploaded!');
    }

    public function setFilter($value)
    {
        $this->filter = $value;
        $this->resetPage();
    }

    public function setSortBy($newSortBy)
    {
        if ($this->sortBy == $newSortBy) {
            $newSortDir = ($this->sortDir == 'DESC') ? 'ASC' : 'DESC';
            $this->sortDir = $newSortDir;
        } else {
            $this->sortBy = $newSortBy;
        }
    }

    // ResetPage when updated search
    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function delete($id)
    {
        $category = Category::find($id);
        $category->delete();

        session()->flash('success', 'Category successfully deleted!');
    }

    public function updateStatus($id, $status)
    {
        $getedItem = Category::findOrFail($id);
        $getedItem->update([
            'status' => $status,
        ]);

        session()->flash('success', 'Update Successfully!');
    }


    // ==========Add New Category============
    public $newName = null;
    public $newName_kh = null;
    public $newOrderIndex = null;

    public function save()
    {
        try {
            $validated = $this->validate([
                'newName' => 'required|string|max:255|unique:news_categories,name',
                'newName_kh' => 'required|string|max:255',
                'newOrderIndex' => 'nullable',
            ]);

            if (!empty($this->image)) {
                // $filename = time() . '_' . $this->image->getClientOriginalName();
                $filename = time() . str()->random(10) . '.' . $this->image->getClientOriginalExtension();
                $this->image->storeAs('assets/images/categories', $filename, 'real_public');
                $validated['image'] = $filename;
            }


            Category::create([
                'name' => $this->newName,
                'name_kh' => $this->newName_kh,
                'order_index' => $this->newOrderIndex,
                'image' => $filename ?? '',
            ]);

            session()->flash('success', 'Add New Category successfully!');

            $this->reset(['newName', 'newName_kh', 'newOrderIndex']);
            return redirect('/admin/bulletins_categories')->with('success', 'Add New Category successfully!');;
        } catch (\Illuminate\Validation\ValidationException $e) {
            session()->flash('error', $e->validator->errors()->all());
        }
    }

    public $editId = null;
    public $name;
    public $name_kh;
    public $order_index;

    public function setEdit($id)
    {
        $category = Category::find($id);
        $this->editId = $id;
        $this->name = $category->name;
        $this->name_kh = $category->name_kh;
        $this->order_index = $category->order_index;
    }

    public function cancelUpdate()
    {
        $this->editId = null;
        $this->name = null;
        $this->name_kh = null;
    }

    public function update($id)
    {
        try {
            $validated = $this->validate([
                'name' => 'required|string|max:255|unique:news_categories,name,' . $id,
                'name_kh' => 'required|string|max:255',
                'order_index' => 'nullable',
            ]);

            if (!empty($this->image)) {
                // $filename = time() . '_' . $this->image->getClientOriginalName();
                $filename = time() . str()->random(10) . '.' . $this->image->getClientOriginalExtension();
                $this->image->storeAs('assets/images/categories', $filename, 'real_public');
                $validated['image'] = $filename;
            }



            $category = Category::find($id);
            $category->update($validated);

            session()->flash('success', 'Category successfully edited!');

            $this->reset(['name', 'name_kh', 'editId', 'order_index']);
        } catch (\Illuminate\Validation\ValidationException $e) {
            session()->flash('error', $e->validator->errors()->all());
        }
    }

    public function render()
    {

        $items = Category::where(function ($query) {
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
