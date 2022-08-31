<?php

namespace App\Http\Controllers;

use App\Models\Employeer;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Models\Salary_report;
use App\Models\User;
use Illuminate\Support\Facades\Notification;
use App\Exports\EmployersExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Auth;


class EmployeerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employers = Employeer::orderBy('id','DESC')->get();

        return view('backend.employees.index',compact('employers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.employees.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {



        // $this->validate($request, [
        //     'first_name' => 'required|unique|max:255',
            
        // ],[
        //    'first_name.required'    => 'ddddddddddd',

        // ]);




        // return $request->all();
        $this->validate($request, [

            'first_name' => 'string|required',
                    // 'slug' =>'string|required|exists:sections,slug',

            'address' => 'string|required',
            'email' => 'email|required',
            'phone' => 'required|max:30|min:11',
            'date' => 'date|required',
            'type' => 'required|in:mail,femail',
            'date_of_contact' => 'date|required',
            'start_time' => 'required|after:' . Carbon::now()->format('h:i:s'),
            'end_time' => 'required|after:start_time',
            'national_id'=>'required|max:14|min:14',
            'nationality'=>'string|required',
            'photo'=>'required',
            'salary'=>'required|numeric',
            'note'=>'string|nullable',
            'section_id'=>'required|exists:sections,id',
            'status' => 'nullable|in:pending,accept',
            

        ],[
            'phone.required'    => 'من فضلك ادخل رقم تليفون صحيح ',
            'national_id.required'    => 'مندخل رقم  صحيح ',

 
         ]);
        $data=$request->all();
        
        $slug = Str::slug($request->input('first_name'));
        $slug_count = Employeer::where('slug',$slug)->count();
        if($slug_count>0){
            $slug = time(). '-' .$slug;
        }
        $data['slug']=$slug;


        // $new = Employeer::create();

       $new= Employeer::create($data);


//جرب كده نشوف ايه بيحصل
        // $employer_id = Employeer::latest()->first()->id;  // this code give invoices id to invoices details
         $salary=  Salary_report::create([
            
             'section_id'=>$request->section_id,
             'employer_id'=>$new->id,
          //   'first_name' => $request->first_name,
             'salary' => $request->salary,
         ]);



        ///// notification 
        $user = User::get(); // to send notification to all users and admin
        $employer_id= Employeer::latest()->first();   //get last booking added
        Notification::send($user, new \App\Notifications\Add_employer($employer_id));





        if($new){
            return redirect()->route('employees.index')->with('success','Successfuly created Employeer');
        }else{
            return back()->with('error','something went wrong!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\cr  $cr
     * @return \Illuminate\Http\Response
     */
    public function show(cr $cr)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\cr  $cr
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
          $employer = Employeer::find($id);
        if($employer){
            return view('backend.employees.edit',compact('employer'));
        }else{
            return back()->with('error','Data not found !');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\cr  $cr
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
         // return $request->all();
         $employer = Employeer::find($id);
         if($employer){
 
 
            $this->validate($request, [

                'first_name' => 'string|required',
                        // 'slug' =>'string|required|exists:sections,slug',
    
                'address' => 'string|required',
                'email' => 'email|required',
                'phone' => 'required|max:30|min:11',
                'date' => 'date|required',
                'type' => 'required|in:mail,femail',
                'date_of_contact' => 'date|required',
                // 'start_time' => 'required|after:' . Carbon::now()->format('H:i:s'),
                // 'end_time' => 'required|after:start_time',
                'national_id'=>'required|numeric',
                'nationality'=>'string|required',
                'photo'=>'required',
                'salary'=>'required|numeric',
                'note'=>'string|nullable',
                'section_id'=>'required|exists:sections,id',
                'status' => 'nullable|in:pending,accept',
                
    
            ],[
                'phone.required'    => 'من فضلك ادخل رقم تليفون صحيح ',
     
             ]);
     $data = $request->all();
     $new = $employer->fill($data)->save();
     if($new){
         return redirect()->route('employees.index')->with('success','successfully updated employer');
 
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
     * @param  \App\Models\cr  $cr
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        $employer = Employeer::find($id);
        if($employer){
                  $status = $employer->delete();
                  if($status){
                   
                      return redirect()->route('employees.index')->with('success','employer successfuly deleted');
                  }else{
                      return back()->with('error','something went wrong');
                  }
        }else{
            return back()->with('error','Data not found !');
        }
    }



    ///////////////////////////////
    //////////////////////////////
    public function export() 
    {
        return Excel::download(new EmployersExport, 'employer.xlsx');
    }




    /////////////////////  laravel notification 
    ////// mark all 
    public function MarkAsRead_all (Request $request)
    {

        $userUnreadNotification= auth()->user()->unreadNotifications;

        if($userUnreadNotification) {
            $userUnreadNotification->markAsRead();
            return back()->with('success','you have show all');
        }
    }




    ////mark one
    public function markNotification (Request $request)
    {
        // $employers  = Employeer::find($request->id);

        $notification_for_user = auth()->user()->unreadNotifications()->first()->update(['read_at' => now()]);
          return back()->with('success','you have show one');
        // return redirect()->route('employees.index')->with('success','you have show one');


    }
}
