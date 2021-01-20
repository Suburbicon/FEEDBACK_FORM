<?php

namespace App\Exports;

use App\Models\Appeals;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;


class AppealsExport implements FromQuery,WithMapping,WithHeadings, WithColumnWidths {

    public function query() {
        return Appeals::exportData();
    }

    public function map($row): array
    {
        return [
          $row->id,
          $row->phone,
          $row->name,
          $row->comment,
          $row->id_city,
          $row->id_department,
          $row->id_sector,
          $row->recomendation_rating,
          $row->created_at
        ];
    }

    public function headings(): array
    {
        return [
            '№',
            'Телефон',
            'Имя',
            'Комментарий',
            'Город',
            'Департамент',
            'Сектор',
            'Оценка',
            'Создан',
//            'Создан',
        ];
    }

    public function columnWidths(): array
    {
        return [
          'A' => 20,
          'B' => 20,
          'C' => 20,
          'D' => 20,
          'E' => 20,
          'F' => 20,
          'G' => 20,
          'H' => 20,
        ];
    }
}
