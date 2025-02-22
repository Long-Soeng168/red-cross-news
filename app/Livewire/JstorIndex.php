<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Http;
use Livewire\WithPagination;

class JstorIndex extends Component
{
    use WithPagination;

    public $selected_categories = [];
    public $selected_category_id = [];
    public $selected_categories_item = [];
    public $selected_sub_categories = [];
    public $selected_sub_categories_item = [];
    public $search = '';
    public $perPage = 25;
    public $page = 1;
    public $last_page = 0;
    public $categories = [];

    public function mount()
    {
        $this->loadCategories();
    }

    // Load categories from API
    private function loadCategories()
    {
        $response = Http::get('https://thnal.com/api/jstors_categories');
        if ($response->successful()) {
            $this->categories = $response->json();
        }
    }

    public function handleSelectCategory($id)
    {
        $this->page = 1;
        // dd($id);
        $item = collect($this->categories)->firstWhere('id', $id);

            $this->selected_categories = $id;
            $this->selected_category_id = $id;
            $this->selected_categories_item = $item;
    }

    public function handleSelectSubCategory($id)
    {
        // Assuming subcategories would be loaded similarly; adjust the API endpoint as needed
        $item = collect($this->categories)->flatMap(fn($cat) => $cat['sub_categories'] ?? [])->firstWhere('id', $id);
        if (in_array($id, $this->selected_sub_categories)) {
            $this->selected_sub_categories = array_diff($this->selected_sub_categories, [$id]);
            $this->selected_sub_categories_item = array_filter($this->selected_sub_categories_item, fn($i) => $i['id'] !== $id);
        } else {
            $this->selected_sub_categories[] = $id;
            $this->selected_sub_categories_item[] = $item;
        }
    }

    public function handleRemoveCategoryName($item)
    {
        $this->selected_categories = array_filter($this->selected_categories, fn($id) => $id !== $item['id']);
        $this->selected_categories_item = array_filter($this->selected_categories_item, fn($i) => $i['id'] !== $item['id']);
    }

    public function handleRemoveSubCategoryName($item)
    {
        $this->selected_sub_categories = array_filter($this->selected_sub_categories, fn($id) => $id !== $item['id']);
        $this->selected_sub_categories_item = array_filter($this->selected_sub_categories_item, fn($i) => $i['id'] !== $item['id']);
    }

    public function handleClearAllFilter()
    {
        $this->selected_categories = [];
        $this->selected_categories_item = [];
        $this->selected_sub_categories = [];
        $this->selected_sub_categories_item = [];
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
    public function previousPage()
    {
        $this->dispatch('livewire:updatedPage');
        if($this->page > 1)
        $this->page = $this->page - 1;
    }
    public function nextPage()
    {
        $this->dispatch('livewire:updatedPage');
        if($this->page < $this->last_page )
        $this->page = $this->page + 1;
    }

    public function render()
    {
        // Fetch items from API with filters and pagination
        $response = Http::get('https://thnal.com/api/jstors', [
            'search' => $this->search,
            'selected_category_id' => $this->selected_category_id,
            'sub_categories' => $this->selected_sub_categories,
            'per_page' => $this->perPage,
            'page' => $this->page,
        ]);

        $items = $response->successful() ? $response->json() : ['data' => [], 'links' => []];

        $this->last_page = $items['last_page'];

        // dd($items['links']);
        return view('livewire.jstor-index', [
            'items' => $items['data'],
            'items_all' => $items,
            'categories' => $this->categories,
        ]);
    }
}
