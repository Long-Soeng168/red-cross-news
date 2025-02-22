<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\WebsiteInfo;
use Livewire\WithFileUploads;

use Image;
use Illuminate\Support\Facades\File;

class WebsiteInfoEdit extends Component
{
    use WithFileUploads;

    public $image;
    public $banner;

    public $item; // Variable to hold the item record for editing
    public $name;
    public $name_kh;
    public $primary;
    public $primary_hover;
    public $banner_color;
    public $show_bg_menu;
    public $pdf_viewer_default;
    public $show_download_button;
    public $check_ip_range;
    public $ip_range;

    public $description;
    public $description_kh;

    public function mount(WebsiteInfo $item)
    {
        $this->item = $item; // Initialize the $item variable with the provided item model instance
        $this->name = $item->name;
        $this->name_kh = $item->name_kh;
        $this->primary = $item->primary;
        $this->primary_hover = $item->primary_hover;
        $this->banner_color = $item->banner_color;
        $this->ip_range = $item->ip_range;
        $this->show_bg_menu = (bool) $item->show_bg_menu;
        $this->pdf_viewer_default = (bool) $item->pdf_viewer_default;
        $this->show_download_button = (bool) $item->show_download_button;
        $this->check_ip_range = (bool) $item->check_ip_range;
    }

    public function updatedImage()
    {
        $this->validate([
            'image' => 'image|mimes:png|max:2048', // 2MB Max
        ]);

        session()->flash('success', 'Image successfully uploaded!');
    }
    public function updatedBanner()
    {
        $this->validate([
            'banner' => 'image|max:2048', // 2MB Max
        ]);

        session()->flash('success', 'Banner successfully uploaded!');
    }

    public function save()
    {
        $validated = $this->validate([
            'name' => 'required|string|max:255',
            'name_kh' => 'required|string|max:255',
            'primary' => 'required|max:255',
            'primary_hover' => 'required|max:255',
            'banner_color' => 'required|max:255',
            'ip_range' => 'nullable|max:500',
            'show_bg_menu' => 'required|boolean',
            'pdf_viewer_default' => 'required|boolean',
            'show_download_button' => 'required|boolean',
            'check_ip_range' => 'required|boolean',
        ]);


        if (!empty($this->image)) {
            $old_path = public_path('assets/images/website_infos/logo.png');
            if (File::exists($old_path)) {
                File::delete($old_path);
            }

            $old_path192 = public_path('assets/images/website_infos/logo192.png');
            if (File::exists($old_path192)) {
                File::delete($old_path192);
            }

            $filename = 'logo.png';
            $filename192 = 'logo192.png';

            $image_path = public_path('assets/images/website_infos/' . $filename);
            $image_path192 = public_path('assets/images/website_infos/' . $filename192);

            $imageUpload = Image::make($this->image->getRealPath())
                ->fit(512, 512)
                ->save($image_path, 80);

            $imageUpload = Image::make($this->image->getRealPath())
                ->fit(192, 192)
                ->save($image_path192, 80);

            $validated['image'] = $filename;
        }

        if(!empty($this->banner)){
            $old_path = public_path('assets/images/website_infos/' . $this->item->banner);
            if (File::exists($old_path)) {
                File::delete($old_path);
            }
            // $filename = time() . '_' . $this->banner->getClientOriginalName();
            $filename = time() . str()->random(10) . '.' . $this->banner->getClientOriginalExtension();
            // $filename = 'banner.png';

            $image_path = public_path('assets/images/website_infos/'.$filename);
            $imageUpload = Image::make($this->banner->getRealPath())->save($image_path);
            $validated['banner'] = $filename;
        }

        $this->item->update($validated);

        session()->flash('success', 'Info updated successfully!');

        return redirect('admin/settings/website_infos/1/edit');
    }

    public function render()
    {
        return view('livewire.website-info-edit');
    }
}
