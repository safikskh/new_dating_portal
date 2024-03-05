<?php


namespace App\Http\Controllers;


use App\Admin;
use App\Http\Controllers\Controller;
use App\User;
use DB;
use Hash;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    
    public function index(Request $request)
    {
        // $date = date('Y-m-d H:i:s');
        // $year = date('Y', strtotime($date));
        // $month = date('F', strtotime($date));
        // dd($month);
        $data = Admin::orderBy('id','ASC')->paginate(5);
        $statuses = $this->reportedStatusesList();

        return view('cbs.backend.users',compact('data', 'statuses'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password'
        ]);


        $input = $request->all();
        $input['password'] = Hash::make($input['password']);


        $user = Admin::create($input);


        return redirect()->route('users.index')
                        ->with('success','User created successfully');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function userShowModal($id)
    {
        if(request()->ajax())
        {

        $user = Admin::find($id);

        $data = '<h5><b>Name :</b> ' .$user->name.'</h5>';
        $data .= '<h5>Email : ' .$user->email.'</h5>';


         return response()->json([
                'data' => $data,
                ]);
        }
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     
    public function userEditModal($id)
    {

        if(request()->ajax())
        {

        $user = Admin::find($id);


        $name = '<input type="text" class="form-control" name="name" value="'.$user->name.'" required>';
        $id = '<input type="hidden" class="form-control" name="id" value="'.$user->id.'">';
        $email = '<input type="text" class="form-control" name="email" value="'.$user->email.'" required>'; 

        return response()->json([
                'name' => $name,
                'email' => $email,
                'id' => $id,
                ]);
        }
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
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$request->id,
            'password' => 'same:confirm-password'
        ]);


        $input = $request->all();
        if(!empty($input['password'])){ 
            $input['password'] = Hash::make($input['password']);
        }else{
            $input = array_except($input,array('password'));    
        }


        $user = Admin::find($request->id);
        $user->update($input);

        Toastr::success('User Information successfully updated', 'Success');
        return redirect()->back();
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deactive($id)
    {
        if ($id =="1")
            {
                Toastr::error('Superadmin cant deactive !', 'Error');
            }
        else
            {
                $user = Admin::find($id);
                $user->status = "0";
                $user->save();
                Toastr::success('User deactived successfully', 'Success');
            }

        return redirect()->back();
    }

    public function destroy($id)
    {
        Admin::find($id)->delete();
        return redirect()->route('users.index')
                        ->with('success','User deleted successfully');
    }
}
