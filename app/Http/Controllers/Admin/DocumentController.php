<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Document;
use App\Models\DocumentEmp;
use App\Models\DocumentType;
use App\Models\Employee;
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
        $documentType = DocumentType::getDocumentType()->get();
        $all_users = Employee::with('user')->get();
        return view('admin.document.index', ['page' => $this->page_name,'data' => $data,'all_users'=>$all_users, 'documentType' => $documentType]);

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
                $filename = $file->getClientOriginalName();
                $file->move('assets/document', $filename);
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
        $documentType = DocumentType::getDocumentType()->get();
        return view('admin.document.edit', ['data' => $data, 'page' => $this->page_name, 'documentType' => $documentType]);
    }

    public function documentAssignedit(string $id)
    {
        $data = Document::find($id);
        // return $data;
        $all_users = Employee::with('user')->get();
        return view('admin.document.asign_emp', ['data' => $data, 'page' => $this->page_name,'all_users'=>$all_users]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'document_name' => 'string|required',
            'document_type' => 'required|string',
            'document' => 'nullable|file|mimes:jpeg,jpg,png,pdf',
        ]);
        if ($validator->fails()) {
            return $validator->errors();
         }
         else {
            $documentData = $request->except('_token', '_method');

            if ($request->hasFile('document')) {
                $file = $request->file('document');
                $extension = $file->getClientOriginalExtension();
                $filename = $file->getClientOriginalName();
                $file->move('assets/document', $filename);
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

    public function asign(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'document_id' => 'required|numeric',
            'emp_id' => 'required|array',
        ]);

        if ($validator->fails()) {
            return $validator->errors();
        } else {
            try {
                $documentId = $request->input('document_id');
                $empIds = $request->input('emp_id');

                // Fetch existing assignments for the document
                $existingAssignments = DocumentEmp::where('document_id', $documentId)
                    ->get();

                // Delete assignments that are unchecked
                foreach ($existingAssignments as $assignment) {
                    if (!in_array($assignment->emp_id, $empIds)) {
                        $assignment->delete();
                    }
                }

                // Create new assignments for checked employees
                foreach ($empIds as $empId) {
                    $isAssigned = $existingAssignments->contains('emp_id', $empId);

                    if (!$isAssigned) {
                        DocumentEmp::create([
                            'document_id' => $documentId,
                            'emp_id' => $empId,
                            'created_at' => now(),
                        ]);
                    }
                }

                return response()->json(['success' => $this->page_name . " Updated Successfully"]);
            } catch (Exception $e) {
                return response()->json(['error' => $e->getMessage()]);
            }
        }
    }
}
