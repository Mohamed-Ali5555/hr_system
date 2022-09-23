<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Salary_report;
use App\Models\Attendance;
use App\Models\Employeer;
use App\Models\section;

use Illuminate\Database\Eloquent\SoftDeletes;

class Salary_reportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $salary_reports = Salary_report::orderBy('id','DESC')->get();

        // $salary_reports =  \App\Models\Attendance::selectRaw('employer_id , count(*) as attendance')
        // ->whereBetween('today', ["2022-08-01", "2022-08-31"])
        // ->where('status' , '=' , 'attendance')
        // ->groupBy('employer_id','id')
        // ->get()->toArray();
        // $invoices = invoices::select('*')->where('status','=',$request->invoice_checked1)->get();

        // $status = \App\Models\Attendance::select('employer_id','status as attendance')->whereBetween('today', ["2022-08-01", "2022-08-31"])
        // //  ->groupBy('employer_id','id')
        // ->get()->toArray();

        // return dd($salary_reports);


        // $salary_reports1 =  \App\Models\Attendance::selectRaw('employer_id , count(*) as attendance')
        // ->whereBetween('today', ["2022-08-01", "2022-08-31"])
        // ->where('status' , '=' , 'upsent')
        // ->groupBy('employer_id')
        // ->get()->toArray();
        // return dd($salary_reports1);

    

        // dd($salary_reports);
        
        return view('backend.salary_reports.index',compact('salary_reports'));
        // return json_encode($salary_reports);
    }

 



    public function invoices(){
        echo 'dddddddddddd';
        $salary_reports = Salary_report::findOrfail(); 
        return view ('salary_reports.invoices',compact('salary_reports'));

    }
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // echo 'dddddddddddd';

        // $salary_reports = Salary_report::findOrfail($id); 
        //     return view ('backend.salary_reports.invoices',compact('salary_reports'));
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
          $id=$request->report_id;
        $salary_reports = Salary_report::findOrfail($request->report_id);

        


        $id_page = $request->id_page;
         if(!$id_page == 2)  {  //archeve methode  you can make this in new function
  

         $salary_reports->forceDelete();
         return back()->with('success','salary_reports has been deleted from databaise');

         }else{
            // dd($id_page);
            // return $request->all();
            $salary_reports->delete();
            return back()->with('success','salary_reports has been added to archeve');
        }

  
    }

    public function Search_salary(Request $request){
        $salary_reports = Salary_report::orderBy('id','DESC')->get();

        // $salary_reports = Salary_report::all();
        // $sections = section::select('id', 'section_name')->get();

        $sections  = section ::all();
        $employers = Employeer::all();
        $today = Attendance::where('employer_id', $request->employer_id)->where('date', $request->today);

     // في حالة عدم تحديد تاريخ
            if ( $request->start_at  && $request->end_at) {
                $start_at = date($request->start_at);
                $end_at = date($request->end_at);
    
                  
              $salary_reports = Salary_report::whereBetween('created_at',[$start_at,$end_at])->get();
              return view('backend.salary_reports.index',compact('salary_reports','start_at','end_at','salary_reports','employers','sections'))->withDetails($salary_reports);
              
            }
            
            // في حالة تحديد تاريخ استحقاق
            else {
               
            echo "there is no data";
                $salary_reports  = Salary_report ::all();
            
            }
        }

    // public function Search_attendances(Request $request){
   
    
    //  // في حالة عدم تحديد تاريخ
    //         if ( $request->year  && $request->month) {
    //             $year = $this->input->post("year");
    //             $year = $year != "" ? $year : date("Y");
    //             $month = $this->input->post("month");
    //             $month = $month != "" ? $month : date("m");

    //             return $request->all();
    

    //             $attendances = Employeer::whereYear('created_at', '=', $year)
    //           ->whereMonth('created_at', '=', $month)
    //           ->get();
                  
    //         //   $attendances = Employeer::where('created_at',[$year,$month])->get();
    //           return view('backend.salary_report.index',compact('attendances','year','month'))->withDetails($attendances);
              
    //         }
            
    //         // في حالة تحديد تاريخ استحقاق
    //         else {
               
    //     //   echo "thee is error";
    //             $salary_reports  = Salary_report ::get();
            
    //         }
    //     }


    // print invoices 
public function print_invoices($id){
    $salary_reports = Salary_report::where('id',$id)->first();
    // return $salary_reports;
        return view('backend.salary_reports.print_invoices',compact('salary_reports'));

}
}
