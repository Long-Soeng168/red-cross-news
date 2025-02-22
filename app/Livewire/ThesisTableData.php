<?php

namespace App\Livewire;

use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

use App\Models\Thesis;
use App\Models\ThesisImage;
use App\Models\ThesisResourceLink;
use App\Models\ThesisJournalLink;
use App\Models\ThesisType as Type;
use App\Models\ThesisCategory as Category;
use Illuminate\Support\Facades\File;

class ThesisTableData extends Component
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
        $item = Thesis::findOrFail($id);

        if($item->image !== 'image.png') {
            $imagePathThumb = public_path('assets/images/theses/thumb/' . $item->image);
            $imagePath = public_path('assets/images/theses/' . $item->image);
            // Delete the image file from the filesystem
            if (File::exists($imagePathThumb)) {
                File::delete($imagePathThumb);
            }
            if (File::exists($imagePath)) {
                File::delete($imagePath);
            }
        }

        if($item->pdf) {
            $filePath = public_path('assets/pdf/theses/' . $item->pdf);
            // Delete the image file from the filesystem
            if (File::exists($filePath)) {
                File::delete($filePath);
            }
        }

        $multiImages = ThesisImage::where('thesis_id', $item->id)->get();
        if($multiImages){
            foreach($multiImages as $image) {
                $imagePathThumb = public_path('assets/images/theses/thumb/' . $image->image);
                $imagePath = public_path('assets/images/theses/' . $image->image);
                // Delete the image file from the filesystem
                if (File::exists($imagePathThumb)) {
                    File::delete($imagePathThumb);
                }
                if (File::exists($imagePath)) {
                    File::delete($imagePath);
                }
            }
        }

        ThesisResourceLink::where('thesis_id', $item->id)->delete();
        ThesisJournalLink::where('thesis_id', $item->id)->delete();

        $item->delete();

        session()->flash('success', 'Delete Successfully!');
    }

    public function updateRead($id)
    {
        $item = Thesis::findOrFail($id);
        $item->update([
            'can_read' => $item->can_read == 0 ? 1 : 0
        ]);
    }

    public function updateDownload($id)
    {
        $item = Thesis::findOrFail($id);
        $item->update([
            'can_download' => $item->can_download == 0 ? 1 : 0
        ]);
    }


    public function render(){

        $items = Thesis::where(function($query){
                                $query->where('name', 'LIKE', "%$this->search%")
                                    ->orWhere('description', 'LIKE', "%$this->search%")
                                    ->orWhere('isbn', 'LIKE', "%$this->search%");
                            })
                            ->when($this->filter != 0, function($query){
                                $query->where('thesis_category_id', $this->filter);
                            })
                            ->orderBy($this->sortBy, $this->sortDir)
                            ->paginate($this->perPage);
        $types = Category::latest()->get();
        $selectedType = Category::find($this->filter);

        $totalReadCount = Thesis::sum('read_count');
        $totalDownloadCount = Thesis::sum('download_count');

        return view('livewire.thesis-table-data', [
            'items' => $items,
            'types' => $types,
            'selectedType' => $selectedType,
            'totalReadCount' => $totalReadCount,
            'totalDownloadCount' => $totalDownloadCount,
        ]);
    }
}
