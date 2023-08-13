<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Document;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public $page_name = "Document";

    public function index()
    {
        $data =  Document::all();
        return view('admin.document.index', ['page' => $this->page_name,'data' => $data]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'document_name' => 'string|required',
            'document_type' => 'required|string',
            'document' => 'required|file|mimes:jpeg,jpg,png,pdf',
           
        ]);
        if ($validator->fails()) {
            return $validator->errors();
        } else {
            $documentData = $request->except('_token');
        
            if ($request->hasFile('document')) {
                $file = $request->file('document');
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '.' . $extension;
                $file->move('asset/img', $filename);
                $documentData['document'] = $filename;
            }
        
            Document::create($documentData);
        
            return response()->json(['success' => $this->page_name . " Added Successfully"]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = Document::find($id);
        return view('admin.document.edit', ['data' => $data, 'page' => $this->page_name]);   
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'document_name' => 'string|required',
            'document_type' => 'required|string',
            'document' => 'required|file|mimes:jpeg,jpg,png,pdf',
        ]);
        if ($validator->fails()) {
            return $validator->errors();
         } 
         else {
            $documentData = $request->except('_token', '_method');
        
            if ($request->hasFile('document')) {
                $file = $request->file('document');
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '.' . $extension;
                $file->move('asset/img', $filename);
                $documentData['document'] = $filename;
            }
        
            Document::where('id', $id)->update($documentData);
            // Document::where('id', $id)->update($request->except('_token', '_method'));
            return response()->json(['success' => $this->page_name . " Updated Successfully"]);
         }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            Document::destroy($id);
            return "Delete";
        } catch (Exception $e) {
            return response()->json(["error" => $this->page_name . "Can't Be Delete this May having some Employee"]);
        }
    }
}
