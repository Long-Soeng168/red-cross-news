<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Database;
use Livewire\WithFileUploads;

use Image;

class DatabaseEdit extends Component
{
    use WithFileUploads;

    public $image;
    public $client_side_image;

    public $item; // Variable to hold the item record for editing
    public $name;
    public $name_kh;
    public $link;
    public $slug;
    public $type;
    public $order_index;
    public $description;
    public $description_kh;
    public $light_mode_color;
    public $dark_mode_color;

    public function mount(Database $item)
    {
        $this->item = $item; // Initialize the $item variable with the provided item model instance
        $this->name = $item->name;
        $this->name_kh = $item->name_kh;
        $this->link = $item->link;
        $this->slug = $item->slug;
        $this->type = $item->type;
        $this->order_index = $item->order_index;
        $this->light_mode_color = $item->light_mode_color;
        $this->dark_mode_color = $item->dark_mode_color;
    }

    public function updatedImage()
    {
        $this->validate([
            'image' => 'image|max:2048', // 2MB Max
        ]);

        session()->flash('success', 'Image successfully uploaded!');
    }

    public function updatedClient_side_image()
    {
        $this->validate([
            'image' => 'image|max:2048', // 2MB Max
        ]);

        session()->flash('success', 'Image successfully uploaded!');
    }

    public function save()
    {
        $validated = $this->validate([
            'name' => 'required|string|max:255',
            'name_kh' => 'required|string|max:255',
            'link' => 'nullable|string|max:255',
            'slug' => 'nullable|string|max:255|unique:databases,slug,'.$this->item->id,
            'type' => 'nullable|string|max:255',
            'order_index' => 'nullable||max:255',
            'light_mode_color' => 'nullable||max:255',
            'dark_mode_color' => 'nullable||max:255',
        ]);

        // Update the existing item record
        if(!empty($this->image)){
            // $filename = time() . '_' . $this->image->getClientOriginalName();
            $filename = time() . str()->random(10) . '.' . $this->image->getClientOriginalExtension();

            $image_path = public_path('assets/images/databases/'.$filename);
            $imageUpload = Image::make($this->image->getRealPath())->save($image_path);
            $validated['image'] = $filename;
        }

        if(!empty($this->client_side_image)){
            // $filename = time() . '_' . $this->client_side_image->getClientOriginalName();
            $filename = time() . str()->random(10) . '.' . $this->client_side_image->getClientOriginalExtension();

            $image_path = public_path('assets/images/databases/'.$filename);
            $imageUpload = Image::make($this->client_side_image->getRealPath())->save($image_path);
            $validated['client_side_image'] = $filename;
        }

        $this->item->update($validated);

        session()->flash('success', 'Database updated successfully!');

        return redirect('admin/settings/databases');
    }

    public function render()
    {
        return view('livewire.database-edit');
    }
}
