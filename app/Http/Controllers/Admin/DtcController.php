<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dtc;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DtcController extends Controller
{
    public function index()
    {
        $dtcs = Dtc::paginate(10);
        return view('admin.dtcs.index', compact('dtcs'));
    }
    
    public function create()
    { 
        return view('admin.dtcs.create');
    }

    public function show($dtc_code)
    {
        $dtc = Dtc::where('dtc_code', $dtc_code)->first();
        return view('admin.dtcs.show', compact('dtc'));
    }
    
    public function edit($id)
    {
        $dtc = Dtc::findOrFail($id);
        return $dtc;
        // return view('admin.dtcs.edit', compact('dtc'));
    }
 
 
    public function store(Request $request)
    {
        // Validation rules
        $validator = Validator::make($request->all(), [
            'dtc_code' => 'required|string|max:255',
            'description_en' => 'required',
            'description_kh' => 'required',
        ]);

        // If validation fails
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // Validation passed, proceed with storing data
        $data = $request->only(['dtc_code', 'description_en', 'description_kh']);
        Dtc::create($data);
        
        return redirect()->route('admin.dtcs.index')->with('success', 'DTC created successfully.');
    }

    public function update(Request $request, $id)
    {
        // Validation rules
        $validator = Validator::make($request->all(), [
            'dtc_code' => 'required|string|max:255',
            'description_en' => 'required',
            'description_kh' => 'required',
        ]);

        // If validation fails
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // Validation passed, proceed with updating data
        $data = $request->only(['dtc_code', 'description_en', 'description_kh']);
        Dtc::findOrFail($id)->update($data);
        
        return redirect()->route('admin.dtcs.index')->with('success', 'DTC updated successfully.');
    }
    
    public function destroy($id)
    {
        Dtc::findOrFail($id)->delete();
        
        return redirect()->route('admin.dtcs.index')->with('success', 'DTC deleted successfully.');
    }
}
