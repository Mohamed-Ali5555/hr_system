<?php

namespace App\Http\Controllers;

use App\Models\section;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
    $sections = section::orderBy('id','DESC')->get();
        return view('backend.section.index',compact('sections'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request->all();
        $validated = $request->validate([
            'section_name' => 'string|required',
        // 'slug' =>'string|required|exists:sections,slug',
            'photo' => 'required',

        ],[
            'section_name.required'=>'you should filll',
        ]);
        $data=$request->all();
        $slug = Str::slug($request->input('section_name'));
        $slug_count = section::where('slug',$slug)->count();
        if($slug_count>0){
            $slug = time(). '-' .$slug;
        }
        $data['slug']=$slug;
        $new = section::create($data);


        if($new){
            return redirect()->route('section.index')->with('success','Successfuly created section');
        }else{
            return back()->with('error','something went wrong!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\section  $section
     * @return \Illuminate\Http\Response
     */
    public function show(section $section)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\section  $section
     * @return \Illuminate\Http\Response
     */
    public function edit( $id)
    {
        $section = section::find($id);
        if($section){
            return view('backend.section.edit',compact('section'));
        }else{
            return back()->with('error','Data not found !');
        }    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\section  $section
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // return $request->all();
        $section = section::find($id);
        if($section){


    //   // return $request;
      $validated = $request->validate([
        'section_name' => 'string|required',
        'photo' => 'required',

    ]);
    $data = $request->all();
    $new = $section->fill($data)->save();
    if($new){
        return redirect()->route('section.index')->with('success','successfully updated section');

    }else{
         return back()->with('error','something went wrong!');
    }



        }else{
            return back()->with('error','Data not found !');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\section  $section
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        $section = section::find($id);
        if($section){
                  $status = $section->delete();
                  if($status){
                   
                      return redirect()->route('section.index')->with('success','section successfuly deleted');
                  }else{
                      return back()->with('error','something went wrong');
                  }
        }else{
            return back()->with('error','Data not found !');
        }
    }
























   
    
}
