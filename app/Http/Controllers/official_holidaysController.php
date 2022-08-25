<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\section;
use App\Models\official_holidays;

class official_holidaysController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sections  = section ::all();
        $official_holidays = official_holidays::orderBy('id','DESC')->get();
        
        return view('backend.official_holidays.index',compact('sections','official_holidays'));
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
            'name' => 'string|required',
        // 'slug' =>'string|required|exists:sections,slug',
        'date' => 'date|required',

        ],[
            'name.required'=>'you should filll',
        ]);
        $data=$request->all();
       
        $new = official_holidays::create($data);
        if($new){
            return redirect()->route('official_holidays.index')->with('success','Successfuly created official_holidays');
        }else{
            return back()->with('error','something went wrong!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // return $request->all();
        $official_holidays = official_holidays::find($id);
        if($official_holidays){


           $this->validate($request, [

               'name' => 'string|required',
               'date' => 'date|required',
       
               
   
           ],[
               'name.required'    => 'من فضلك ادخل رقم تليفون صحيح ',
    
            ]);
    $data = $request->all();
    $new = $official_holidays->fill($data)->save();
    if($new){
        return redirect()->route('official_holidays.index')->with('success','successfully updated official_holidays');

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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
