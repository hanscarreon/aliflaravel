<?php

namespace App\Http\Controllers\manage_data\encoded;

use App\Http\Controllers\Controller;
use App\Services\ManageDataService;
use Illuminate\Http\Request;

class EncodedController extends Controller
{
    protected $service;

    public function __construct(ManageDataService $service)
    {
        $this->manageDataService = $service;
    }

    public function encodedViewAll(Request $req)
    {
        $encodedData = $this->manageDataService->getMultipleEncoded(
            10,
            'web',
        );
        // return $encodedData;
        return view('admin.manage_data.encoded.encoded_index', compact(['encodedData']));
    }
}
