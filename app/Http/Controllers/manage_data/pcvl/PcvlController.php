<?php

namespace App\Http\Controllers\manage_data\pcvl;

use App\Http\Controllers\Controller;
use App\Pcvl;
use App\PcvlModel;
use App\Services\ManageDataService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PcvlController extends Controller
{
    protected $service;

    public function __construct(ManageDataService $service)
    {
        $this->manageDataService = $service;
    }

    public function pcvlUploadFile(Request $request)
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



                $prec = $filedata[0];
                $legend = $filedata[1];
                $votersFirstName = $this->mb_convert_encoding($filedata[2]);
                $votersLastName = $this->mb_convert_encoding($filedata[3]);
                // $votersName = mb_convert_encoding($filedata[2]);
                $votersAdress = $this->mb_convert_encoding($filedata[4]);
                $votersDistrict = $filedata[5];
                $municipality = $filedata[6];
                $barangay = $filedata[7];

                /// no need for this
                // for viewing only
                $all_data = $prec  . " legend:" . $legend . " fname:" . $votersFirstName . ' lname:' . $votersLastName . ' address:' . $votersAdress . ' muni:' . $municipality . ' brgy:' . $barangay;
                // $all_data = $prec ." ". $legend ." ". $votersFirstName ." ". $votersLastName. " ". $votersAdress. " " . $municipality;
                array_push($importData_arr, $all_data);
                /// create ng save data 
                $uploadModel = new PcvlModel();
                $uploadModel->pcvlPrecinctNumber = $prec;
                $uploadModel->pcvlLegend = $legend;
                $uploadModel->pcvlVotersFirstName = $votersFirstName;
                $uploadModel->pcvlVotersLastName = $votersLastName;
                $uploadModel->pcvlVotersAddress = $votersAdress;
                $uploadModel->pcvlDistrict = $votersDistrict;
                $uploadModel->pcvlMunicipality = $municipality;
                $uploadModel->pcvlBarangay = $barangay;

                $uploadModel->save();

                if ($indexCount == 1000) {
                    break;
                }
            }
            fclose($file); //Close after reading
            return $importData_arr;
        }
    }



    public function pcvlViewAll(Request $req)
    {
        try {

            $filterName = $req->input('filterName') ?? '';
            $filterPrecinct = $req->input('filterPrecinct') ?? '';
            $filterMunicipal = $req->input('selectMunicipal') ?? '';
            $filterDistrict = $req->input('selectDistrict') ?? '';


            $jsonDistrict = json_decode(file_get_contents(
                public_path() . '/json/bulacan_district_list.json'
            ), true);


            $municipal = $this->manageDataService->getAllMunicipal();
            $pcvlData = $this->manageDataService->getMultiplePcvl(
                $filterName,
                $filterPrecinct,
                $filterMunicipal,
                $filterDistrict,
                50,
                'web',
            );

            $dbtable = DB::table('pcvl')->select(DB::raw('count(pcvlId) as `data`'), DB::raw("DATE_FORMAT(created_at, '%M %d %Y') new_date"),  DB::raw('YEAR(created_at) year, MONTH(created_at) month'))
                ->groupby('year', 'month')
                ->get();


            if (count($pcvlData) > 0)
                return view('admin.manage_data.pcvl.pcvl_index', compact(['pcvlData', 'municipal', 'jsonDistrict','dbtable']))->withDetails($pcvlData)->withQuery($filterName, $filterPrecinct);
            else
                return view('admin.manage_data.pcvl.pcvl_index', compact(['pcvlData', 'municipal', 'jsonDistrict','dbtable']))->withMessage('No Details found. Try to search again !');
            // return view('admin.manage_data.pcvl.pcvl_index', compact(['pcvlData', 'jsonData', 'municipal', 'jsonDistrict']));
        } catch (Exception $e) {
            return $e;
        }
    }

    public function submitFilterPcvl(Request $req)
    {
        $filterName = $req->input('filterName');
        $filterPrecinct = $req->input('filterPrecinct');
        $filterMunicipal = $req->input('selectMunicipal');
        $filterDistrict = $req->input('selectDistrict');
      
        $jsonDistrict = json_decode(file_get_contents(
            public_path() . '/json/bulacan_district_list.json'
        ), true);


        $municipal = $this->manageDataService->getAllMunicipal();
        $pcvlData = $this->manageDataService->getMultiplePcvl(
            $filterName,
            $filterPrecinct,
            $filterMunicipal,
            $filterDistrict,
            1000,
            'web',
        );

        $dbtable = DB::table('pcvl')->select(DB::raw('count(pcvlId) as `data`'), DB::raw("DATE_FORMAT(created_at, '%M %d %Y') new_date"),  DB::raw('YEAR(created_at) year, MONTH(created_at) month'))
        ->groupby('year', 'month')
        ->get();

        

        if (count($pcvlData) > 0)
            return view('admin.manage_data.pcvl.pcvl_index', compact(['pcvlData', 'municipal', 'jsonDistrict','dbtable']));
        else
            return view('admin.manage_data.pcvl.pcvl_index', compact(['pcvlData', 'municipal', 'jsonDistrict','dbtable']))->withMessage('No Details found. Try to search again !');
        // return redirect()->route('pcvlViewAll', $filterName,$filterPrecinct)
    }
}
