<?php

namespace App\Http\Controllers;

use App\Models\invoice_attachments;
use App\Models\Invoices;
use App\Models\invoices_details;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Crypt;

class InvoicesDetailsController extends Controller
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
    public function show(invoices_details $invoices_details)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(invoices_details $invoices_details)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, invoices_details $invoices_details)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(invoices_details $invoices_details)
    {
        //
    }
    public function invoices_details($id)
    {
        $invoice = Invoices::where('id', $id)->first();
        $invoice_details = invoices_details::where('id_invoices', $invoice->id)->get();
        $invoice_attachment = invoice_attachments::where('invoice_id', $invoice->id)->get();
        return view('Invoices.Invoices_details.invoices_details', compact('invoice', 'invoice_details', 'invoice_attachment'));
    }
    // public function open_file($invo_num , $file) {
    //     // $files = Storage::disk('public_uplodes')->getDriver()->getAdapter()->applayPathPrefix($invo_num.'/'.$file);
    //     // return response()->file($files);
    //     $files = Storage::disk('public_uploads')->getDriver($invo_num.'/'.$file);
    //     return response()->file($files);
    // }
    public function open_file(Request $request)
    {
        // $path = public_path('Attachments/' . $invo_num);
        //   $images = \File::allFiles(public_path('Attachments/' . $invo_num), $file);
        //   return View('Invoices.Invoices_details.openfile',compact('images','invo_num','file','path'));
        // return redirect('/Attachments/'.$request->invo_num.'/'.$request->file);
        // return redirect(Crypt::encrypt('/Attachments/'.$request->invo_num.'/'.$request->file));
        return response()->file('Attachments/' . $request->invo_num . '/' . $request->file);
    }
    function download_file(Request $request)
    {
        $file = public_path() . '/Attachments/' . $request->invo_num . '/' . $request->file;
        // $type = $request->file($request->file)->extension();
        $infoPath = pathinfo(public_path() . '/Attachments/' . $request->invo_num . '/' . $request->file);
        $extension = $infoPath['extension'];
        $headers = array(
            'Content-Type: application/pdf',
        );
        return response()->download($file, $request->invo_num . '.' . $extension, $headers);
    }
    function delete_file(Request $request)
    {
        // $file = public_path() . '/Attachments/' . $request->invo_num . '/' . $request->file;
        // // $type = $request->file($request->file)->extension();
        // $infoPath = pathinfo(public_path() . '/Attachments/' . $request->invo_num . '/' . $request->file);
        // $extension = $infoPath['extension'];
        // $headers = array(
        //     'Content-Type: application/pdf',
        // );
        // $file->
        $id = $request->invo_id ;
        invoice_attachments::where('id',$id)->first()->update(['file_name' => 'null']);
        File::delete(public_path() . '/Attachments/' . $request->invo_num . '/' . $request->file);
        session()->flash('delete',"تم حذف الملف بنجاح");
        return back();
    }
}
