<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Support\Str;
use Illuminate\Http\Request;

use App\Models\Backend\PromoCode;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;
use Brian2694\Toastr\Facades\Toastr;

class PromoCodeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    
    // public function index()
    // {
    //     $promoCodeList = Promocode::latest()->get();
    //     return view('cbs.backend.promocode2',compact('promoCodeList'));
    // }

    public function index(Request $request)
    {

        if(request()->ajax())

        {
            $data = Promocode::latest()->get();
            return datatables()->of($data)

            ->editColumn('discount', function ($data) {

                if($data->isFixed =="1")
                    {
                        $discount = $data->discount.' $';
                    }
                else 
                    {
                        $discount = $data->discount.' %';
                    }

                return $discount;  
            })
            ->escapeColumns([])

            ->addColumn('type', function($data){

                if($data->isFixed =="1")
                    {
                        $type = '<span class="badge badge-primary">Fixed</span>';
                    }
                else 
                    {
                        $type = '<span class="badge badge-info">Percentage</span>';
                    }

                return $type;
            })
            ->make(true);
        }

        return view('cbs.backend.promocode');
    }

    public function exportCSV(){
        
        if(Promocode::all()->count() > 0){
        $headers = [
            'Cache-Control'       => 'must-revalidate, post-check=0, pre-check=0'
        ,   'Content-type'        => 'text/csv'
        ,   'Content-Disposition' => 'attachment; filename=promoCodes.csv'
        ,   'Expires'             => '0'
        ,   'Pragma'              => 'public'
        ];
        $list = Promocode::all()->toArray();
        array_unshift($list, array_keys($list[0]));
        $callback = function() use ($list) 
        {
            $FH = fopen('php://output', 'w');
            foreach ($list as $row) { 
                fputcsv($FH, $row);
            }
            fclose($FH);
        };
         return Response::stream($callback, 200, $headers);
        }else{
            return redirect()->back()->with('error','No data found to export');
        }
    }

    public function exportXL(){

        if(Promocode::all()->count() > 0){
        $headers = [
            'Cache-Control'       => 'must-revalidate, post-check=0, pre-check=0'
        ,   'Content-type'        => 'text/xl'
        ,   'Content-Disposition' => 'attachment; filename=promoCodes.xls'
        ,   'Expires'             => '0'
        ,   'Pragma'              => 'public'
        ];
        
        $list = Promocode::all()->toArray();
        array_unshift($list, array_keys($list[0]));
        $callback = function() use ($list) 
        {
            $FH = fopen('php://output', 'w');
            foreach ($list as $row) { 
                fputcsv($FH, $row);
            }
            fclose($FH);
        };
        return Response::stream($callback, 200, $headers);
        }else{
            return redirect()->back()->with('error','No data found to export');
        }
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'quantity' => 'required',
            'type' => 'required',
            'discount' => 'required',
            'edate' => 'required',
            ]);
            // return $request->all();
       for ($i=0; $i < $request->quantity; $i++) { 
            $seed = str_split('abcdefghijklmnopqrstuvwxyz'
                     .'ABCDEFGHIJKLMNOPQRSTUVWXYZ'
                     .'0123456789'); // and any other characters
            shuffle($seed); // probably optional since array_is randomized; this may be redundant
            $rand = '';
            foreach (array_rand($seed, 6) as $k) $rand .= $seed[$k];

            $promoCode = new PromoCode();
            // $promoCode->promoCode = Str::random(6)->unique();
            $promoCode->promoCode = $rand;
            $promoCode->isFixed = $request->type;
            $promoCode->discount = $request->discount;
            $promoCode->edate = $request->edate;
            $promoCode->save();
        }

        Toastr::success('Promocode created successfully', 'Success');
        return redirect()->back();
    }

    public function customCode(Request $request)
    {
       $this->validate($request, [
            'pcode' => 'required',
            'type' => 'required',
            'discount' => 'required',
            'edate' => 'required',
            ]);
            $promoCode = new PromoCode();
            $promoCode->promoCode = $request->pcode;
            $promoCode->isFixed = $request->type;
            $promoCode->discount = $request->discount;
            $promoCode->edate = $request->edate;
            $promoCode->save();
            
        Toastr::success('Promocode created successfully', 'Success');
        return redirect()->back();
    }

    public function uploadFile(Request $request){

        if ($request->file('file')){

        $file = $request->file('file');

        // File Details 
        $filename = $file->getClientOriginalName();
        $extension = $file->getClientOriginalExtension();
        $tempPath = $file->getRealPath();
        $fileSize = $file->getSize();
        $mimeType = $file->getMimeType();

        // Valid File Extensions
        $valid_extension = array("csv");

        // 2MB in Bytes
        $maxFileSize = 2097152; 

        // Check file extension
        if(in_array(strtolower($extension),$valid_extension)){

            // Check file size
            if($fileSize <= $maxFileSize){

            // File upload location
            $location = 'uploads/csvPromocodes';

            // Upload file
            $file->move($location,$filename);

            // Import CSV to Database
            $filepath = public_path($location."/".$filename);

            // Reading file
            $file = fopen($filepath,"r");

            $importData_arr = array();
            $i = 0;

            while (($filedata = fgetcsv($file, 1000, ",")) !== FALSE) {
                $num = count($filedata );
                
                // Skip first row (Remove below comment if you want to skip the first row)
                /*if($i == 0){
                    $i++;
                    continue; 
                }*/
                for ($c=0; $c < $num; $c++) {
                    $importData_arr[$i][] = $filedata [$c];
                }
                $i++;
            }
            fclose($file);

            // Insert to MySQL database
            $stripeApiKey = env("STRIPE_SECRET");
            foreach($importData_arr as $key => $importData){
                $insertData = array(
                "promoCode"=>$importData[1],
                "isFixed"=>$importData[2],
                "discount"=>$importData[3],
                "duration"=>$importData[4],
                "isOneTimeUse"=>$importData[5],
                "edate"=> $importData[6]);
                // $insertData = new PromoCode();
                // $insertData->promoCode = $importData[1];
                // $insertData->isFixed = $importData[2];
                // $insertData->discount = $importData[3];
                // $insertData->duration = $importData[4];
                // $insertData->isOneTimeUse = $importData[5];
                // $insertData->edate = $importData[6];
                PromoCode::insertData($insertData, $stripeApiKey);

            }

                Toastr::success('Promocode created successfully', 'Success');
                return redirect()->back();
            }else{
                Toastr::error('File too large. File must be less than 2MB.', 'Error');
            return redirect()->back();
            }

        }else{
            Toastr::error('Invalid File Extension.', 'Error');
            return redirect()->back();
        }

        }

        // Redirect to index
        Toastr::error('No file chosen', 'Error');
        return redirect()->back();
    }
}
