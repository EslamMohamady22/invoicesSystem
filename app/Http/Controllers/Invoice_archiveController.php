<?php

namespace App\Http\Controllers;

use App\Models\invoice_attachments;
use App\Models\Invoices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class Invoice_archiveController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        Invoices::withTrashed()->where('id',$id)->restore();
        session()->flash('restore_invoice','تم استرجاع الفاتورة');
        return redirect('/invoices');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id,Request $request)
    {
        $invoice = Invoices::onlyTrashed()->where('id',$id)->first();
        //force delete
        $details = invoice_attachments::where('invoice_id', $id)->first();
        if (!empty($details)) {
            File::deleteDirectory(public_path() . '/Attachments/' . $details->invoice_number);
        }
        $invoice->forceDelete();
        session()->flash('delete', 'تم الحذف بنجاح');
        return redirect()->back();
        // dd($request->id);
    }
}
