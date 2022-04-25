<?php

namespace App\Http\Controllers\pcvl;

use App\Http\Controllers\Controller;
use App\Pcvl;
use Exception;
use Illuminate\Database\Console\Migrations\StatusCommand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers;
use App\PcvlUpload;
use App\Services\PcvlService;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Mail;

class PcvlController extends Controller
{

    protected $service;

    public function __construct(PcvlService $service)
    {
        $this->pcvlService = $service;
    }

    // DON'T DELETE IN CASE NEEDED ~ CREATE FUNCTION OF PCVL
    // public function pvclCreate(Request $req)
    // {
    //     try {
    //         $inputField = $req->input();

    //         // $validator = Validator::make(
    //         //     $inputField,
    //         //     [
    //         //         'pcvlPrecinctNumber' => ['required', 'string'],
    //         //         'pcvlLegend' => ['required', 'string'],
    //         //     ],
    //         // );

    //         $pcvlData['pcvlPrecinctNumber'] = $this->clean_input($inputField['pcvlPrecinctNumber']);
    //         $pcvlData['pcvlVotersFirstName'] = $this->clean_input($inputField['pcvlVotersFirstName']);
    //         $pcvlData['pcvlVotersMiddleName'] = $this->clean_input($inputField['pcvlVotersMiddleName']);
    //         $pcvlData['pcvlVotersLastName'] = $this->clean_input($inputField['pcvlVotersLastName']);
    //         $pcvlData['pcvlLegend'] = $this->clean_input($inputField['pcvlLegend']);
    //         $pcvlData['pcvlMunicipality'] = $this->clean_input($inputField['pcvlMunicipality']);
    //         $pcvlData['pcvlBarangay'] = $this->clean_input($inputField['pcvlBarangay']);
    //         $pcvlData['pcvlDistrict'] = $this->clean_input($inputField['pcvlDistrict']);
    //         $pcvlId = Pcvl::insertGetId($pcvlData);
    //         $pcvlData['pcvlId'] = $pcvlId;

    //         $msg = 'PCVL Data Created Success';

    //         return $this->successResponse($msg, $pcvlData);
    //         // return $this->successRe
    //     } catch (Exception $e) {
    //         //throw $th;
    //         return $this->exceptionResponse($e, []);
    //     }
    // }



    public function uploadFile(Request $request)
    {
        $file = $request->file('uploaded_file');


        if ($file) {
            $filename = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension(); //Get extension of uploaded file
            $tempPath = $file->getRealPath();
            $fileSize = $file->getSize(); //Get size
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
                $votersName = mb_convert_encoding($filedata[2], 'UTF-8', 'UTF-8');
                $votersAdress = $filedata[3];
                $municipality = $filedata[4];
                $barangay = $filedata[5];

                /// no need for this
                // for viewing only
                $all_data = $prec . " " . " " . $legend . " name:" . $votersName . ' address:' . $votersAdress . ' muni:' . $municipality . ' brgy:' . $barangay;
                array_push($importData_arr, $all_data);
                /// create ng save data 
                $uploadModel = new PcvlUpload();
                $uploadModel->pcvlUploadPrecinctNumber = $prec;
                $uploadModel->pcvlUploadLegend = $legend;
                $uploadModel->pcvlUploadVotersName = $votersName;
                $uploadModel->pcvlUploadVotersAddress = $votersAdress;
                $uploadModel->pcvlMunicipality = $municipality;
                $uploadModel->pcvlBarangay = $barangay;
                $uploadModel->save();
            }
            fclose($file); //Close after reading

            return $importData_arr;
        }
    }


    public function getPcvlApi(Request $req)
    {
        try {
            $pcvlVotersFullName = $req->query('pcvlVotersFullName') ?? 'pcvlVotersFullName';
            $limit = $req->query('limit') ?? 1;
            $page = $req->query('page') ?? 1;
            $pcvlData = $this->pcvlService->getMultiplePcvl(
                $pcvlVotersFullName,
                $limit,
                true,
                $page,
            );

            $msg = count($pcvlData) . ' result found on page #' . $page;

            return $this->successResponse($msg, $pcvlData);
        } catch ( Exception $e) {
            return $this->exceptionResponse($e);            
        }
    }

    public function pcvlViewAll(Request $req)
    {
        try {
            $pcvlVotersFullName = $req->pcvlVotersFullName;
            // $limit = $req->query('limit') ?? 10;
            // $page = $req->query('page') ?? 1;
            $pcvlData = $this->pcvlService->getMultiplePcvl(
                $pcvlVotersFullName,
                10,
                'web',
            );

            // $msg = count($pcvlData) . ' result found on page #' . $pcvlData;
            // return $pcvlData;
            return view('admin.pcvl.pcvl_index', compact(['pcvlData']));
        } catch ( Exception $e) {
            return $e;            
        }
    }

    public function submitFilterPcvl(Request $req)
    {
        $pcvlVotersFullName = $req->input('pcvlVotersFullName') ?? 'pcvlVotersFullName';
        return $pcvlVotersFullName;
        // return $filter;
    }
}
