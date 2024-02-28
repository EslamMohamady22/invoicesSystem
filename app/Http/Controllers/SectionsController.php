<?php

namespace App\Http\Controllers;

use App\Models\sections;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SectionsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sections = sections::all();
        return view('Sections.sections', compact('sections'));
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
        $input = $request->all();
        $validatedata = $request->validate(
            ['section_name' => 'required|unique:sections|max:255'],
            [
                'section_name.required'=> "من فضلك ادخل اسم القسم",
                'section_name.unique'=> 'هذا القسم مسجل مسبقا'
            ]);
        // $if_exist = sections::where('section_name', "=" , $input['section_name'])->exists();
        // if($if_exist)
        // {
        //     session()->flash("Error" , "خطأ مسجل مسبقا");
        //     return redirect('/sections');
        // }

            sections::create([
                'section_name' => $request->section_name,
                'description' => $request->description,
                'Created_by' => Auth::user()->name
            ]);
            // session()->flash('add' , "تم تسجيل قسم جديد بنجاح");
            // return redirect('/sections');
            session()->flash('add', 'تم الأضافة بنجاح ');
            return redirect('/sections');

    }

    /**
     * Display the specified resource.
     */
    public function show(sections $sections)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(sections $sections)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $id = $request->id;
       $validatedata = $request->validate([
        'section_name' => 'required|max:255|unique:sections,section_name,'.$id,

       ],[
            'section_name.required' => 'من فضلك ادخل اسم القسم',
            'section_name.unique' => 'هذا القسم مسجل مسبقا',
       ]);
       $section = sections::find($id);
       $section->update([
        'section_name'=>$request->section_name,
        'description'=>$request->description
       ]);
       session()->flash('edit',"تم التعديل بنجاح");
       return redirect('/sections');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        sections::find($request->id)->delete();
        session()->flash('delete',"تم الحذف بنجاح");
        return redirect('/sections');
    }
}
