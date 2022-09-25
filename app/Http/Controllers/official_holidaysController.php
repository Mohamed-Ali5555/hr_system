<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\section;
use App\Models\official_holidays;
use App\Models\Employeer;
use Illuminate\Support\Facades\DB;

class official_holidaysController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $employers = Employeer::all();
        $employers = Employeer::select('id', 'first_name')->get();
        $sections = section::select('id', 'section_name')->get();

        // $sections  = section ::all();
        $official_holidays = official_holidays::orderBy('id','DESC')->get();
        
        return view('backend.official_holidays.index',compact('sections','official_holidays','employers'));
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
        $data=$request->all();
         $validated = $request->validate([
            'section_id'=>'required',
            // 'employer_id'=>'required|exists:employeers,id',

            'week_holiday' => 'required',
        ]);
        $new = official_holidays::create([
           
            'employer_id' => $request->employer_id,
            'section_id' => $request->section_id,
        
            'week_holiday' => implode(',', (array) $data['week_holiday']),
            // 'week_holiday'=>json_encode($request->week_holiday),
        ]);

        // return $request->all();
        
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
        $sections  = section ::all();
        $employers   = Employeer ::all();
       

        $official_holidays = official_holidays::find($id);
        if($official_holidays){
            return view('backend.official_holidays.edit',compact('official_holidays','sections','employers'));
        }else{
            return back()->with('error','Data not found !');
        }
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
            'section_id'=>'required',
            // 'employer_id'=>'required|exists:employeers,id',

            'week_holiday' => 'required',
        ]);



// return $request->all();

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



    public function destroy($id)
    {
        $official_holidays = official_holidays::find($id);
        if($official_holidays){
                  $status = $official_holidays->delete();
                  if($status){
                   
                    return redirect()->route('official_holidays.index')->with('success','Successfuly deleted official_holidays');
                }else{
                      return back()->with('error','something went wrong');
                  }
        }else{
            return back()->with('error','Data not found !');
        }
    }






    
    public function getproducts($id)
    {
        // dd( $id);

        $employers = DB::table('employeers')->where('section_id',$id)->pluck('first_name','id');//section_id = id =>that is come from rote when you pres on it and pluck product_name with id 
        return json_encode($employers);
        // return $request->all();
    }

}



    //   // return $request->all();
    //   $addition_and_discount = AdditionAndDiscount::find($id);
    //   if($addition_and_discount){


    //   //    $this->validate($request, [

    //   //        'first_name' => 'string|required',
    //   //                // 'slug' =>'string|required|exists:sections,slug',
 
    //   //        'address' => 'string|required',
    //   //        'email' => 'email|required',
    //   //        'phone' => 'required|max:30|min:11',
    //   //        'date' => 'date|required',
    //   //        'type' => 'required|in:mail,femail',
    //   //        'date_of_contact' => 'date|required',
    //   //        // 'start_time' => 'required|after:' . Carbon::now()->format('H:i:s'),
    //   //        // 'end_time' => 'required|after:start_time',
    //   //        'national_id'=>'required|numeric',
    //   //        'nationality'=>'string|required',
    //   //        'photo'=>'required',
    //   //        'salary'=>'required|numeric',
    //   //        'note'=>'string|nullable',
    //   //        'section_id'=>'required|exists:sections,id',
    //   //        'status' => 'nullable|in:pending,accept',
             
 
    //   //    ],[
    //   //        'phone.required'    => 'من فضلك ادخل رقم تليفون صحيح ',
  
    //   //     ]);
    //       $data = $request->all();
    //       $new = $addition_and_discount->fill($data)->save();
    //       if($new){
    //           return redirect()->route('addition_and_discount.index')->with('success','Successfuly updated addition_and_discount');
    //           //redirect()->route('backend.addition_and_discount.index')->with('success','successfully updated addition_and_discount');

    //       }else{
    //           return back()->with('error','something went wrong!');
    //       }



    //       }else{
    //           return back()->with('error','Data not found !');
    //       }