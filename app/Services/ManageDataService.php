<?php

namespace App\Services;

use App\ModelRegistration;
use App\Pcvl;
use App\PcvlModel;
use App\PopModel;
use Illuminate\Support\Facades\DB;

class ManageDataService
{

    public function getMultiplePcvl($filterName, $filterPrecinct, $filterMunicipal, $filterDistrict, $limit, $paginated, $page = 1)
    {
        $pcvlModel = new PcvlModel();

        if ($filterName != '') {
            $pcvlModel = $pcvlModel->where('pcvl.pcvlVotersFirstName', 'LIKE', "%{$filterName}%")->orWhere('pcvl.pcvlVotersLastName', 'LIKE', "%{$filterName}%");
            // $pcvlModel = $pcvlModel->where('pcvl.pcvlVotersLastName', 'LIKE', "%{$filter}%");
        }

        if ($filterPrecinct != '') {
            $pcvlModel = $pcvlModel->where('pcvl.pcvlPrecinctNumber', 'LIKE', "%{$filterPrecinct}%");
            $pcvlModel = $pcvlModel->orderBy('pcvl.pcvlPrecinctNumber', 'ASC');
        }

        if ($filterMunicipal != '') {
            $pcvlModel = $pcvlModel->where('pcvl.pcvlMunicipality', 'LIKE', "%{$filterMunicipal}%");
            $pcvlModel = $pcvlModel->orderBy('pcvl.pcvlVotersFirstName', 'ASC');
        }
        if ($filterDistrict != '') {
            $pcvlModel = $pcvlModel->where('pcvl.pcvlDistrict', 'LIKE', "%{$filterDistrict}%");
            $pcvlModel = $pcvlModel->orderBy('pcvl.pcvlVotersFirstName', 'ASC');
        }

        $pcvlModel = $pcvlModel->groupBy('pcvl.pcvlVotersFirstName', 'pcvl.pcvlVotersLastName', 'pcvl.pcvlDistrict');
        $pcvlModel = $pcvlModel->orderBy('pcvlDistrict', 'ASC');


        // if($filterName != '' && $filterPrecinct !=''){
        //     $pcvlModel = $pcvlModel->where('pcvl_upload.pcvlUploadVotersFirstName', 'LIKE', "%{$filterName}%")->orWhere('pcvl_upload.pcvlUploadVotersLastName', 'LIKE', "%{$filterName}%")->orWhere('pcvl_upload.pcvlUploadPrecinctNumber', 'LIKE', "%{$filterPrecinct}%");
        // }

        // if($filterPrecinct != ''){
        //     $pcvlModel = $pcvlModel->where('pcvl_upload.pcvlUploadVotersFirstName', 'LIKE', "%{$filterName}%")->orWhere('pcvl_upload.pcvlUploadVotersLastName', 'LIKE', "%{$filterName}%");

        // }

        if ($paginated === true) {
            $offset = ($page >= 3) ? ($page * $limit) - $limit : (($page == 2) ? $limit : 0);
            $pcvlModel = $pcvlModel->offset($offset);
            $pcvlModel = $pcvlModel->limit($limit)->get();

            return $pcvlModel;
        } elseif ($paginated == 'web') {
            $pcvlModel = $pcvlModel->paginate($limit);
            return $pcvlModel;
        }

        $pcvlModel = $pcvlModel->limit($limit)->get();

        return $pcvlModel;
    }
    public function getMultiplePop( $filterPrecinctNumber,$filterNameAndAddress,$filterBarangay, $limit, $paginated, $page = 1)
    {
        $popModel = new PopModel();

        if ($filterBarangay != '') {
            $popModel = $popModel->where('pop.popBarangay', 'LIKE', "%{$filterBarangay}%");
        }
        if ($filterPrecinctNumber != '') {
            $popModel = $popModel->where('pop.popPrecinctNumber', 'LIKE', "%{$filterPrecinctNumber}%");
            $popModel = $popModel->orderBy('pop.popPrecinctNumber', 'ASC');
        }
        if ($filterNameAndAddress != '') {
            $popModel = $popModel->where('pop.popNameAddress', 'LIKE', "%{$filterNameAndAddress}%");
            $popModel = $popModel->orderBy('pop.popPrecinctNumber', 'ASC');
        }

        $popModel = $popModel->orderBy('popPrecinctNumber', 'ASC');


        // if($filterName != '' && $filterPrecinct !=''){
        //     $popModel = $popModel->where('pcvl_upload.pcvlUploadVotersFirstName', 'LIKE', "%{$filterName}%")->orWhere('pcvl_upload.pcvlUploadVotersLastName', 'LIKE', "%{$filterName}%")->orWhere('pcvl_upload.pcvlUploadPrecinctNumber', 'LIKE', "%{$filterPrecinct}%");
        // }

        // if($filterPrecinct != ''){
        //     $popModel = $popModel->where('pcvl_upload.pcvlUploadVotersFirstName', 'LIKE', "%{$filterName}%")->orWhere('pcvl_upload.pcvlUploadVotersLastName', 'LIKE', "%{$filterName}%");

        // }

        if ($paginated === true) {
            $offset = ($page >= 3) ? ($page * $limit) - $limit : (($page == 2) ? $limit : 0);
            $popModel = $popModel->offset($offset);
            $popModel = $popModel->limit($limit)->get();

            return $popModel;
        } elseif ($paginated == 'web') {
            $popModel = $popModel->paginate($limit);
            return $popModel;
        }

        $popModel = $popModel->limit($limit)->get();

        return $popModel;
    }



    public function getMultipleEncoded($limit, $paginated, $page = 1)
    {
        $encodedModel = new ModelRegistration();
        $encodedModel = $encodedModel->Join('philippine_barangays', 'philippine_barangays.barangay_code', 'registration.barangay');
        $encodedModel = $encodedModel->Join('philippine_cities', 'philippine_cities.city_municipality_code' ,'registration.city');
        $encodedModel = $encodedModel->leftJoin('philippine_provinces', 'philippine_provinces.province_code' ,'registration.province');

        if ($paginated === true) {
            $offset = ($page >= 3) ? ($page * $limit) - $limit : (($page == 2) ? $limit : 0);
            $encodedModel = $encodedModel->offset($offset);
            $encodedModel = $encodedModel->limit($limit)->get();

            return $encodedModel;
        } elseif ($paginated == 'web') {
            $encodedModel = $encodedModel->paginate($limit);

            return $encodedModel;
        }
        $encodedModel = $encodedModel->limit($limit)->get();

        return $encodedModel;
    }

    public function getAllMunicipal()
    {
        $pcvlModel = new PcvlModel();
        $pcvlModel = $pcvlModel->select('pcvlMunicipality as municipal', DB::raw('count(*) as total'));
        $pcvlModel = $pcvlModel->groupBy('pcvlMunicipality',);
        $pcvlModel = $pcvlModel->get();
        return $pcvlModel;
    }

    public function getAllPopBarangay()
    {
        $pcvlModel = new PopModel();
        $pcvlModel = $pcvlModel->select('popBarangay as barangay', DB::raw('count(*) as total'));
        $pcvlModel = $pcvlModel->groupBy('popBarangay',);
        $pcvlModel = $pcvlModel->get();
        return $pcvlModel;
    }

    public function getAllDistrict()
    {
        $pcvlModel = new PcvlModel();
        $pcvlModel = $pcvlModel->select('pcvlDistrict', DB::raw('count(*) as total'));
        $pcvlModel = $pcvlModel->groupBy('pcvlDistrict',);
        $pcvlModel = $pcvlModel->get();
        return $pcvlModel;
    }
}
