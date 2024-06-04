<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Certificate;

class CertificateController extends Controller
{
    public function checkCertificate(){
        
        $certificate = Certificate::all();
        dd($certificate->all());
    }
}
