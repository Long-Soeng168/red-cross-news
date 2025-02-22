<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Link;
use Livewire\WithFileUploads;

use Image;

class LinkEdit extends Component
{
    use WithFileUploads;

    public $image;

    public $item; // Variable to hold the item record for editing
    public $name;
    public $name_kh;
    public $link;
    public $order_index;
    public $description;
    public $description_kh;

    public function mount(Link $item)
    {
        $this->item = $item; // Initialize the $item variable with the provided item model instance
        $this->name = $item->name;
        $this->name_kh = $item->name_kh;
        $this->link = $item->link;
        $this->order_index = $item->order_index;
    }

    public function updatedImage()
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
            'name_kh' => 'nullable|string|max:255',
            'link' => 'required|url|max:255',
            'order_index' => 'nullable',
        ]);

        // Update the existing item record
        if(!empty($this->image)){
            // $filename = time() . '_' . $this->image->getClientOriginalName();
            $filename = time() . str()->random(10) . '.' . $this->image->getClientOriginalExtension();

            $image_path = public_path('assets/images/links/'.$filename);
            $imageUpload = Image::make($this->image->getRealPath())->save($image_path);
            $validated['image'] = $filename;
        }

        $this->item->update($validated);

        session()->flash('success', 'Link updated successfully!');

        return redirect('admin/settings/links');
    }

    public function render()
    {
        return view('livewire.link-edit');
    }
}
