<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Url;
use Livewire\WithPagination;

use App\Models\News as Archive;
use App\Models\NewsCategory as Category;
use App\Models\NewsSubCategory as SubCategory;

class NewsIndex extends Component
{
    // Start Category Filter
    public $selected_categories = [];
    public $selected_categories_item = [];

    public function handleSelectCategory($id)
    {
        $item = Category::findOrFail($id);
        if (in_array($id, $this->selected_categories)) {
            $this->selected_categories = array_diff($this->selected_categories, [$id]);
            $this->selected_categories_item = array_filter($this->selected_categories_item, function ($i) use ($item) {
                return $i->id !== $item->id;
            });
        } else {
            $this->selected_categories[] = $id;
            $this->selected_categories_item[] = $item;
        }
    }

    public $selected_sub_categories = [];
    public $selected_sub_categories_item = [];

    public function handleSelectSubCategory($id)
    {
        $item = SubCategory::findOrFail($id);
        if (in_array($id, $this->selected_sub_categories)) {
            $this->selected_sub_categories = array_diff($this->selected_sub_categories, [$id]);
            $this->selected_sub_categories_item = array_filter($this->selected_sub_categories_item, function ($i) use ($item) {
                return $i->id !== $item->id;
            });
        } else {
            $this->selected_sub_categories[] = $id;
            $this->selected_sub_categories_item[] = $item;
        }
    }

    public function handleRemoveCategoryName($item)
    {
         if (app()->getLocale() == 'kh' && $item['name_kh']) {
            $this->dispatch('livewire:updatedName', $item['name_kh']);
        } else {
            $this->dispatch('livewire:updatedName', $item['name']);
        }
        // Remove the item from the selected_categories_item array
        $this->selected_categories_item = array_filter($this->selected_categories_item, function ($i) use ($item) {
            return $i->id !== $item['id'];
        });
        // Remove the associated ID from the selected_categories array
        $this->selected_categories = array_filter($this->selected_categories, function ($id) use ($item) {
            return $id !== $item['id'];
        });
    }

    public function handleRemoveSubCategoryName($item)
    {
         if (app()->getLocale() == 'kh' && $item['name_kh']) {
            $this->dispatch('livewire:updatedName', $item['name_kh']);
        } else {
            $this->dispatch('livewire:updatedName', $item['name']);
        }
        // Remove the item from the selected_sub_categories_item array
        $this->selected_sub_categories_item = array_filter($this->selected_sub_categories_item, function ($i) use ($item) {
            return $i->id !== $item['id'];
        });
        // Remove the associated ID from the selected_sub_categories array
        $this->selected_sub_categories = array_filter($this->selected_sub_categories, function ($id) use ($item) {
            return $id !== $item['id'];
        });
    }
    // End Category Filter

    // public function update() {
    //     $this->dispatch('livewire:updated');
    // }

    public function handleClearAllFilter() {
        $this->dispatch('livewire:updatedClearAllFilter');
        $this->selected_categories = [];
        $this->selected_categories_item = [];
        $this->selected_sub_categories = [];
        $this->selected_sub_categories_item = [];
    }

    #[Url(history: true)]
    public $search = '';

    public $perPage = 25;

    use WithPagination;
    public function updatingPage(){
        $this->dispatch('livewire:updatedPage');
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function updatedSelectedCategories()
    {
        $this->resetPage();
    }

    public function updatedSelectedSubCategories()
    {
        $this->resetPage();
    }

    public function placeholder()
    {
        return view('client.placeholder.index');
    }

    public function render()
    {
        $query = Archive::query();

        if (!empty($this->selected_categories) && empty($this->selected_sub_categories)) {
            $query->where(function ($subQuery) {
                $subQuery->whereIn('news_category_id', $this->selected_categories);
            });
        }elseif (empty($this->selected_categories) && !empty($this->selected_sub_categories)) {
            $query->where(function ($subQuery) {
                $subQuery->whereIn('news_sub_category_id', $this->selected_sub_categories);
            });
        }elseif(!empty($this->selected_categories) && !empty($this->selected_sub_categories)) {
            $query->where(function ($subQuery) {
                $subQuery->whereIn('news_category_id', $this->selected_categories)
                         ->orWhereIn('news_sub_category_id', $this->selected_sub_categories);
            });
        }

        if ($this->search !== '') {
            $query->where(function ($subQuery) {
                $subQuery->where('name', 'LIKE', "%{$this->search}%")
                         ->orWhere('description', 'LIKE', "%{$this->search}%")
                         ->orWhere('keywords', 'LIKE', "%{$this->search}%")
                         ->orWhere('year', 'LIKE', "%{$this->search}%")
                         ->orWhereHas('author', function ($q) {
                             $q->where('name', 'LIKE', "%{$this->search}%");
                         })
                         ->orWhereHas('publisher', function ($q) {
                             $q->where('name', 'LIKE', "%{$this->search}%");
                         })
                         ->orWhereHas('language', function ($q) {
                             $q->where('name', 'LIKE', "%{$this->search}%");
                         })
                         ->orWhereHas('location', function ($q) {
                             $q->where('name', 'LIKE', "%{$this->search}%");
                         });
            });
        }

        $items = $query->latest()->paginate($this->perPage);

        $categories = Category::orderBy('id', 'ASC')->get();
        return view('livewire.news-index', [
            'items' => $items,
            'categories' => $categories,
        ]);
    }
}
