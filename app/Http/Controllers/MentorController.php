<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mentor;
use App\Models\User;
use Hash;
use App\Mail\Mail;

class MentorController extends Controller
{
    public function index()
    {
        $mentors = Mentor::all();
        return view('backend.mentor.index',compact('mentors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('backend.mentor.manage');   
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email',
            'password'=>'required'
        ]);
        $data['password'] = Hash::make($request->password);
        $data['role'] = 'mentor';
        $user = User::create($data);

        $mentor = Mentor::create([
            'user_id'=>$user->id
        ]);

        $details = [
            'email' => $request->post('email'),
            'name' => $request->name,
            'role' => 'Mentor',
            'password' => $request->password,
            'type'=>'login'
        ];
        $subject="Mentor Account Created ";        
        //  \Mail::to($request->email)->send(new Mail($details,$subject));
        if($mentor){            
            return response()->json(['msg'=> 'Data Added Successfuly']);
        }
        return response()->json(['msg'=> 'Error']);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Mentor  $mentor
     * @return \Illuminate\Http\Response
     */
    public function edit(Mentor $mentor)
    {
        $url = route('mentor.update',$mentor->id);
        $mentor = User::find($mentor->user_id);
        return view('backend.mentor.manage',compact('mentor','url'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Mentor  $mentor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Mentor $mentor)
    {
        $user = User::find($mentor->user_id);
        $data = $request->validate([
            'name' => 'required',        
            'email' =>  'required|unique:users,email,'.$user->id, 
        ]);
        $qry = $user->update($data);

        if($qry){
            return response()->json(['msg'=> 'Data Updated Successfully']);
        }
        return response()->json(['msg'=> 'Error']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Mentor  $mentor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Mentor $mentor)
    {
        $qry = $mentor->delete();
        $user = User::find($mentor->user_id)->delete();
        if($qry){
            $msg = 'success';
            $request->session()->flash('message-success',$msg);
            return redirect()->route('mentor.index');
        }
        $msg = 'error';
        $request->session()->flash('message-error',$msg);
        return redirect()->route('mentor.index');
    }

    public function status(Request $request)
    {
        $mentor = Mentor::query()->find($request->id);
        
        $mentor->status= $request->sts;
        $update = $mentor->save();
        if($update){
            return response()->json(["success" => true,"message" => "Status Changed Successfully."]);
        }else{
            return response()->json(["success" => false,"message" => "Failed"]);
        }
    }


}
