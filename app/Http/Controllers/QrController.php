<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use \SimpleSoftwareIO\QrCode\Facades\QrCode;


class QrController extends Controller {


    public function QrGenerated() {
        try {
            $params = [
                "id_city" => '1',
                "id_department" => '1',
                "id_sector" => '1'
            ];
//            $qr = QrCode::encoding('UTF-8')->size(100)->generate();
            $image = QrCode::format('png');
//                ->generate('https://vk.com?id_city='.$params['id_city'].'&id_department='.$params['id_department'].'&id_sector='.$params['id_sector']);

//            $image = QrCode::format('png')->merge('https://www.w3adda.com/wp-content/uploads/2019/07/laravel.png', 0.3, true)
//                ->size(200)->errorCorrection('H')
//                ->generate('W3Adda Laravel Tutorial');
            dd($image);
            $output_file = 'img-' . time() . '.png';
//            dd($output_file);
            Storage::disk('public')->put($output_file, $image);
//            dd($qr);
//            return $this->successResponseSimple(200, $response);
        } catch (\DomainException $e) {
            return $this->errorResponse($e->getMessage(), 422);
        }
    }

}
