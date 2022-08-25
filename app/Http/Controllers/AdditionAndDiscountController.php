<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\section;
use App\Models\AdditionAndDiscount;
use Illuminate\Support\Facades\DB;

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
        
        // $data['week_holiday'] = $request->input('week_holiday');    
     
        
        // if($new){
        //     return redirect()->route('addition_and_discount.index')->with('success','Successfuly created Attendance');
        // }else{
        //     return back()->with('error','something went wrong!');
        // }

        // $input = $request->all();
        // $input['week_holiday'] = $request->input('week_holiday');
        // AdditionAndDiscount::create($input);
        // return redirect()->route('addition_and_discount.index');
//         if(!empty($request->input['week_holiday'])){
//             $will_insert = [];
//             foreach($request->input('week_holiday') as $key=> $value){
//                 array_push($will_insert,['week_holiday'=>$value]);
//             }
//             \DB::table('addition_and_discounts')->insert($will_insert);

//         }else{
//             $checkbox ='';
//         }
// //    $new = AdditionAndDiscount::create($data);
//     //   if($new){
//             return redirect()->route('addition_and_discount.index')->with('success','Successfuly created Attendance');
//         // }else{
//         //     return back()->with('error','something went wrong!');
//         // }

// $this->validate($request, [
//     'employer' => 'string|required',
//     'hour_price' => 'string|required',
//     'addition' => 'nullable',
//     'discount' => 'nullable',

//     'section_id'=>'required|exists:sections,id',
//     'total'=>'required|numeric',
//     'week_holiday'=>'required',


// ]);

// $addition = new AdditionAndDiscount;
// $addition->discount = $request->discount;
// $addition->addition = $request->addition;
// $addition->hour_price = $request->hour_price;
// $addition->total = $request->total;
// $addition->employer = $request->employer;
// $addition->section_id = $request->section_id;
// // $addition->week_holiday = $request->week_holiday;


// $data['week_holiday'] = json_encode($request->week_holiday);
// $data=$request->all();

// $new = AdditionAndDiscount::create($data);
// $data['week_holiday'] = json_encode($request->week_holiday);

// $addition->save();
/////////////////////////////////////

// $addition_id = AdditionAndDiscount::latest()->first();  // this code give invoices id to invoices details
// $addition=  new Salary_report;
    
    
//     $addition->total = $request->total;
//     $addition->hour_price = $request->hour_price;
//     $addition->id = $request->addition_id;

//     $addition->discount = $request->discount;

//     $addition->addition = $request->addition;
//     $addition->week_holiday = $request->week_holiday;

// $addition->save();
// return json_encode($addition);


$new = AdditionAndDiscount::create([
    'discount' => $request->discount,
    'addition' => $request->addition,
    'total' => $request->total,
    'hour_price' => $request->hour_price,
    'employer_id' => $request->employer_id,
    // 'section_id' => $request->section_id,

    'week_holiday' => implode(',', (array) $data['week_holiday']),
]);


// $addition_id = AdditionAndDiscount::latest()->first()->id;  // this code give invoices id to invoices details
// $addition=  new Salary_report;
// $update = Product::findorfail($product_id);

// Salary_report::create([
//    'addition_id' => $addition_id,
//        'total' => $request->total,
//        'hour_price' => $request->hour_price,
    
//        'discount' => $request->discount,
//        'addition' => $request->addition,
//        'total' => $request->total,
//        'week_holiday' => implode(',', (array) $data['week_holiday']),

  

// ]);
$employer_salary=Salary_report::where('employer_id',$request->employer_id)
->update([
    'addition_id'=>$new->id,
    'hour_price' => $request->hour_price,

    'discount' => $request->discount,
    'addition' => $request->addition,
    'total' => $request->total,
    'week_holiday' => implode(',', (array) $data['week_holiday']),
]);


// $addition->save();
// $week_holiday = $request->input('week_holiday');
// dd($week_holiday);
// $new = AdditionAndDiscount::create($week_holiday);


return redirect()->route('addition_and_discount.index')->with('success','Successfuly created addition_and_discount');


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
