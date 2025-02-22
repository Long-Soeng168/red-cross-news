<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Article;
use App\Models\ArticleCategory;
use App\Models\ArticleSubCategory;
use App\Models\ArticleType;
use App\Models\Publisher;
use App\Models\Location;
use App\Models\Language;
use App\Models\Author;
use App\Models\Keyword;

use Image;
use Illuminate\Support\Facades\File;

class ArticleEdit extends Component
{
    use WithFileUploads;

    public $item;
    public $image;
    public $pdf;

    public $article_category_id = null;
    public $article_sub_category_id = null;
    public $article_type_id = null;
    public $publisher_id = null;
    public $location_id = null;
    public $language_id = null;
    public $author_id = null;

    public $name = null;
    public $pages_count = null;
    public $edition = null;
    public $link = null;
    public $isbn = null;
    public $year = null;
    public $description = null;

    public $keywords = [];

    public function mount($id)
    {
        $this->item = Article::findOrFail($id);

        $this->article_category_id = $this->item->article_category_id;
        $this->article_sub_category_id = $this->item->article_sub_category_id;
        $this->article_type_id = $this->item->article_type_id;
        $this->publisher_id = $this->item->publisher_id;
        $this->location_id = $this->item->location_id;
        $this->language_id = $this->item->language_id;
        $this->author_id = $this->item->author_id;

        $this->name = $this->item->name;
        $this->pages_count = $this->item->pages_count;
        $this->edition = $this->item->edition;
        $this->link = $this->item->link;
        $this->isbn = $this->item->isbn;
        $this->year = $this->item->year;
        $this->description = $this->item->description;

        $this->keywords = explode(',', $this->item->keywords);
    }

    // ==========Add New Author============
    public $newAuthorName = null;
    public $newAuthorGender = null;

    public function saveNewAuthor()
    {
        try {
            $validated = $this->validate([
                'newAuthorName' => 'required|string|max:255|unique:authors,name',
            ]);

            Author::create([
                'name' => $this->newAuthorName,
                'gender' => $this->newAuthorGender,
            ]);

            session()->flash('success', 'Add New Author successfully!');

            $this->reset(['newAuthorName', 'newAuthorGender']);

        } catch (\Illuminate\Validation\ValidationException $e) {
            session()->flash('error', $e->validator->errors()->all());
        }
    }

    // ==========Add New Keyword============
    public $newKeywordName = null;

    public function saveNewKeyword()
    {
        try {
            $validated = $this->validate([
                'newKeywordName' => 'required|string|max:255|unique:keywords,name',
            ]);

            Keyword::create([
                'name' => $this->newKeywordName,
            ]);

            session()->flash('success', 'Add New Keyword successfully!');

            $this->reset(['newKeywordName']);

        } catch (\Illuminate\Validation\ValidationException $e) {
            session()->flash('error', $e->validator->errors()->all());
        }
    }


    // ==========Add New Category============
    public $newCategoryName = null;
    public $newCategoryNameKh = null;

    public function saveNewCategory()
    {
        try {
            $this->validate([
                'newCategoryName' => 'required|string|max:255|unique:article_categories,name',
                // Add validation rules for 'newCategoryNameKh' if needed
            ]);

            ArticleCategory::create([
                'name' => $this->newCategoryName,
                'name_kh' => $this->newCategoryNameKh,
            ]);

            session()->flash('success', 'Add New Category successfully!');

            $this->reset(['newCategoryName', 'newCategoryNameKh']);

        } catch (\Illuminate\Validation\ValidationException $e) {
            session()->flash('error', $e->validator->errors()->all());
        }
    }


    // ==========Add New Sub-Category============
    public $newSubCategoryName = null;
    public $newSubCategoryNameKh = null;
    public $selectedCategoryId = null;

    public function saveNewSubCategory()
    {
        try {
            $this->validate([
                'newSubCategoryName' => 'required|string|max:255|unique:article_sub_categories,name',
                'selectedCategoryId' => 'required|exists:article_categories,id',
            ]);

            ArticleSubCategory::create([
                'name' => $this->newSubCategoryName,
                'name_kh' => $this->newSubCategoryNameKh,
                'article_category_id' => $this->selectedCategoryId,
            ]);

            session()->flash('success', 'Add New Sub-Category successfully!');

            $this->reset(['newSubCategoryName', 'newSubCategoryNameKh', 'selectedCategoryId']);

        } catch (\Illuminate\Validation\ValidationException $e) {
            session()->flash('error', $e->validator->errors()->all());
        }
    }

    // ==========Add New Type============
    public $newTypeName = null;
    public $newTypeNameKh = null;

    public function saveNewType()
    {
        try {
            $this->validate([
                'newTypeName' => 'required|string|max:255|unique:article_types,name',
                // Add validation rules for 'newTypeNameKh' if needed
            ]);

            ArticleType::create([
                'name' => $this->newTypeName,
                'name_kh' => $this->newTypeNameKh,
            ]);

            session()->flash('success', 'Add New Type successfully!');

            $this->reset(['newTypeName', 'newTypeNameKh']);

        } catch (\Illuminate\Validation\ValidationException $e) {
            session()->flash('error', $e->validator->errors()->all());
        }
    }

    // ==========Add New Publisher============
    public $newPublisherName = null;
    public $newPublisherGender = null;

    public function saveNewPublisher()
    {
        try {
            $this->validate([
                'newPublisherName' => 'required|string|max:255|unique:publishers,name',
                // Add validation rules for 'newPublisherGender' if needed
            ]);

            Publisher::create([
                'name' => $this->newPublisherName,
                'gender' => $this->newPublisherGender,
            ]);

            session()->flash('success', 'Add New Publisher successfully!');

            $this->reset(['newPublisherName', 'newPublisherGender']);

        } catch (\Illuminate\Validation\ValidationException $e) {
            session()->flash('error', $e->validator->errors()->all());
        }
    }

    // ==========Add New Location============
    public $newLocationName = null;

    public function saveNewLocation()
    {
        try {
            $this->validate([
                'newLocationName' => 'required|string|max:255|unique:locations,name',
                // Add validation rules for 'newPublisherGender' if needed
            ]);

            Location::create([
                'name' => $this->newLocationName,
            ]);

            session()->flash('success', 'Add New Location successfully!');

            $this->reset(['newLocationName']);

        } catch (\Illuminate\Validation\ValidationException $e) {
            session()->flash('error', $e->validator->errors()->all());
        }
    }

    // ==========Add New Type============
    public $newLanguageName = null;
    public $newLanguageNameKh = null;

    public function saveNewLanguage()
    {
        try {
            $this->validate([
                'newLanguageName' => 'required|string|max:255|unique:languages,name',
                // Add validation rules for 'newLanguageNameKh' if needed
            ]);

            Language::create([
                'name' => $this->newLanguageName,
                'name_kh' => $this->newLanguageNameKh,
            ]);

            session()->flash('success', 'Add New Language successfully!');

            $this->reset(['newLanguageName', 'newLanguageNameKh']);

        } catch (\Illuminate\Validation\ValidationException $e) {
            session()->flash('error', $e->validator->errors()->all());
        }
    }



    public function updatedarticle_category_id()
    {
        $this->article_sub_category_id = null;
    }

    public function updatedImage()
    {
        $this->validate([
            'image' => 'image|max:2048', // 2MB Max
        ]);

        session()->flash('success', 'Image successfully uploaded!');
    }

    public function updatedPdf()
    {
        $this->validate([
            'pdf' => 'file|max:51200', // 2MB Max
        ]);

        session()->flash('success', 'PDF successfully uploaded!');
    }

    public function updated()
    {
        $this->dispatch('livewire:updated');
    }


    public function save()
    {
        $this->dispatch('livewire:updated');
        $validated = $this->validate([
            'name' => 'required|string|max:255',
            'pdf' => 'nullable|file|mimes:pdf|max:51200',
            'image' => 'nullable|image|max:2048',
            'pages_count' => 'nullable|integer|min:1',
            'year' => 'nullable|integer|min:1000|max:' . date('Y'),
            'isbn' => 'nullable|string|max:30',
            'link' => 'nullable|string|max:255',
            'edition' => 'nullable|integer',
            'article_category_id' => 'nullable|exists:article_categories,id',
            'article_sub_category_id' => 'nullable|exists:article_sub_categories,id',
            'article_type_id' => 'nullable|exists:article_types,id',
            'publisher_id' => 'nullable|exists:publishers,id',
            'location_id' => 'nullable|exists:locations,id',
            'language_id' => 'nullable|exists:languages,id',
            'author_id' => 'nullable|exists:authors,id',
            'description' => 'nullable',
        ]);

        if (count($this->keywords) > 0) {
            $validated['keywords'] = implode(',', $this->keywords);
        } else {
            $validated['keywords'] = null;
        }

        foreach ($validated as $key => $value) {
            if (is_null($value) || $value === '') {
                unset($validated[$key]);
            }
        }

        if (!empty($this->image)) {
            // $filename = time() . '_' . $this->image->getClientOriginalName();
            $filename = time() . str()->random(10) . '.' . $this->image->getClientOriginalExtension();

            $image_path = public_path('assets/images/articles/' . $filename);
            $image_thumb_path = public_path('assets/images/articles/thumb/' . $filename);
            $imageUpload = Image::make($this->image->getRealPath())->save($image_path);
            $imageUpload->resize(400, null, function ($resize) {
                $resize->aspectRatio();
            })->save($image_thumb_path);
            $validated['image'] = $filename;

            $old_path = public_path('assets/images/articles/' . $this->item->image);
            $old_thumb_path = public_path('assets/images/articles/thumb/' . $this->item->image);
            if (File::exists($old_path)) {
                File::delete($old_path);
            }
            if (File::exists($old_thumb_path)) {
                File::delete($old_thumb_path);
            }
        }else {
            $validated['image'] = $this->item->image;
        }

        if (!empty($this->pdf)) {
            // $filename = time() . '_' . $this->pdf->getClientOriginalName();
            $filename = time() . str()->random(10) . '.' . $this->pdf->getClientOriginalExtension();
            $this->pdf->storeAs('articles', $filename, 'publicForPdf');
            $validated['pdf'] = $filename;

            $old_file = public_path('assets/pdf/articles/' . $this->item->pdf);
            if (File::exists($old_file)) {
                File::delete($old_file);
            }
        }else {
            $validated['pdf'] = $this->item->pdf;
        }

        $this->item->update($validated);

        return redirect()->route('admin.articles.index')->with('success', 'Successfully updated!');
    }

    public function render()
    {
        $categories = ArticleCategory::latest()->get();
        $subCategories = ArticleSubCategory::where('article_category_id', $this->article_category_id)->latest()->get();
        $types = ArticleType::latest()->get();
        $publishers = Publisher::latest()->get();
        $locations = Location::latest()->get();
        $languages = Language::latest()->get();
        $authors = Author::latest()->get();
        $allKeywords = Keyword::latest()->get();
// dd($allKeywords);
        // dump($this->selectedallKeywords);

        return view('livewire.article-edit', [
            'categories' => $categories,
            'subCategories' => $subCategories,
            'types' => $types,
            'publishers' => $publishers,
            'locations' => $locations,
            'authors' => $authors,
            'languages' => $languages,
            'allKeywords' => $allKeywords,
        ]);
    }
}
