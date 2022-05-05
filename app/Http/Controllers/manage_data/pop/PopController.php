<?php

namespace App\Http\Controllers\manage_data\pop;

use App\Http\Controllers\Controller;
use App\PcvlModel;
use App\PopModel;
use App\Services\ManageDataService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PopController extends Controller
{
    protected $service;

    public function __construct(ManageDataService $service)
    {
        $this->manageDataService = $service;
    }


    public function popUploadFile(Request $request)
    {
        $file = $request->file('uploaded_file');

        if ($file) {
            // $filename = $file->getClientOriginalName();
            // $extension = $file->getClientOriginalExtension(); //Get extension of uploaded file
            $tempPath = $file->getRealPath();
            // $fileSize = $file->getSize(); //Get size
            //Check for file extension and size

            $importData_arr = array(); // Read through the file and store the contents as an array
            /// total of data save
            $indexCount = 0;

            //Read the contents of the uploaded file
            $file = fopen($tempPath, "r");



            while (($filedata = fgetcsv($file, 200, ",")) !== FALSE) {
                if ($indexCount == 0) {
                    $indexCount++;
                    continue;
                }

                $indexCount++;

                $barangay = $filedata[0];
                $nameAddress = $filedata[1];
                $precinctNumber = $filedata[2];;
                $registeredVoters = $filedata[3];;
                // $votersName = mb_convert_encoding($filedata[2]);

                /// no need for this
                // for viewing only
                $all_data = "barangay: " . $barangay  . " nameAddress:" . $nameAddress . " precint Number:" . $precinctNumber . ' registered Voters:' . $registeredVoters;
                // $all_data = $prec ." ". $legend ." ". $votersFirstName ." ". $votersLastName. " ". $votersAdress. " " . $municipality;
                array_push($importData_arr, $all_data);
                /// create ng save data 
                $uploadModel = new PopModel();
                $uploadModel->popBarangay = $barangay;
                $uploadModel->popNameAddress = $nameAddress;
                $uploadModel->popPrecinctNumber = $precinctNumber;
                $uploadModel->popRegisteredVoters = $registeredVoters;

                $uploadModel->save();
                if ($indexCount == 300) {
                    break;
                }
            }
            fclose($file); //Close after reading
            return $importData_arr;
        }
    }

    public function popViewAll(Request $req)
    {
        try {
            $dbtable = DB::table('pop')->select(DB::raw('count(popId) as `data`'), DB::raw("DATE_FORMAT(created_at, '%M %d %Y') new_date"),  DB::raw('YEAR(created_at) year, MONTH(created_at) month'))
                ->groupby('year', 'month')
                ->get();

            $barangay = $this->manageDataService->getAllPopBarangay();

            $popData = $this->manageDataService->getMultiplePop(
                '',
                '',
                '',
                50,
                'web',
            );

            // return $popData;
            return view('admin.manage_data.pop.pop_index', compact(['popData', 'dbtable','barangay']));
        } catch (Exception $e) {
            return $e;
        }
    }

    public function submitFilterPop(Request $req)
    {
        try {
            $dbtable = DB::table('pop')->select(DB::raw('count(popId) as `data`'), DB::raw("DATE_FORMAT(created_at, '%M %d %Y') new_date"),  DB::raw('YEAR(created_at) year, MONTH(created_at) month'))
                ->groupby('year', 'month')
                ->get();

            $barangay = $this->manageDataService->getAllPopBarangay();

            $filterPrecinct = $req->input('filterPrecinct') ?? '';
            $filterNameAndAddress = $req->input('filterNameAndAddress') ?? '';
            $filterBarangay = $req->input('selectBarangay') ?? '';
            
            $popData = $this->manageDataService->getMultiplePop(
                $filterPrecinct,
                $filterNameAndAddress,
                $filterBarangay,
                1000,
                'web',
            );

            // return $popData;
            if (count($popData) > 0)
            return view('admin.manage_data.pop.pop_index', compact(['popData', 'dbtable', 'barangay']));
        else
            return view('admin.manage_data.pop.pop_index', compact(['popData', 'dbtable', 'barangay']))->withMessage('No Details found. Try to search again !');
        
        } catch (Exception $e) {
            return $e;
        }
    }
}
