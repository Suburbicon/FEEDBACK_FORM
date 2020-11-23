<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use \SimpleSoftwareIO\QrCode\Facades\QrCode;


class QrController extends Controller {


    public function QrGenerated($params) {
        try {
            $gen_link = 'http://78.40.108.18:8080/test_index?id_city='.$params['id_city'].'&id_department='.$params['id_department'].'&id_sector='.$params['id'];

            QrCode::size(500)
                ->format('svg')
                ->generate($gen_link, storage_path('app/public/qrcodes/'.time().'.svg'));

//            dd('/storage/app/public/qrcodes/'.time().'.svg');
            return '/storage/qrcodes/'.time().'.svg';
        } catch (\DomainException $e) {
            return $this->errorResponse($e->getMessage(), 422);
        }
    }

}
