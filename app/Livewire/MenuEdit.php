<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Menu;

class MenuEdit extends Component
{
    public $menu; // Variable to hold the menu record for editing
    public $name;
    public $name_kh;
    public $link;
    public $order_index;
    public $description;
    public $description_kh;

    public function mount(Menu $menu)
    {
        $this->menu = $menu; // Initialize the $menu variable with the provided Menu model instance
        $this->name = $menu->name;
        $this->name_kh = $menu->name_kh;
        $this->link = $menu->link;
        $this->order_index = $menu->order_index;
        $this->description = $menu->description;
        $this->description_kh = $menu->description_kh;
    }

    public function save()
    {
        $validated = $this->validate([
            'name' => 'required|string|max:255',
            'name_kh' => 'required|string|max:255',
            'link' => 'nullable|string|max:255',
            'order_index' => 'nullable',
            'description' => 'nullable',
            'description_kh' => 'nullable',
        ]);

        // Update the existing menu record
        $this->menu->update($validated);

        session()->flash('success', 'Menu updated successfully!');

        return redirect('admin/settings/menus');
    }

    public function render()
    {
        return view('livewire.menu-edit');
    }
}
