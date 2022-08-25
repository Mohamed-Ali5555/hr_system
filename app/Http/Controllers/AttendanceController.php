<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\section;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

use App\Models\Attendance;
use App\Models\Salary_report;
use App\Models\Employeer;

class AttendanceController extends Controller
{
    








    public function invoices($id){
        echo 'dddddddddddd';
        $salary_reports = Salary_report::findOrfail($id); 
        return view ('salary_reports.invoices',compact('salary_reports'));

    }









    public function index()
    {
        $sections  = section ::all();
        $attendances = Attendance::orderBy('id','DESC')->get();
        $employers  = Employeer ::all();

        return view('backend.Attendance.index',compact('sections','attendances','employers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
     
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //  return $request->all();
        // $this->validate($request, [
        //     'employer' => 'string|required',
        //     'start_time' => 'required|after:' . Carbon::now()->format('h:i:s'),
        //     'end_time' => 'required|after:start_time',
        //     'today' => 'date|required',
        //     'section_id'=>'required|exists:sections,id',
            
        //        'status' => 'nullable|in:attendance,upsent',

        // // 'slug' =>'string|required|exists:sections,slug',
        //     // 'photo' => 'required',

        // ],[
        //     'section_id.required'    => 'من فضلك اختر اسم القسم  ',

 
        //  ]);
        // try {


        // foreach($request->status as $attendance3 =>$attendance){
        //     if($attendance=='attendance'){
        //         // return true;
        //         $status='attendance';
        //     }elseif($attendance=='upsent'){
        //         // return false;
        //         $status='upsent';

        //     }
      



        $data=$request->all();
        $slug = Str::slug($request->input('employer_id'));
        $slug_count = Attendance::where('slug',$slug)->count();
        if($slug_count>0){
            $slug = time(). '-' .$slug;
        }
        $data['slug']=$slug;
        //  $data['slug']='dddd';



        //هنا معايا رقم الموظف ؟
        $new = Attendance::create($data);
  
        //لما تربط الغياب برقم الموظف ... هنعمل كده try save?
        //لو عايز تجرب هنحط اى رقم دلوقت للموظف لحد ما تهندله انت فى الفورم .. اوك؟
        
    

        $employer_salary=Salary_report::where('employer_id',$request->employer_id)
                                        ->update([
                                            'attendance_id'=>$new->id,
                                            'status' => $request->status,
                                        ]);

                                    //     return redirect()->route('Attendance.index')->with('success','Successfuly created Attendance');
                                    // }finally{
                                    //     return back()->with('error','something went wrong!');
                                    // }
                                    
        if($new){
            return redirect()->route('Attendance.index')->with('success','Successfuly created Attendance');
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
        echo 'dddddddddddd';
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

        $attendances = Attendance::find($id);
        if($attendances){
            return view('backend.Attendance.edit',compact('attendances','sections'));
        }else{
            return back()->with('error','Data not found !');
        }    }

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
        $attendances = Attendance::find($id);
        if($attendances){


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
    $new = $attendances->fill($data)->save();
    if($new){
        return redirect()->route('Attendance.index')->with('success','successfully updated attendance');

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
        // return $id;
        $attendance = Attendance::find($id);
        if($attendance){
                  $status = $attendance->delete();
                  if($status){
                   
                      return redirect()->route('Attendance.index')->with('success','attendances successfuly deleted');
                  }else{
                      return back()->with('error','something went wrong');
                  }
        }else{
            return back()->with('error','Data not found !');
        }
    }


    public function getproducts($id){
        // dd( $id);

        $employers = DB::table('employeers')->where('section_id',$id)->pluck('id','first_name');//section_id = id =>that is come from rote when you pres on it and pluck product_name with id 
        return json_encode($employers);
        // return $request->all();
    }









    public function search(Request $request){
        $employers = Employeer::all();

        $query=$request->input('query');
        if($query!=""){
            $attendances = Attendance::all();

        $attendances=Employeer::join('attendances','attendances.employer_id','=','employeers.id')->where('employeers.first_name','LIKE','%'.$query.'%')->Orwhere('attendances.status','LIKE','%'.$query.'%')->get();
        // $attendances = Employeer::where('first_name', 'like' , '%' .$query.'%')->get();

        $sections=section::where('section_name','LIKE','%'.$query.'%')->orderBy('id','DESC')->get();
        }else{
            $attendances  = Attendance ::all();
        } 

        return view('backend.Attendance.index',compact('attendances','sections','employers'));
    } 



/////////////////////////////////
///////////////////////////////////
///////////////////////////////////
//////////////////////////////////
public function Search_attendances(Request $request){
   
    $sections  = section ::all();
    $employers = Employeer::all();

 // في حالة عدم تحديد تاريخ
        if ( $request->start_at  && $request->end_at) {
            $start_at = date($request->start_at);
            $end_at = date($request->end_at);

              
          $attendances = Attendance::whereBetween('today',[$start_at,$end_at])->get();
          return view('backend.Attendance.index',compact('attendances','start_at','end_at','sections','employers'))->withDetails($attendances);
          
        }
        
        // في حالة تحديد تاريخ استحقاق
        else {
           

            $attendances  = Attendance ::all();
        
        }

 
        
    

    
     
    
}



}