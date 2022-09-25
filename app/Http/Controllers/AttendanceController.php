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
            'attendance_time' => 'required',
            'depature_time' => 'nullable|after:attendance_time',
            'date' => 'date|required|after_or_equal:date',
          
            'value_status' => 'required',

            'employer_id'=>'required|exists:employeers,id',
            

        ]);
 
// return($request->all());
   
        // get All variables

        $employer_id = $request->employer_id;
        $employee_date = $request->date;    /// check the today
        $employee_attendance_time = $request->attendance_time;
        $employee_depature_time = $request->depature_time;
        
       //////////////////////////////////////////
       /////////////////////////////////////////
       
        // get system discount && hours price && calc diff hours_employee

        $total_hour_price = Employeer::where('id', $employer_id)->pluck('hour_price')->first();
        

        $start_time = Carbon::parse(Employeer::where('id', $employer_id)->pluck('start_time')->first()); //get start time that you  give to employer
        $end_time = Carbon::parse(Employeer::where('id', $employer_id)->pluck('end_time')->first());//get end time that you  give to employer

        $diff_hours = $end_time->diffInHours($start_time);  // get the mins between them == total hours should be stay

        /////////////////////////////////////////
        ////////////////////////////////////////
          // if day equel day if it exist
        $absent_date_exists = Attendance::where('absent_date', $employee_date)->where('employer_id', $employer_id)->exists();


              // check the employee absence or No

//    if($request->has('value_status','=','2'))
if($request->value_status === '2')
   {
                // calculate that enployer absent in one day  by money

                  $Absent_day_discount = $total_hour_price * $diff_hours;   // value if employer upsent get total of hours and hour price 

                // when Absent the employee

                    if($absent_date_exists){
                        $attendance = Attendance::where('employer_id', $employer_id)->where('absent_date', $employee_date);
                        $attendance->update([
                            'value_status'    => 2,
                            'status'    => 'upsent',
                            'absent_date' => $employee_date,

                            'attendance_time'  => $start_time,
                            'depature_time' => $end_time,


                            'employer_id'   => $employer_id,
                            'discount_total'  => $Absent_day_discount, //that he upsent in day
                        ]);
                    }
                    else {
                        Attendance::create([
                            'value_status'    => 2,
                            'status'    => 'upsent',
                            'absent_date' => $employee_date,
                            'employer_id'   => $employer_id,

                            'attendance_time'  => $start_time,
                            'depature_time' => $end_time,


                            'discount_total'  => $Absent_day_discount, //that he upsent in day
                        ]);
                    }

               // calculate total upsent days and equel to report
                    $total_absent_days = Attendance::where('employer_id', $employer_id)->where('value_status', 2)->count();

                    // return $total_absent_days;



                       // after this write report 
            
                        $discount_total = Attendance::where('employer_id', $employer_id)->where('absent_date', $employee_date)->pluck('discount_total')->last();
                         
                        $discount_all_total_of_days = $discount_total * $total_absent_days;
                        // return $discount_all_total_of_days;

                        // write report
                        $report = Salary_report::where('employer_id', $employer_id)->exists(); // if he exist
                        if($report){
                            $update_report = Salary_report::where('employer_id', $employer_id);
                            $update_report->update([
                                'report_date'           => $employee_date,
                                'hour_price'            => $total_hour_price,
                                'discount_total'        => $Absent_day_discount,
                                'total_absent_days'     =>$total_absent_days,
                                'total'                 => $discount_all_total_of_days,  // you might write absent day discount
                                'employer_id'           => $employer_id,
                            ]);
                        }
                        else {
                            Salary_report::create([
                                'report_date'           => $employee_date,
                                'hour_price'            => $total_hour_price,
                                'discount_total'        => $Absent_day_discount, // if he upsent get price of day upsent
                                'total_absent_days'     =>$total_absent_days,
                                'total'                 => $discount_all_total_of_days,
                                'employer_id'           => $employer_id,
                            ]);
                        }



        
    }else
    {
        // is he attendance
        $attendance_exists = Attendance::where('date', $employee_date)->where('employer_id', $employer_id)->exists(); // if he exist 
      
        // calc attendance_time && departure_time
        $attendance_time = Carbon::parse($employee_attendance_time);
        $depature_time = Carbon::parse($employee_depature_time);
        // $end_time = Carbon::parse($end_time);


        // $diff_time = $departure_time->diffInHours($attendance_time);  // 4pm - 9 am = 8
        $diff_time= $depature_time->diffInHours($attendance_time);  // the differance in time bettwen attendance and depature == that he stay

        $total_day = $diff_time * $total_hour_price;  // shuch stay 6 hour =>6*50 = 300 that he need in day

        // $diff_over = $diff_time - $diff_hours; // diff hour refer to the differane bettwen start and end in employer
        $diff_over = $depature_time->diffInHours($end_time); // the time where employer depature or go mins the basic depature time

        $diff_hours_discount = $start_time->diffInHours( $attendance_time) ;

        // write attendance if he attendance
        if($attendance_exists){
            $attendance = Attendance::where('employer_id', $employer_id)->where('date', $employee_date);
            $attendance->update([
                'date'         => $employee_date,
                'attendance_time'  => $employee_attendance_time,
                'depature_time' => $employee_depature_time,
                'value_status'    => 1,
                'status'=>'attendance',
                'absent_date' => $employee_date,
                'employer_id'   => $employer_id,
                'total_hours_amount' => $diff_time,
                // 'total_price_amount' => $total_day,
                'diff_hours_discount' =>$diff_hours_discount,

                'diff_hours_over'     => $diff_over,
            ]);

        
        } else {
            Attendance::create([
                'date'         => $employee_date,
                'attendance_time'  => $employee_attendance_time,
                'depature_time' => $employee_depature_time,
                'value_status'    => 1,
                'status'=>'attendance',
                'employer_id'   => $employer_id,
                'total_hours_amount' => $diff_time,
                // 'total_price_amount' => $total_day,
                'diff_hours_over'     => $diff_over,
                'diff_hours_discount' =>$diff_hours_discount,

                'absent_date' => $employee_date,

            ]);
        }  

        //////////////////////
        // then write report but before write get total 
        // write discount days report/
        $month = date('m');
        $year = date('Y');

      
       
//////////////////////
        $total_hours_amount  = Attendance::where('employer_id', $employer_id)->whereYear('date', $year)
        ->whereMonth('date', $month)
        ->sum('total_hours_amount');  ///all times that he stay + over time
        //total hours in month 

        //  $total_hours_amount = Attendance::where('employer_id', $employer_id)->pluck('total_hours_amount')->last();
      

        $diff_hours_amount_over  = Attendance::where('employer_id', $employer_id)->whereYear('date', $year)
        ->whereMonth('date', $month)
        ->sum('diff_hours_over');

        $diff_hours_amount_discount  = Attendance::where('employer_id', $employer_id)->whereYear('date', $year)
        ->whereMonth('date', $month)
        ->sum('diff_hours_discount');
          // total over or discount hours in month
        // $diff_hours_amount = Attendance::where('employer_id', $employer_id)->where('date', $employee_date)->pluck('diff_hours_over')->last();
       
        $discount_total  = Attendance::where('employer_id', $employer_id)->whereYear('date', $year)
        ->whereMonth('date', $month)
        ->sum('discount_total');
        // discount upsent days in months
        // $discount_total = Attendance::where('employer_id', $employer_id)->where('date', $employee_date)->pluck('discount_total')->last();


        // return $diff_hours_over;
       
                        // 6 * 50 + 2 or -2 * 50 == 400 or 200 
            $total_attendance = ($total_hours_amount * $total_hour_price);
             
            //check if the hr write depature time or not
            $check_departure = Attendance::where('employer_id', $employer_id)->where('date', $employee_date)->first();

            if($check_departure->depature_time !=null){

                // calculate attendance days
                $total_attendance_days = Attendance::where('employer_id', $employer_id)->where('value_status', 1)->count();





                $report = Salary_report::where('employer_id', $employer_id)->exists();
                if($report){
                    $update_report = Salary_report::where('employer_id', $employer_id);
                    $update_report->update([
                        'report_date'           => $employee_date,
                        'hour_price'            => $total_hour_price,
                        'total_hours_amount'           => $total_hours_amount,  //that he stay
                        'total_hours_overtime'  => $diff_hours_amount_over,
                        'total_hours_discount' =>$diff_hours_amount_discount,
                        'discount_total'        => $discount_total,
                        'total'                 => $total_attendance,
                        'total_attendace_days'  =>$total_attendance_days,
                        'employer_id'           => $employer_id,
                    ]);
                }
                else {
                    Salary_report::create([
                        'report_date'           => $employee_date,
                        'hour_price'            => $total_hour_price,
                        'total_hours_amount'           => $total_hours_amount,  //that he stay
                        'total_hours_overtime'  => $diff_hours_amount_over,
                        'total_hours_discount' =>$diff_hours_amount_discount,

                        'discount_total'        => $discount_total,
                        'total'                 => $total_attendance,
                        'total_attendace_days'  =>$total_attendance_days,

                        'employer_id'           => $employer_id,
                    ]);
                }

                

            }

    }



// return $request->all();





  



 
        
       
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
        $this->validate($request, [
            'attendance_time' => 'required',
            'depature_time' => 'nullable|after:attendance_time',
            'date' => 'date|required|after_or_equal:date',
          
            'value_status' => 'required',

            'employer_id'=>'required|exists:employeers,id',
            

        ]);

        $attendances = Attendance::find($id);

               // get All variables

               $employer_id = $request->employer_id;
               $employee_date = $request->date;    /// check the today
               $employee_attendance_time = $request->attendance_time;
               $employee_depature_time = $request->depature_time;


        // get system discount && hours price && calc diff hours_employee

        $total_hour_price = Employeer::where('id', $employer_id)->pluck('hour_price')->first();
        $start_time = Carbon::parse(Employeer::where('id', $employer_id)->pluck('start_time')->first()); //get start time that you  give to employer
        $end_time = Carbon::parse(Employeer::where('id', $employer_id)->pluck('end_time')->first());//get end time that you  give to employer

        $diff_hours = $end_time->diffInHours($start_time);  // get the mins between them == total hours should be stay



               

       
         $absent_date_exists = Attendance::where('absent_date', $employee_date)->where('employer_id', $employer_id);
         if($request->value_status === '2'){
            $Absent_day_discount = $total_hour_price * $diff_hours;   // value if employer upsent get total of hours and hour price 

            $attendances->update([

                'value_status'    => 2,
                'status'    => 'upsent',
                'absent_date' => $employee_date,

                'attendance_time'  => $start_time,
                'depature_time' => $end_time,


                'employer_id'   => $employer_id,
                'discount_total'  => $Absent_day_discount, //that he upsent in day
                ]);


                 // calculate total upsent days and equel to report
                 $total_absent_days = Attendance::where('employer_id', $employer_id)->where('value_status', 2)->count();
                 // return $total_absent_days;
                    // after this write report 
         
                     $discount_total = Attendance::where('employer_id', $employer_id)->where('absent_date', $employee_date)->pluck('discount_total')->last();
                      
                     $discount_all_total_of_days = $discount_total * $total_absent_days;
                     // return $discount_all_total_of_days;

                     // write report
                     $report = Salary_report::where('employer_id', $employer_id); // if he exist
                     if($report){
                         $update_report = Salary_report::where('employer_id', $employer_id);
                         $update_report->update([
                             'report_date'           => $employee_date,
                             'hour_price'            => $total_hour_price,
                             'discount_total'        => $Absent_day_discount,
                             'total_absent_days'     =>$total_absent_days,
                             'total'                 => $discount_all_total_of_days,  // you might write absent day discount
                             'employer_id'           => $employer_id,
                         ]);
                     }
                

    } else
{
    // is he attendance
    $attendance_exists = Attendance::where('date', $employee_date)->where('employer_id', $employer_id)->exists(); // if he exist 
  
    // calc attendance_time && departure_time
    $attendance_time = Carbon::parse($employee_attendance_time);
    $depature_time = Carbon::parse($employee_depature_time);

    // $diff_time = $departure_time->diffInHours($attendance_time);  // 4pm - 9 am = 8
    $diff_time= $depature_time->diffInHours($attendance_time);  // the differance in time bettwen attendance and depature == that he stay

    $total_day = $diff_time * $total_hour_price;  // shuch stay 6 hour =>6*50 = 300 that he need in day

    // $diff_over = $diff_time - $diff_hours; // diff hour refer to the differane bettwen start and end in employer
    $diff_over = $depature_time->diffInHours($end_time); // the time where employer depature or go mins the basic depature time

    $diff_hours_discount = $start_time->diffInHours( $attendance_time) ;


    // write attendance if he attendance
    if($attendance_exists){
        $attendance = Attendance::where('employer_id', $employer_id)->where('date', $employee_date);
        $attendance->update([
            'date'         => $employee_date,
            'attendance_time'  => $employee_attendance_time,
            'depature_time' => $employee_depature_time,
            'value_status'    => 1,
            'status'=>'attendance',
            'absent_date' => $employee_date,
            'employer_id'   => $employer_id,
            'total_hours_amount' => $diff_time,
            // 'total_price_amount' => $total_day,
            'diff_hours_over'     => $diff_over,
            'diff_hours_discount' =>$diff_hours_discount,
        ]);

    
    } 




    ////////////////////////////////////////////////////////////
   
        // write discount days report/
        $month = date('m');
        $year = date('Y');

      
       
//////////////////////
        $total_hours_amount  = Attendance::where('employer_id', $employer_id)->whereYear('date', $year)
        ->whereMonth('date', $month)
        ->sum('total_hours_amount');
        //total hours in month 

        //  $total_hours_amount = Attendance::where('employer_id', $employer_id)->pluck('total_hours_amount')->last();
      

        $diff_hours_amount_over  = Attendance::where('employer_id', $employer_id)->whereYear('date', $year)
        ->whereMonth('date', $month)
        ->sum('diff_hours_over');

        $diff_hours_amount_discount  = Attendance::where('employer_id', $employer_id)->whereYear('date', $year)
        ->whereMonth('date', $month)
        ->sum('diff_hours_discount');
          // total over or discount hours in month
        // $diff_hours_amount = Attendance::where('employer_id', $employer_id)->where('date', $employee_date)->pluck('diff_hours_over')->last();
       
        $discount_total  = Attendance::where('employer_id', $employer_id)->whereYear('date', $year)
        ->whereMonth('date', $month)
        ->sum('discount_total');
        // discount upsent days in months
        // $discount_total = Attendance::where('employer_id', $employer_id)->where('date', $employee_date)->pluck('discount_total')->last();


        // return $diff_hours_over;
       
                        // 6 * 50 + 2 or -2 * 50 == 400 or 200 
            $total_attendance = ($total_hours_amount * $total_hour_price);
             
            //check if the hr write depature time or not
            $check_departure = Attendance::where('employer_id', $employer_id)->where('date', $employee_date)->first();

            if($check_departure->depature_time !=null){

                // calculate attendance days
                $total_attendance_days = Attendance::where('employer_id', $employer_id)->where('value_status', 1)->count();

                $report = Salary_report::where('employer_id', $employer_id);
                if($report){
                    $update_report = Salary_report::where('employer_id', $employer_id);
                    $update_report->update([
                        'report_date'           => $employee_date,
                        'hour_price'            => $total_hour_price,
                        'total_hours_amount'           => $total_hours_amount,  //that he stay
                        
                        'total_hours_overtime'  => $diff_hours_amount_over,

                        'total_hours_discount' =>$diff_hours_amount_discount,

                        'discount_total'        => $discount_total,
                        'total'                 => $total_attendance,
                        'total_attendace_days'  =>$total_attendance_days,
                        'employer_id'           => $employer_id,
                    ]);
                }
              

                

            }


}

    return redirect()->route('Attendance.index')->with('success','successfully updated attendance');

        
      


    }




























        // $data=$request->all();
  

        //          ///////////////
        // // get All variables

        // $employer_id = $request->employer_id;
        // $employee_date = $request->today;    /// check the today
        // $status = $request->status;
        // $employee_attendance_time = $request->start_time;
        // $employee_end_time = $request->end_time;


        // $attendances = Attendance::find($id);
      


     
       
        // $attendances->update([

        // 'date'         => $employee_date,
        // 'attendance_time'  => $employee_attendance_time,
        // 'depature_time' => $employee_depature_time,
        // 'value_status'    => 1,
        // 'status'=>'attendance',
        // 'absent_date' => $employee_date,
        // 'employer_id'   => $employer_id,
        // 'total_hours_amount' => $diff_time,
        // // 'total_price_amount' => $total_day,
        // 'diff_hours_over'     => $diff_over_or_mins,
        // ]);






        // if($attendances){
        //     return redirect()->route('Attendance.index')->with('success','successfully updated attendance');

        // }else{
        //     return back()->with('error','something went wrong!');
        // }



    

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

