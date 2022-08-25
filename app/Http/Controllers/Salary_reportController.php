<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Salary_report;
use App\Models\Attendance;
use App\Models\Employeer;

class Salary_reportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $salary_reports = Salary_report::all();

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
        
        return view('backend.salary_reports.index',compact('salary_reports'));
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

        $salary_reports = Salary_report::findOrfail($id); 
            return view ('backend.salary_reports.invoices',compact('salary_reports'));
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
    public function destroy($id)
    {
        //
    }

    public function Search_salary(Request $request){
   
        $salary_reports = Salary_report::all();

     // في حالة عدم تحديد تاريخ
            if ( $request->start_at  && $request->end_at) {
                $start_at = date($request->start_at);
                $end_at = date($request->end_at);
    
                  
              $salary_reports = Salary_report::whereBetween('created_at',[$start_at,$end_at])->get();
              return view('backend.salary_reports.index',compact('salary_reports','start_at','end_at','salary_reports'))->withDetails($salary_reports);
              
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
}
