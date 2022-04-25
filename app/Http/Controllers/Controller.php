<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    private $data;

    public function successResponse($message, $body)
    {
        $this->data['status'] = true;
        $this->data['message'] = $message ?? [];
        $this->data['body'] = $body ?? [];

        return $this->data;
    }

    public function errorResponse($errorMessage, $body)
    {
        $this->data['status'] = false;
        $this->data['message'] = $errorMessage ?? [];
        $this->data['body'] = $body ?? [];

        return $this->data;
    }

    public function exceptionResponse($error)
    {
        $this->data['status'] = false;
        $this->data['message'] = $error;
        $this->data['body'] = [];

        return $this->data;
    }

    public function clean_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);

        return $data;
    }
}
