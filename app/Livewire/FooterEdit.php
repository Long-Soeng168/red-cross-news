<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Footer;

class FooterEdit extends Component
{
    public $footer; // Variable to hold the footer record for editing
    public $name;
    public $name_kh;
    public $description;
    public $description_kh;
    public $copyright;
    public $copyright_kh;

    public function mount(Footer $footer)
    {
        $this->footer = $footer; // Initialize the $footer variable with the provided footer model instance
        $this->name = $footer->name;
        $this->name_kh = $footer->name_kh;
        $this->description = $footer->description;
        $this->description_kh = $footer->description_kh;
        $this->copyright = $footer->copyright;
        $this->copyright_kh = $footer->copyright_kh;
    }

    public function save()
    {
        $this->dispatch('livewire:updated');
        $validated = $this->validate([
            'name' => 'required|string|max:255',
            'name_kh' => 'required|string|max:255',
            'description' => 'nullable',
            'description_kh' => 'nullable',
            'copyright' => 'nullable|string|max:255',
            'copyright_kh' => 'nullable|string|max:255',
        ]);

        // Update the existing footer record
        $this->footer->update($validated);

        session()->flash('success', 'Footer updated successfully!');

        // return redirect('admin/settings/footer');
    }

    public function render()
    {
        return view('livewire.footer-edit');
    }
}
