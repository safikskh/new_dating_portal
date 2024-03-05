<?php

namespace App\Http\Controllers\API;

use App\User;
use App\Enums\Sex;
use Carbon\Carbon;
use App\Enums\Height;
use App\Enums\Weight;
use App\Enums\Smoking;
use App\Enums\Tattoos;
use App\Enums\BodyType;
use App\Enums\Children;
use App\Enums\EyeColor;
use App\Enums\Piercing;
use App\Enums\HairColor;
use App\Enums\Searching;
use App\Enums\CivilStatus;
use App\Enums\IAmSeekingA;
use Illuminate\Http\Request;
use App\Enums\SexualOrientation;
use App\Http\Requests\UserRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    // public function __construct()
    // {
    //     $this->middleware('auth')->except('signup','store');
    // }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return User::all();
    }
    public function signup()
    {
        $bodyType = BodyType::getValues();
        $children = Children::getValues();
        $civilStatus = CivilStatus::getValues();
        $eyeColor = EyeColor::getValues();
        $hairColor = HairColor::getValues();
        $iAmSeekingA = IAmSeekingA::getValues();
        $piercing = Piercing::getValues();
        $searching = Searching::getValues();
        $sex = Sex::getValues();
        $sexualOrientation = SexualOrientation::getValues();
        $smoking = Smoking::getValues();
        $tattoos = Tattoos::getValues();
        $weight = Weight::getValues();
        $height = Height::getValues();
        return compact('bodyType','children','civilStatus','eyeColor',
    'hairColor','iAmSeekingA','piercing','searching','sex','sexualOrientation',
'smoking','tattoos','weight','height');
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
        
         $this->validate($request, [
             'username' => 'required',
        'firstName' => 'required',       
        'lastName' => 'required',       
        'email' => 'required|email',       
        'password' => 'required|min:6',       
        'dob' => 'required|date',       
        'iAmSeekingA' => 'required',
        'sexualOrientation' => 'required',
        'sex' => 'required',     
        'zipCode' => 'required',      
        'civilStatus' => 'required',       
        'height' => 'required',       
        'weight' => 'required',       
        'hairColor' => 'required',       
        'eyeColor' => 'required',       
        'searching' => 'required',       
        'bodyType' => 'required',       
        'tattoos' => 'required',       
        'piercing' => 'required',       
        'children' => 'required',       
        'smoking' => 'required',       
        'matchWords' => 'required',       
        'membership_id' => 'required',
         ]);
        //  dd($request->all());
         // $request['dob'] = Carbon::parse($request['dob'])->format('d-m-Y');
         $request['password'] = bcrypt($request['password']);
         //  return $request;
         if(User::create($request->all())){
            // return $request;
            return response([
                'data' => 'User Store Successfully'
            ],201);
        }
        return response([
                'data' => 'Error'
            ],404);
        
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
}
