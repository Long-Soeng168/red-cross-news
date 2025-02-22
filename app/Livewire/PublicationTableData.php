<?php

namespace App\Livewire;

use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

use App\Models\Publication;
use App\Models\PublicationImage;
use App\Models\PublicationCategory;
use Illuminate\Support\Facades\File;

class PublicationTableData extends Component
{
    use WithPagination;

    #[Url(history: true)]
    public $search = '';

    #[Url(history: true)]
    public $perPage = 10;

    #[Url(history: true)]
    public $filter = 0;

    #[Url(history: true)]
    public $sortBy = 'created_at';

    #[Url(history: true)]
    public $sortDir = 'DESC';

    public function setFilter($value) {
        $this->filter = $value;
        $this->resetPage();
    }

    public function setSortBy($newSortBy) {
        if($this->sortBy == $newSortBy){
            $newSortDir = ($this->sortDir == 'DESC') ? 'ASC' : 'DESC';
            $this->sortDir = $newSortDir;
        }else{
            $this->sortBy = $newSortBy;
        }
    }

    // ResetPage when updated search
    public function updatedSearch() {
        $this->resetPage();
    }

    public function delete($id) {
        $item = Publication::findOrFail($id);

        if($item->image !== 'image.png') {
            $imagePathThumb = public_path('assets/images/publications/thumb/' . $item->image);
            $imagePath = public_path('assets/images/publications/' . $item->image);
            // Delete the image file from the filesystem
            if (File::exists($imagePathThumb)) {
                File::delete($imagePathThumb);
            }
            if (File::exists($imagePath)) {
                File::delete($imagePath);
            }
        }

        if($item->pdf) {
            $filePath = public_path('assets/pdf/publications/' . $item->pdf);
            // Delete the image file from the filesystem
            if (File::exists($filePath)) {
                File::delete($filePath);
            }
        }

        $multiImages = PublicationImage::where('publication_id', $item->id)->get();
        if($multiImages){
            foreach($multiImages as $image) {
                $imagePathThumb = public_path('assets/images/publications/thumb/' . $image->image);
                $imagePath = public_path('assets/images/publications/' . $image->image);
                // Delete the image file from the filesystem
                if (File::exists($imagePathThumb)) {
                    File::delete($imagePathThumb);
                }
                if (File::exists($imagePath)) {
                    File::delete($imagePath);
                }
            }
        }

        $item->delete();

        session()->flash('success', 'Delete Successfully!');
    }

    public function updateRead($id)
    {
        $item = Publication::findOrFail($id);
        $item->update([
            'can_read' => $item->can_read == 0 ? 1 : 0
        ]);
    }

    public function updateDownload($id)
    {
        $item = Publication::findOrFail($id);
        $item->update([
            'can_download' => $item->can_download == 0 ? 1 : 0
        ]);
    }


    public function render(){

        $items = Publication::where(function($query){
                                $query->where('name', 'LIKE', "%$this->search%")
                                    ->orWhere('description', 'LIKE', "%$this->search%")
                                    ->orWhere('isbn', 'LIKE', "%$this->search%");
                            })
                            ->when($this->filter != 0, function($query){
                                $query->where('publication_category_id', $this->filter);
                            })
                            ->orderBy($this->sortBy, $this->sortDir)
                            ->paginate($this->perPage);
        $categories = PublicationCategory::latest()->get();
        $selectedCategory = PublicationCategory::find($this->filter);

        $totalReadCount = Publication::sum('read_count');
        $totalDownloadCount = Publication::sum('download_count');

        return view('livewire.publication-table-data', [
            'items' => $items,
            'categories' => $categories,
            'selectedCategory' => $selectedCategory,
            'totalReadCount' => $totalReadCount,
            'totalDownloadCount' => $totalDownloadCount,
        ]);
    }
}
