<?php

namespace App\Http\Controllers;

use App\Models\invoice_attachments;
use App\Models\Invoices;
use App\Models\invoices_details;
use App\Models\sections;
use App\Models\User;
use App\Notifications\addinvoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Notification;
use App\Exports\invoicesxport;
use Maatwebsite\Excel\Facades\Excel;
class InvoicesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $invoices = invoices::all();
        return view("Invoices.invoices", compact('invoices'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $sections = sections::all();
        return view('Invoices.add', compact('sections'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        invoices::create([
            'invoice_number' => $request->invoice_number,
            'invoice_Date' => $request->invoice_Date,
            'Due_date' => $request->Due_date,
            'product' => $request->product,
            'section_id' => $request->Section,
            'Amount_collection' => $request->Amount_collection,
            'Amount_Commission' => $request->Amount_Commission,
            'Discount' => $request->Discount,
            'Value_VAT' => $request->Value_VAT,
            'Rate_VAT' => $request->Rate_VAT,
            'Total' => $request->Total,
            'Status' => 'غير مدفوعة',
            'Value_Status' => 2,
            'note' => $request->note,
        ]);


        $invoice_id = invoices::latest()->first()->id;
        invoices_details::create([
            'id_invoices' => $invoice_id,
            'invoice_number' => $request->invoice_number,
            'product' => $request->product,
            'section' => $request->Section,
            'status' => 'غير مدفوعة',
            'value_status' => 2,
            'note' => $request->note,
            'user' => (Auth::user()->name),
        ]);

        if ($request->hasFile('pic')) {
            $invoice_id = Invoices::latest()->first()->id;
            $image = $request->file('pic');
            $file_name = $image->getClientOriginalName();
            $invoice_number = $request->invoice_number;
            $attachments = new invoice_attachments();
            $attachments->file_name = $file_name;
            $attachments->invoice_number = $invoice_number;
            $attachments->Created_by = Auth::user()->name;
            $attachments->invoice_id = $invoice_id;
            $attachments->save();
            // move pic
            $imageName = $request->pic->getClientOriginalName();
            $request->pic->move(public_path('Attachments/' . $invoice_number), $imageName);
        }

        $user = User::all();
        foreach ($user as $f) {
            Notification::send($f, new addinvoice($invoice_id));
        }
        session()->flash('add', 'تم تسجيل الفاتورة بنجاح');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        // return Excel::download(new invoicesxport, 'invoices.xlsx');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $sections = sections::all();
        $invoice = Invoices::findOrFail($id);
        return view('Invoices.edit', compact('sections', 'invoice'));
        // dd($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        //    $validatdata = $request->validate([
        //         'invoice_number' => 'required' ,
        //         'invoice_Date' => 'required',
        //         'Due_date' => 'required',
        //         'product' => 'required',
        //         'section' => 'required',
        //         'Amount_collection' => 'required',
        //         'Amount_Commission' => 'required',
        //         'Discount' => 'required',
        //         'Value_VAT' => 'required',
        //         'Rate_VAT' => 'required',
        //         'Total' => 'required',
        //         'Status' => 'required',
        //         'Value_Status' => 'required',
        //    ],[
        //         'invoice_number.required' => 'من فضلك ادخل جميع البيانات',
        //         'invoice_Date.required' => 'من فضلك ادخل جميع البيانات',
        //         'Due_date.required' => 'من فضلك ادخل جميع البيانات',
        //         'product.required' => 'من فضلك ادخل جميع البيانات',
        //         'Amount_collection.required' => 'من فضلك ادخل جميع البيانات',
        //         'Amount_Commission.required' => 'من فضلك ادخل جميع البيانات',
        //         'Discount.required' => 'من فضلك ادخل جميع البيانات',
        //         'Value_VAT.required' => 'من فضلك ادخل جميع البيانات',
        //         'Rate_VAT.required' => 'من فضلك ادخل جميع البيانات',
        //         'Total.required' => 'من فضلك ادخل جميع البيانات',
        //         'Status.required' => 'من فضلك ادخل جميع البيانات',
        //         'section' => 'من فضلك ادخل جميع البيانات',
        //         'Value_Status.required' => 'من فضلك ادخل جميع البيانات',
        //    ]);
        $invoice = Invoices::findOrFail($request->id);
        // $invoice_attachments = invoice_attachments::where( 'invoice_id', $request->id)->first();
        // if($request->hasFile('file')){
        //     File::delete(public_path() . '/Attachments/' . $request->invoice_number . '/' . $invoice_attachments->file_name);
        //     //    $file_name = $request->file('file')->getClientOriginalName();
        //     $image_name = $request->file->getClientOriginalName();
        //     $invoice_attachments->file_name = $image_name ;
        //     $invoice_attachments->update();
        //     $request->file->move(public_path('Attachments/' . $request->invoice_number),$image_name);
        // }
        $invoice->update($request->all());

        // [
        //     'invoice_number' => $request->invoice_number,
        //     'invoice_Date' => $request->invoice_Date,
        //     'Due_date' => $request->Due_date,
        //     'product' => $request->product,
        //     'section_id' => $request->Section,
        //     'Amount_collection' => $request->Amount_collection,
        //     'Amount_Commission' => $request->Amount_Commission,
        //     'Discount' => $request->Discount,
        //     'Value_VAT' => $request->invoice_number,
        //     'Rate_VAT' => $request->Rate_VAT,
        //     'Total' => $request->Total,
        //     'Status' => $request->Status,
        //     'Value_Status' => $request->Value_Status,
        //     'note' => $request->note,
        // ]
        session()->flash('edit', 'تم التعيل بنجاح');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id)
    {
        $invoice = Invoices::findOrFail($request->id);
        if ($request->process == 1) {
            //soft delete
            $invoice->delete();
            session()->flash('archive', 'تم  الأرشفة بنجاح');

        } else {
            //force delete
            $details = invoice_attachments::where('invoice_id', $id)->first();
            if (!empty($details))
            {
                File::deleteDirectory(public_path() . '/Attachments/' . $details->invoice_number);
            }
            $invoice->forceDelete();
            session()->flash('delete', 'تم الحذف بنجاح');
        }
        return redirect()->back();
        // dd($request->id);
    }
    public function getproducts($id)
    {
        $products = DB::table("products")->where("section_id", $id)->pluck("Product_name", "id");
        return json_encode($products);
    }
    public function change_status_invoice($id)
    {
        $invoice = Invoices::findOrFail($id);
        // $sections = sections::all();
        return view('Invoices.change_status_invoice', compact('invoice'));
    }
    public function store_status_invoice(Request $request)
    {
        $id = $request->id;
        $invoice = Invoices::findOrFail($id);
        $invoice->Status = $request->Status;
        // $invoice->Value_Status = $request->Status;
        if ($request->Status == "غير مدفوعة") {
            $invoice->value_status = 2;
        } elseif ($request->Status == "مدفوعة") {
            $invoice->value_status = 1;
            $invoice->Payment_Date = $request->Payment_Date;
        } else {
            $invoice->value_status = 3;
            $invoice->Payment_Date = $request->Payment_Date;
        }
        $invoice->update();
        $invoice_details = new invoices_details();
        $invoice_details->id_invoices = $request->id;
        $invoice_details->invoice_number = $request->invoice_number;
        $invoice_details->product = $request->product;
        $invoice_details->section = $invoice->section_id;
        $invoice_details->status = $request->Status;
        $invoice_details->note = $request->note;
        $invoice_details->user = Auth::user()->name;
        if ($request->Status == "غير مدفوعة") {
            $invoice_details->value_status = 2;
        } elseif ($request->Status == "مدفوعة") {
            $invoice_details->Payment_Date = $request->Payment_Date;
            $invoice_details->value_status = 1;
        } else {
            $invoice_details->Payment_Date = $request->Payment_Date;
            $invoice_details->value_status = 3;
        }
        $invoice_details->save();
        session()->flash('edit', 'تم تحديث حالة الدفع بنجاح');
        return redirect('/invoices');
    }
    public function invoices_paid()
    {
        $invoices  = invoices::where('Value_Status', 1)->get();
        return view('Invoices.invoices_paid', compact('invoices'));
    }
    public function invoices_unpaid()
    {
        $invoices  = invoices::where('Value_Status', 2)->get();
        return view('Invoices.invoices_unpaid', compact('invoices'));
    }
    public function invoices_partial()
    {
        $invoices  = invoices::where('Value_Status', 3)->get();
        return view('Invoices.invoices_partial', compact('invoices'));
    }
    public function invoices_archive(){
        $invoices = invoices::onlyTrashed()->get();
        return view('Invoices.invoices_archive',compact('invoices'));
    }
    public function print_invoice($id){
        $invoice = Invoices::findOrFail($id);
        return view('Invoices.print_invoice',compact('invoice'));
    }
    public function export()
    {

        return Excel::download(new invoicesxport, 'invoices.xlsx');
    }
}
