<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Menu;

use Image;

class MenuCreate extends Component
{
    // use WithFileUploads;

    // public $image;
    // public $pdf;


    public $order_index = 0;
    public $name = null;
    public $name_kh = null;
    public $link = null;
    public $description = null;
    public $description_kh = null;

    // public function updatedImage()
    // {
    //     $this->validate([
    //         'image' => 'image|max:2048', // 2MB Max
    //     ]);

    //     session()->flash('success', 'Image successfully uploaded!');
    // }

    // public function updatedPdf()
    // {
    //     $this->validate([
    //         'pdf' => 'file|max:2048', // 2MB Max
    //     ]);

    //     session()->flash('success', 'PDF successfully uploaded!');
    // }

    // public function updated()
    // {
    //     $this->dispatch('livewire:updated');
    // }


    public function save()
    {
        $this->dispatch('livewire:updated');
        $validated = $this->validate([
            'name' => 'required|string|max:255',
            'name_kh' => 'required|string|max:255',
            'link' => 'nullable|string|max:255',
            'order_index' => 'nullable',
            'description' => 'nullable',
            'description_kh' => 'nullable',
        ]);

        // $validated['create_by_user_id'] = request()->user()->id;

        // dd($validated);

        // if(!empty($this->image)){
        //     $filename = time() . '_' . $this->image->getClientOriginalName();

        //     $image_path = public_path('assets/images/publications/'.$filename);
        //     $image_thumb_path = public_path('assets/images/publications/thumb/'.$filename);
        //     $imageUpload = Image::make($this->image->getRealPath())->save($image_path);
        //     $imageUpload->resize(400,null,function($resize){
        //         $resize->aspectRatio();
        //     })->save($image_thumb_path);
        //     $validated['image'] = $filename;
        // }

        // if (!empty($this->pdf)) {
        //     $filename = time() . '_' . $this->pdf->getClientOriginalName();
        //     $this->pdf->storeAs('publications', $filename, 'publicForPdf');
        //     $validated['pdf'] = $filename;
        // }

        $createdPublication = Menu::create($validated);

        // dd($createdPublication);
        return redirect('admin/settings/menus')->with('success', 'Successfully Created!');

        // session()->flash('message', 'Image successfully uploaded!');
    }

    public function render()
    {
        // dd($allKeywords);
        // dump($this->selectedallKeywords);

        return view('livewire.menu-create');
    }
}
