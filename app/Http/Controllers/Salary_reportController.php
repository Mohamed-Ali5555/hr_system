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
        // {{-- $status=\App\Models\Employeer::join('attendances','attendances.employer_id','=','employeers.id')->where('attendances.status','upsent')->get(); --}}

        // $salary_reports = Salary_report::join('employees', 'employees.id', '=', 'reports.employee_id')->groupBy('total_Absent_days')->get(['reports.*', 'employees.*']);
        // $salary_reports=Salary_report::innerjoin('employeers','employeers.id', '=' , 'salary_reports.employer_id')->groupBy('employer_id')->get(['salary_reports.*', 'employeers.*']);
        $salary_reports = Salary_report::orderBy('id','DESC')->get();


        return view('backend.salary_reports.index',compact('salary_reports'));
    }


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
    
                  
              $salary_reports = Salary_report::whereBetween('report_date',[$start_at,$end_at])->get();
              return view('backend.salary_reports.index',compact('salary_reports','start_at','end_at','salary_reports','employers','sections'))->withDetails($salary_reports);
              
            }
            
            // في حالة تحديد تاريخ استحقاق
            else {
               
            echo "there is no data";
                $salary_reports  = Salary_report ::all();
            
            }
        }


    // print invoices 
public function print_invoices($id){
    $salary_reports = Salary_report::where('id',$id)->first();
    // return $salary_reports;
        return view('backend.salary_reports.print_invoices',compact('salary_reports'));

}
}
