<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Backend\Region;
use App\Models\PortalJoinUser;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;

class RegionController extends Controller
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
        $regions = Region::latest()->get();
        $statuses = $this->reportedStatusesList();

        return view('cbs.backend.region', compact('regions', 'statuses'))
        ->with('i', ($request->input('page', 1) - 1) * 5);
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
            'region_name' => 'required'
        ]);

        Region::create($request->all());
        Toastr::success('Region has been save successfully save', 'Success');
        return redirect()->back();
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

         if(request()->ajax())
        {

        $region = Region::find($id);


        $name = '<input type="text" class="form-control" name="name" value="'.$region->region_name.'" required>';
        $id = '<input type="hidden" class="form-control" name="id" value="'.$region->id.'">';

        return response()->json([
                'name' => $name,
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
        ]);

        $region = Region::find($request->id);
        $region->region_name = $request->name;
        $region->save();

        Toastr::success('Region Information successfully updated', 'Success');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $region_ck = PortalJoinUser::where('region_id', '=', $id)->first();

         if ($region_ck != null)
            {
                Toastr::error('Sorry ! Allready used so cant delete', 'Error');
            }
        else
            {
                Region::find($id)->delete();
                Toastr::success('Region has been deleted successfully', 'Success');
            }

        return redirect()->back();

    }
}
