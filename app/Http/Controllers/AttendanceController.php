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
    







    public function index()
    {
        $sections  = section ::all();
        $attendances = Attendance::orderBy('id','DESC')->get();
        $employers  = Employeer ::all();

        return view('backend.Attendance.index',compact('sections','attendances','employers'));
    }

 
    public function store(Request $request)
    {
        $this->validate($request, [
            // 'employer' => 'string|required',
            'start_time' => 'required',
            'end_time' => 'required|after:start_time',
            'today' => 'date|required|after_or_equal:today',
            'employer_id'=>'required|exists:employeers,id',
            
            'status' => 'nullable|in:attendance,upsent',

  

        ],[
            'section_id.required'    => 'من فضلك اختر اسم القسم  ',
         ]);
 

        $data=$request->all();
        // return $request->all();
        $slug = Str::slug($request->input('employer_id'));
        $slug_count = Attendance::where('slug',$slug)->count();
        if($slug_count>0){
            $slug = time(). '-' .$slug;
        }
        $data['slug']=$slug;
  
         //////////////////
         ///////////////
        // get All variables

        $employer_id = $request->employer_id;
        $employee_date = $request->today;    /// check the today
        $status = $request->status;
        $employee_attendance_time = $request->start_time;
        $employee_end_time = $request->end_time;
        
        // $new = Attendance::create($data);
 
        $absence_date_exists = Attendance::where('date', $employee_date)->where('employer_id', $employer_id)->exists();

        if($absence_date_exists){
            $attendance = Attendance::where('employer_id', $employer_id)->where('date', $employee_date);
            $attendance->update([
                'date' => $employee_date,
                'employer_id'   => $employer_id,
                'start_time'     => $employee_attendance_time,
                'end_time'  => $employee_end_time,
                'status'  => $status,
                'slug'  => $slug,

            ]);
        }
        else {
            Attendance::create([
                'date' => $employee_date,
                'employer_id'   => $employer_id,
                'start_time'     => $employee_attendance_time,
                'end_time'  => $employee_end_time,
                'status'  => $status,
                'slug'  => $slug,
            ]);
        }
  

        $salary_reports34 =  \App\Models\Attendance::selectRaw('employer_id , count(*) as attendance')
        ->whereBetween('date', ["2022-08-01", "2022-09-31"])
        ->where('status' , '=' , 'attendance')
        ->groupBy('employer_id')->where('employer_id',$employer_id)
        ->first();


        // $check_departure = Attendance::where('employer_id', $employer_id)->where('date', $employee_date)->first();



 


        // $status_count=\App\Models\Attendance::


        $salary_reports43 =  \App\Models\Attendance::selectRaw('employer_id , count(*) as upsent')
        ->whereBetween('date', ["2022-08-01", "2022-09-31"])
        ->where('status' , '=' , 'upsent')
        ->groupBy('employer_id')->where('employer_id',$employer_id)
        ->first();
     
        // $report = Salary_report::where('employer_id', $employer_id)->where('date', $employee_date)->exists();

        // $total_attendance_days = \App\Models\Attendance::where('employer_id', $employer_id)->where('status', 'upsent')->count();

        if($salary_reports43 && $salary_reports34 !== null){
   
  
        $employer_salary=Salary_report::where('employer_id',$employer_id)
                                        ->update([
                                            'attendance_id'=>$request->id,
                                            'attendance' => $salary_reports34->attendance,
                                            // 'date'=>$report,
                                            
                                            'upsent' => $salary_reports43->upsent
                                        ]);
                            }else{
                                
                                $employer_salary=Salary_report::where('employer_id',$employer_id)
                                ->update([
                                    'attendance_id'=>$request->id,
                                    'attendance' => 0,
                                    
                                    'upsent' => 0,
                                ]);
                            }
        //     return redirect()->route('Attendance.index')->with('success','Successfuly created Attendance');
        // }finally{
        //     return back()->with('error','something went wrong!');
        // }
        
       
            return back()->with('success','Successfuly created Attendance');
      
    }


   
 
    public function edit($id)
    {
        $sections  = section ::all();

        $attendances = Attendance::find($id);
        if($attendances){
            return view('backend.Attendance.edit',compact('attendances','sections'));
        }else{
            return back()->with('error','Data not found !');
        }   
    }


    public function update(Request $request, $id)
    {
  

        $data=$request->all();
        $slug = Str::slug($request->input('employer_id'));
        $slug_count = Attendance::where('slug',$slug)->count();
        if($slug_count>0){
            $slug = time(). '-' .$slug;
        }
        $data['slug']=$slug;

                 ///////////////
        // get All variables

        $employer_id = $request->employer_id;
        $employee_date = $request->today;    /// check the today
        $status = $request->status;
        $employee_attendance_time = $request->start_time;
        $employee_end_time = $request->end_time;


        $attendances = Attendance::find($id);
      


     
       
        $attendances->update([

        'date' => $employee_date,
        'employer_id'   => $employer_id,
        'start_time'     => $employee_attendance_time,
        'end_time'  => $employee_end_time,
        'status'  => $status,
        'slug'  => $slug,
        ]);






        if($attendances){
            return redirect()->route('Attendance.index')->with('success','successfully updated attendance');

        }else{
            return back()->with('error','something went wrong!');
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


    public function getproducts($id)
    {
        // dd( $id);

        $employers = DB::table('employeers')->where('section_id',$id)->pluck('id','first_name');//section_id = id =>that is come from rote when you pres on it and pluck product_name with id 
        return json_encode($employers);
        // return $request->all();
    }









    public function search(Request $request)
    {
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
public function Search_attendances(Request $request)
{
   
            $sections  = section ::all();
            $employers = Employeer::all();

 // في حالة عدم تحديد تاريخ
        if ( $request->start_at  && $request->end_at) {
            $start_at = date($request->start_at);
            $end_at = date($request->end_at);

              
          $attendances = Attendance::whereBetween('date',[$start_at,$end_at])->get();
          return view('backend.Attendance.index',compact('attendances','start_at','end_at','sections','employers'))->withDetails($attendances);
          
        }
        
        // في حالة تحديد تاريخ استحقاق
        else {
           

            $attendances  = Attendance ::all();
        
        }  
     
    
}



}

