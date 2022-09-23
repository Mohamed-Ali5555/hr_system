<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\section;
use App\Models\AdditionAndDiscount;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session ;

use App\Models\Salary_report;
use App\Models\Employeer;
class AdditionAndDiscountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sections  = section ::all();
        $addition_and_discounts = AdditionAndDiscount::orderBy('id','DESC')->get();
        
        return view('backend.addition_and_discount.index',compact('sections','addition_and_discounts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sections  = section ::all();
        $employers  = Employeer ::all();

        return view('backend.addition_and_discount.create',compact('sections','employers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request )
    {
      
        $data=$request->all();


        $this->validate($request, [
            // 'employer' => 'string|required',
            'discount' => 'required|numeric',
            'addition' => 'required|numeric',
            'total' => 'required|numeric',

            'hour_price' => 'required|numeric',
            'employer_id'=>'required|exists:employeers,id',
            'week_holiday' => 'nullable',

         ]);
        
      

$new = AdditionAndDiscount::create([
    'discount' => $request->discount,
    'addition' => $request->addition,
    'total' => $request->total,
    'hour_price' => $request->hour_price,
    'employer_id' => $request->employer_id,
    // 'section_id' => $request->section_id,

    'week_holiday' => implode(',', (array) $data['week_holiday']),
    // 'week_holiday'=>json_encode($request->week_holiday),
]);





$salary =  \App\Models\Employeer::where('id', $request->employer_id)->value('salary');



$upsent_days=\App\Models\Salary_report::where('id',$request->employer_id)->value('upsent');
// return $upsent_days;


// return $salary_reports43->upsent;
// $attendance = \App\Models\Salary_report::select('upsent');

if($upsent_days!=null){

$employer_salary=Salary_report::where('employer_id',$request->employer_id)
->update([
    'addition_id'=>$new->id,
    'hour_price' => $request->hour_price,

    'discount' => $request->discount,
    'addition' => $request->addition,
    'total' => $request->total,
    // 'salary' => $request->Salary_report->salary,

    'week_holiday' => implode(',', (array) $data['week_holiday']),
        // 'week_holiday'=>json_encode($request->week_holiday),


    

    
    'all_total' => $request->all_total= ($salary+$request['total']) - $upsent_days*8*$request['hour_price']
    // (($upsent_days)*8*($request['hour_price']))
    ,

]);
}else{
                                
    $employer_salary=Salary_report::where('employer_id',$request->employer_id)
    ->update([
        'attendance_id'=>$new->id,
        'attendance' => 0,
        
        'upsent' => 0,
    ]);
}

// $addition->save();
// $week_holiday = $request->input('week_holiday');
// dd($week_holiday);
// $new = AdditionAndDiscount::create($week_holiday);

return redirect()->route('addition_and_discount.index')->with('success','Successfuly created addition_and_discount');


      //      return redirect()->route('backend.addition_and_discount.index')->with('success','Successfuly created addition_and_discount');


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
        $addition_and_discounts = AdditionAndDiscount::find($id);

        // $addition_and_discounts = AdditionAndDiscount::where('id',$id)->get();
        if($addition_and_discounts){
            return view('backend.addition_and_discount.edit',compact('addition_and_discounts','sections','employers'));
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
        $addition_and_discount = AdditionAndDiscount::find($id);
        if($addition_and_discount){


        //    $this->validate($request, [

        //        'first_name' => 'string|required',
        //                // 'slug' =>'string|required|exists:sections,slug',
   
        //        'address' => 'string|required',
        //        'email' => 'email|required',
        //        'phone' => 'required|max:30|min:11',
        //        'date' => 'date|required',
        //        'type' => 'required|in:mail,femail',
        //        'date_of_contact' => 'date|required',
        //        // 'start_time' => 'required|after:' . Carbon::now()->format('H:i:s'),
        //        // 'end_time' => 'required|after:start_time',
        //        'national_id'=>'required|numeric',
        //        'nationality'=>'string|required',
        //        'photo'=>'required',
        //        'salary'=>'required|numeric',
        //        'note'=>'string|nullable',
        //        'section_id'=>'required|exists:sections,id',
        //        'status' => 'nullable|in:pending,accept',
               
   
        //    ],[
        //        'phone.required'    => 'من فضلك ادخل رقم تليفون صحيح ',
    
        //     ]);
            $data = $request->all();
            $new = $addition_and_discount->fill($data)->save();
            if($new){
                return redirect()->route('addition_and_discount.index')->with('success','Successfuly updated addition_and_discount');
                //redirect()->route('backend.addition_and_discount.index')->with('success','successfully updated addition_and_discount');

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
        $addition_and_discount = AdditionAndDiscount::find($id);
        if($addition_and_discount){
                  $status = $addition_and_discount->delete();
                  if($status){
                   
                    return redirect()->route('addition_and_discount.index')->with('success','Successfuly deleted addition_and_discount');
                }else{
                      return back()->with('error','something went wrong');
                  }
        }else{
            return back()->with('error','Data not found !');
        }
    }
}
