<?php

namespace App\Http\Controllers\frontEnd;

use App\User;
use App\Enums\IAmSeekingA;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class WelcomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::check()) {
        return redirect('/home');
        } else {
            // $iAmSeeking = IAmSeekingA::getValues();
            $iAmSeeking = [IAmSeekingA::getValue('Date'),IAmSeekingA::getValue('FrækDate'),IAmSeekingA::getValue('SugarDate'),];
            return view('dashlead/public_home',compact('iAmSeeking'));
            // return view('frontEnd/welcome',compact('iAmSeeking'));
        }

    }

    public function maintenance()
    {
        $data = DB::table('settings')->first();
        return view('dashlead/maintenance')->with('data', $data);

    }


    public function privacyPolicy(){
        return view('dashlead/privacyPolicy');
    }

    public function termsOfServices(){
        return view('dashlead/termsOfServices');
    }

    public function faq(){
        return view('dashlead/public_faq');
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
