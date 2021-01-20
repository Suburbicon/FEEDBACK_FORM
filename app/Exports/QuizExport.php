<?php

namespace App\Exports;

use App\Models\Appeals;
use App\Models\Quiz;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnLimit;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithReadFilter;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\Reader\IReadFilter;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use function React\Promise\all;


class QuizExport implements FromQuery,WithMapping,WithHeadings,WithColumnWidths, WithStyles,ShouldAutoSize,WithEvents, With {

    public function query() {
        return Quiz::exportData();
    }

    public function map($row): array
    {
        return [
          $row->id,
            $row->phone,
            $row->name,
            $row->comment,
            $row->liked,
            $row->not_liked,
            $row->rating,
            $row->id_city,
            $row->id_department,
            $row->id_sector,
            $row->recomendation_rating,
            $row->created_at,
        ];
    }

    public function headings(): array
    {
        return [
            '№',
            'Телефон',
            'Имя',
            'Комментарий',
            'Понравившиеся',
            'Не понравившиеся',
            'Рейтинг',
            'Город',
            'Департамент',
            'Сектор',
            'Оценка',
            'Создан',
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 5,
            'E' => 30,
            'F' => 30,
        ];
    }

    public function styles(Worksheet $sheet)
    {

    }


    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $event->sheet->getStyle('A1:L1')->applyFromArray([
                    'font' => [
                        'bold' => true,
                    ],
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK,
                            'color' => ['argb' => '000000'],
                        ],
                    ],

                ]);
            },
            AfterSheet::class => function(AfterSheet $event) {
            }
        ];
    }
}
