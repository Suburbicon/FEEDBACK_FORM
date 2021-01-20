<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;


class ExcelController extends Controller {

    public function excelGenerated() {
        Excel::create('Filename', function($excel) {

            $excel->sheet('Sheetname', function ($sheet){

                $sheet->setStyle(array(
                    'font' => array(
                        'name'      =>  'Calibri',
                        'size'      =>  15,
                        'bold'      =>  true
                    )
                ));
            });

        })->download('xls');
    }

}
