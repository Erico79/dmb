<?php

namespace App\Http\Controllers;

use App\Category;
use App\Document;
use App\Masterfile;
use App\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Http\Controllers\CrmController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use PhpParser\Comment\Doc;

class DocumentController extends Controller
{
    public function index(CrmController $crm, SupplierController $supplier){
        $docs = Document::all();
        $customers = $crm->allCustomers();
        $suppliers = $supplier->allSuppliers();
        $cats = Category::whereNotNull('parent_category')->get();

        return view('inventory.upload-doc')
            ->with([
                'documents' => $docs,
                'customers' => $customers,
                'suppliers' => $suppliers,
                'categories' => $cats,
            ]);
    }

    public function store(Request $request){
        $this->validate($request, [
            'document_name' => 'required|unique:documents',
            'attach_to' => 'required'
        ]);

        // upload document
        $document_path = $this->uploadDocument();
        $user_id = Auth::user()->id;

        $doc = new Document();
        $doc->document_name = $request->document_name;
        $doc->created_by = $user_id;
        $doc->customer_mfid = (!empty($request->customer)) ? $request->customer : NULL;
        $doc->supplier_mfid = (!empty($request->supplier)) ? $request->supplier : NULL;
        $doc->document_path = $document_path;
        $doc->parent_doc = (!empty($request->attach_to_doc)) ? $request->attach_to_doc : NULL;
        $doc->attached_to = $request->attach_to;
        $doc->category_id = $request->category;
        $doc->save();

        $request->session()->flash('status', 'The document has been uploaded!');
        return redirect('/upload-doc-view');
    }

    public function uploadDocument(){
        $path = '';
        if(Input::hasFile('uploaded_doc')){
            $prefix = uniqid();
            $image = Input::file('uploaded_doc');
            $filename = $image->getClientOriginalName();
            $new_name = $prefix.$filename;

            if($image->isValid()) {
                $image->move('uploads/docs', $new_name);
                $path = 'uploads/docs/'.$new_name;
            }
        }
        return $path;
    }

    public function getUploadedDocs(){
        $docs = Document::all();
        $all = Masterfile::where('b_role', 'customer')->orWhere('b_role', 'supplier')->get();

        if(isset($_GET['filter_by']) && ($_GET['filter_by'] == 'customer' || $_GET['filter_by'] == 'supplier'))
            $docs = Document::where('attached_to', $_GET['filter_by'])->get();
        else
            $docs = Document::all();

        $cats = Category::whereNotNull('parent_category')->get();
        $staff = Masterfile::where('b_role', 'Staff')->get();

        return view('inventory.all-uploaded-docs', [
            'documents' => $docs,
            'all' => $all,
            'cats' => $cats,
            'staff' => $staff
        ]);
    }

    public function showDocProfile($id){
        $doc = Document::find($id);

        return view('inventory.doc-profile')
            ->with([
                'doc' => $doc
            ]);
    }

    public function destroy(Request $request){
        try {
            Document::destroy($request->document_id);

            $request->session()->flash('status', 'Document has been deleted');
            return redirect('/upload-doc-view');
        } catch (QueryException $qe) {
            $request->session()->flash('warning', 'Cannot delete the document; It has other versions related to it!');
            return redirect('/upload-doc-view');
        }
    }
}
