<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Salary_report;
use Illuminate\Database\Eloquent\SoftDeletes;

class ArcheveController extends Controller
{
  

    public function index()
    {
        $salary_reports=Salary_report::onlyTrashed()->get();  // there we write onlytrached to get invoices that has softdelets value ==المارشفه
  
        return view('backend.salary_reports.archive_report' , compact('salary_reports'));  
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
    public function update(Request $request)
    {
        $id = $request->report_id;
    $flight = Salary_report::withTrashed()->where('id',$id)->restore();
    // dd($flight);
    return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $id=$request->report_id;
        $salary_reports = Salary_report::withTrashed($request->report_id);

        // $invoices = invoices::withTrashed()->where('id',$id)->first();

        $salary_reports->forceDelete();
        return back()->with('success','archives has been deleted to for ever');
    }
}
