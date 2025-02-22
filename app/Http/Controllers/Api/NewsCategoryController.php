<?php

namespace App\Http\Controllers;

use App\Models\NewsCategory;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\File;
use Intervention\Image\Laravel\Facades\Image as ImageIntervention;

use function Laravel\Prompts\search;

class NewsCategoryController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search ?? null;
        $status = $request->status ?? null;
        $sort_by = $request->sort_by ?? null;
        $per_page = $request->per_page ?? 10;
        $parent_code = $request->parent_code ?? null;
        $main_category = $request->main_category ?? '0';

        $query = NewsCategory::query();

        if ($search !== null) {
            $query->where(function ($sub_query) use ($search) {
                $sub_query->where('title', 'LIKE', '%' . $search . '%')
                    ->orWhere('title_kh', 'LIKE', '%' . $search . '%')
                    ->orWhere('code', 'LIKE', '%' . $search . '%');
            });
        }

        if ($status != null) {
            $query->where('status', $status);
        }

        if ($parent_code != null) {
            $query->where('parent_code', $parent_code);
        }

        if ($main_category == '1') {
            $query->where('parent_code', null);
        }

        switch ($sort_by) {
            case 'title_desc':
                $query->orderBy('title', 'desc');
                break;
            case 'title_asc';
                $query->orderBy('title', 'asc');
                break;
            case 'order_index_desc';
                $query->orderBy('order_index', 'desc');
                break;
            case 'order_index_asc';
                $query->orderBy('order_index', 'asc');
                break;
        }

        $categories = $query
            ->orderBy('order_index', 'asc')
            ->orderBy('id', 'desc')
            ->paginate($per_page);
        return response()->json($categories);
    }



    public function show($id)
    {
        $category = NewsCategory::find($id);

        if (empty($category)) {
            return response()->json([
                'message' => 'Resource not found.',
            ], 404);
        }

        return response()->json($category);
    }
}
