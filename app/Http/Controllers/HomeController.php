<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Auth\LoginRequest;

use App\Models\Slide;
use App\Models\Publication;
use App\Models\Video;
use App\Models\Image;
use App\Models\Audio;
use App\Models\Thesis;
use App\Models\Journal;
use App\Models\Article;
use App\Models\News;
use App\Models\Menu;
use App\Models\WebsiteInfo;
use Image as ImageCompress;
use DB;
use Illuminate\Support\Facades\Schema;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

use Illuminate\Support\Facades\Http;

class HomeController extends Controller
{
    public function index() {

        // $items = Publication::where('id', '>', 151)->get();
        // foreach($items as $item){
        //         $item->update([
        //             'name' => $item->name . ', ' . $item->Subtitle,
        //         ]);
        // }

        // $items = Thesis::with('major')->get();
        // foreach($items as $item){
            //         $item->update([
                //             'thesis_category_id' => $item->major?->thesis_category_id,
                //         ]);
                // }
        // $items = DB::table('article_meta_data_subject')->get();
        // foreach ($items as $key => $item) {
        //     $archive = Publication::find($item->article_meta_data_id);
        //     if($archive) {
        //         $archive->update([
        //             'publication_category_id' => $item->subject_id,
        //         ]);
        //     }
        // }
        // $items = Publication::all();
        // return ($items);

        // $response = Http::get('https://thnal.com/api/jstors', [
        //     'per_page' => 5,
        //     'page' => 1,
        // ]);

        // $jstors = json_decode($response->body());
        // dd($jstors);

        // $items = $response->successful() ? $response->json() : ['data' => [], 'links' => []];

        $slides = Slide::latest()->get();
        $publications = Publication::inRandomOrder()->limit(10)->get();
        $videos = Video::inRandomOrder()->limit(8)->get();
        $images = Image::inRandomOrder()->limit(8)->get();
        $audios = Audio::inRandomOrder()->limit(8)->get();
        $bulletins = News::inRandomOrder()->limit(10)->get();
        $theses = Thesis::inRandomOrder()->limit(10)->get();
        $journals = Journal::inRandomOrder()->limit(10)->get();
        $articles = Article::inRandomOrder()->limit(10)->get();
        return view('client.home', [
            'slides' => $slides,
            'jstors' => [],
            'publications' => $publications,
            'videos' => $videos,
            'images' => $images,
            'audios' => $audios,
            'bulletins' => $bulletins,
            'theses' => $theses,
            'journals' => $journals,
            'articles' => $articles,
        ]);
    }

    public function fetchAndSaveBookCover(Request $request)
    {
        // Fetch all publications
        $from = $request->from;
        $end = $request->end;
        $items = Publication::whereBetween('id', [$from, $end])->get();

        foreach($items as $item) {
            $isbn = $item->isbn;
            $client = new Client();
            $url = "https://www.googleapis.com/books/v1/volumes?q=isbn:" . $isbn;

            try {
                // Send request to Google Books API
                $response = $client->request('GET', $url);
                $bookData = json_decode($response->getBody(), true);

                // Check if items exist and extract the cover image URL
                if (isset($bookData['items']) && isset($bookData['items'][0]['volumeInfo']['imageLinks']['thumbnail'])) {
                    $coverUrl = $bookData['items'][0]['volumeInfo']['imageLinks']['thumbnail'];

                    // Replace 'zoom=1' with 'zoom=10'
                    // $coverUrl = str_replace('zoom=1', 'zoom=10', $coverUrl);

                    // Download the cover image
                    $imageResponse = $client->get($coverUrl);
                    $imageContents = $imageResponse->getBody()->getContents();

                    // Define the path to save the image
                    $imageName = 'book-cover-' . $isbn . '.jpg';
                    $imagePath = public_path('assets/images/publications/' . $imageName);
                    $imagePathThumb = public_path('assets/images/publications/thumb/' . $imageName);

                    // Ensure the directory exists
                    if (!File::exists(public_path('assets/images/publications'))) {
                        File::makeDirectory(public_path('assets/images/publications'), 0755, true);
                    }
                    if (!File::exists(public_path('assets/images/publications/thumb/'))) {
                        File::makeDirectory(public_path('assets/images/publications/thumb/'), 0755, true);
                    }

                    // Save the image to the specified path
                    File::put($imagePath, $imageContents);
                    File::put($imagePathThumb, $imageContents);

                    // Update the publication record with the image name
                    $item->update([
                        'image' => $imageName,
                    ]);
                }
            } catch (\Exception $e) {
                // Continue to the next item if there's an error
                continue;
            }
        }

        return response()->json([
            'message' => 'Books cover saved successfully!',
        ]);
    }

    public function oneSearch(Request $request)
    {
        $search = $request->input('search');
        $searchableFields = ['name', 'description', 'keywords'];
        $models = [
            'publications' => Publication::class,
            'videos' => Video::class,
            'images' => Image::class,
            'audios' => Audio::class,
            'bulletins' => News::class,
            'theses' => Thesis::class,
            'journals' => Journal::class,
            'articles' => Article::class,
        ];
        $limitMapping = [
            'publications' => 10,
            'videos' => 8,
            'images' => 8,
            'audios' => 8,
            'bulletins' => 10,
            'theses' => 10,
            'journals' => 10,
            'articles' => 10,
        ];
        $results = [];

        foreach ($models as $key => $model) {
            $results[$key] = $model::when($search, function($query) use ($search, $searchableFields, $model) {
                foreach ($searchableFields as $field) {
                    if (Schema::hasColumn((new $model)->getTable(), $field)) {
                        $query->orWhere($field, 'LIKE', "%{$search}%");
                    }
                }
                // Check for 'year' column
                if (Schema::hasColumn((new $model)->getTable(), 'year')) {
                    $query->orWhere('year', 'LIKE', "%{$search}%");
                }
                // Check for 'published_date' column
                if (Schema::hasColumn((new $model)->getTable(), 'published_date')) {
                    $query->orWhere('published_date', 'LIKE', "%{$search}%");
                }
                $query->orWhereHas('author', function ($q) use ($search) {
                    $q->where('name', 'LIKE', "%{$search}%");
                })
                ->orWhereHas('publisher', function ($q) use ($search) {
                    $q->where('name', 'LIKE', "%{$search}%");
                })
                ->orWhereHas('language', function ($q) use ($search) {
                    $q->where('name', 'LIKE', "%{$search}%");
                })
                ->orWhereHas('location', function ($q) use ($search) {
                    $q->where('name', 'LIKE', "%{$search}%");
                });
            })->latest()->limit($limitMapping[$key])->get();
        }

        return view('client.one_search', $results);
    }


    public function clientLogin($path){
        return view('client.client_login', [
            'path' => $path,
        ]);
    }

    public function clientLoginStore(LoginRequest $request, $path)
    {
        // dd($request, $path);
        $request->authenticate();

        $request->session()->regenerate();

        $pathRedirect = str_replace('-', '/', $path);

        return redirect($pathRedirect);
        // return redirect()->intended(RouteServiceProvider::HOME);
    }

    public function menu($id) {
        return view('client.menu_detail', [
            'item' => Menu::findOrFail($id),
        ]);
    }

    public function readCount($archive, $id) {

        if ($archive == 'publication') {
            $item = Publication::findOrFail($id);
            $item->update([
                'read_count' => $item->read_count + 1,
            ]);
            return response()->json(['success' => true], 200);
        }elseif($archive == 'bulletin') {
            $item = News::findOrFail($id);
            $item->update([
                'read_count' => $item->read_count + 1,
            ]);
            return response()->json(['success' => true], 200);
        }elseif($archive == 'article') {
            $item = Article::findOrFail($id);
            $item->update([
                'read_count' => $item->read_count + 1,
            ]);
            return response()->json(['success' => true], 200);
        }elseif($archive == 'thesis') {
            $item = Thesis::findOrFail($id);
            $item->update([
                'read_count' => $item->read_count + 1,
            ]);
            return response()->json(['success' => true], 200);
        }elseif($archive == 'journal') {
            $item = Journal::findOrFail($id);
            $item->update([
                'read_count' => $item->read_count + 1,
            ]);
            return response()->json(['success' => true], 200);
        }

        else {
            return response()->json(['success' => false], 404);
        }

    }

    public function downloadCount($archive, $id) {

        $item = null;
        if ($archive == 'publication') {
            $item = Publication::findOrFail($id);
        }elseif($archive == 'bulletin'){
            $item = News::findOrFail($id);
        }elseif($archive == 'article'){
            $item = Article::findOrFail($id);
        }elseif($archive == 'thesis'){
            $item = Thesis::findOrFail($id);
        }elseif($archive == 'journal'){
            $item = Journal::findOrFail($id);
        }
        else {
            return response()->json(['success' => false], 404);
        }

        if($item){
            $item->update([
                'download_count' => $item->download_count + 1,
            ]);
            return response()->json(['success' => true], 200);
        }

    }

    public function stream($archive,$id, $file_name)
    {
        // Ensure that only authorized users can access the stream
        // if (!auth()->check()) {
        //     abort(403);
        // }

        $filePath = '';
        $item = null;

        if ($archive == 'publication') {
            $filePath = public_path('assets/pdf/publications/'.$file_name);
            $item = Publication::findOrFail($id);
        }elseif($archive == 'bulletin') {
            $filePath = public_path('assets/pdf/news/'.$file_name);
            $item = News::findOrFail($id);
        }elseif($archive == 'article') {
            $filePath = public_path('assets/pdf/articles/'.$file_name);
            $item = Article::findOrFail($id);
        }elseif($archive == 'thesis') {
            $filePath = public_path('assets/pdf/theses/'.$file_name);
            $item = Thesis::findOrFail($id);
        }elseif($archive == 'journal') {
            $filePath = public_path('assets/pdf/journals/'.$file_name);
            $item = Journal::findOrFail($id);
        }

        $websiteInfo = WebsiteInfo::first() ?? new WebsiteInfo;
        if($websiteInfo->pdf_viewer_default == 1){
            $item->update([
                'read_count' => $item->read_count + 1,
            ]);
        }

        if (!$item->can_download && !$item->can_read && !auth()->check()) {
            abort(403);
        }

        if (!file_exists($filePath)) {
            abort(404); // File not found
        }

        $stream = new \Symfony\Component\HttpFoundation\StreamedResponse(function () use ($filePath) {
            $stream = fopen($filePath, 'r');
            fpassthru($stream);
            fclose($stream);
        });

        $stream->headers->set('Content-Type', 'application/pdf');
        $stream->headers->set('Content-Length', filesize($filePath));

        return $stream;
    }

    public function viewPdf($archive, $id, $file_name)
    {
        // Ensure that only authorized users can access the stream
        // if (!auth()->check()) {
        //     abort(403);
        // }
        // dd($id, $archive);

        $filePath = '';
        $item = null;

        if ($archive == 'publication') {
            $filePath = public_path('assets/pdf/publications/'.$file_name);
            $item = Publication::findOrFail($id);
        }elseif($archive == 'bulletin') {
            $filePath = public_path('assets/pdf/news/'.$file_name);
            $item = News::findOrFail($id);
        }elseif($archive == 'article') {
            $filePath = public_path('assets/pdf/articles/'.$file_name);
            $item = Article::findOrFail($id);
        }elseif($archive == 'thesis') {
            $filePath = public_path('assets/pdf/theses/'.$file_name);
            $item = Thesis::findOrFail($id);
        }elseif($archive == 'journal') {
            $filePath = public_path('assets/pdf/journals/'.$file_name);
            $item = Journal::findOrFail($id);
        }

        if($item){
            $item->update([
                'read_count' => $item->read_count + 1,
            ]);
        }

        if (!$item->can_read && !auth()->check()) {
            abort(403);
        }

        if (!file_exists($filePath)) {
            abort(404); // File not found
        }

        return view('client.view_pdf', [
            'archive' => $archive,
            'id' => $id,
            'file_name' => $file_name
        ]);

    }

    public function downloadPdf($archive, $id, $file_name)
    {
        // Ensure that only authorized users can access the download
        // if (!auth()->check()) {
        //     abort(403);
        //     return;
        // }

        $filePath = '';
        $item = null;

        if ($archive == 'publication') {
            $filePath = public_path('assets/pdf/publications/'.$file_name);
            $item = Publication::findOrFail($id);
        }elseif($archive == 'bulletin') {
            $filePath = public_path('assets/pdf/news/'.$file_name);
            $item = News::findOrFail($id);
        }elseif($archive == 'article') {
            $filePath = public_path('assets/pdf/articles/'.$file_name);
            $item = Article::findOrFail($id);
        }elseif($archive == 'thesis') {
            $filePath = public_path('assets/pdf/theses/'.$file_name);
            $item = Thesis::findOrFail($id);
        }elseif($archive == 'journal') {
            $filePath = public_path('assets/pdf/journals/'.$file_name);
            $item = Journal::findOrFail($id);
        }

        if (!$item->can_download && !auth()->check()) {
            abort(403);
        }

        if (!file_exists($filePath)) {
            abort(404); // File not found
        }

        return response()->download($filePath, $file_name, [
            'Content-Type' => 'application/pdf',
        ]);

    }

}
