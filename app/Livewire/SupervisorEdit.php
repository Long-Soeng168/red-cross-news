<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Supervisor;

use Image;

class SupervisorEdit
 extends Component
{
    use WithFileUploads;

    public $image;
    // public $pdf;


    public $item = null;
    public $name = null;
    public $gender = null;
    public $email = null;
    public $phone = null;
    public $address = null;

    public function mount(Supervisor $item)
    {
        $this->item = $item; // Initialize the $item variable with the provided item model instance
        $this->name = $item->name;
        $this->gender = $item->gender;
        $this->email = $item->email;
        $this->phone = $item->phone;
        $this->address = $item->address;
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
            'gender' => 'nullable|string|max:255',
            'email' => 'nullable|email',
            'phone' => 'nullable',
            'address' => 'nullable|string',
        ]);

        // Update the existing item record
        if(!empty($this->image)){
            // $filename = time() . '_' . $this->image->getClientOriginalName();
            $filename = time() . str()->random(10) . '.' . $this->image->getClientOriginalExtension();

            $image_path = public_path('assets/images/supervisors/'.$filename);
            $image_thumb_path = public_path('assets/images/supervisors/thumb/'.$filename);
            $imageUpload = Image::make($this->image->getRealPath())->save($image_path);
            $imageUpload->resize(400,null,function($resize){
                $resize->aspectRatio();
            })->save($image_thumb_path);
            $validated['image'] = $filename;
        }

        $this->item->update($validated);

        session()->flash('success', 'Updated successfully!');

        return redirect('admin/people/supervisors');
    }


    public function render()
    {
        // dd($allKeywords);
        // dump($this->selectedallKeywords);

        return view('livewire.supervisor-edit');
    }
}
