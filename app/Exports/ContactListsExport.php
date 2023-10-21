<?php

namespace App\Exports;

use App\Models\ListContact;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ContactListsExport implements FromCollection, WithHeadings, WithStyles, WithEvents, ShouldAutoSize
{
  protected $params;

  public function __construct($params)
  {
    $this->params = $params;
  }

  public function collection()
  {
    // return User::all();

    $booth_name = $this->params[0];
    $tgl_start = $this->params[1];
    $tgl_end = $this->params[2];

    $data = ListContact::join('booths', 'booths.id', '=', 'list_contacts.booth_id')
      ->select(
        'list_contacts.image_print_id',
        'list_contacts.transaksi_id',
        'list_contacts.name',
        'list_contacts.phone',
        'list_contacts.email',
        'list_contacts.code',
        'booths.booth_name',
        'list_contacts.created_at'
      )->when($tgl_start, function ($query, $tgl_start) {
        $query->where('list_contacts.created_at', '>=', $tgl_start);
      })->when($tgl_end, function ($query, $tgl_end) {
        $query->where('list_contacts.created_at', '<=', $tgl_end);
      })->when($booth_name, function ($query, $booth_name) {
        $query->where('list_contacts.booth_id', $booth_name);
      })->orderBy('list_contacts.created_at', 'asc')
      ->get();

    return $data;
  }

  public function headings(): array
  {
    return [
      ['DAFTAR KONTAK'],
      ['ID IMAGE PRINT', 'ID TRANSAKSI', 'NAMA', 'NOMOR TELEPON', 'EMAIL', 'KODE', 'NAMA BOOTH', 'CREATED']
    ];
  }

  public function styles(Worksheet $sheet)
  {
    return [
      1 => ['font' => ['bold' => true, 'size' => 14]],
      2 => ['font' => ['size' => 13]],
    ];
  }

  public function registerEvents(): array
  {
    return [
      AfterSheet::class => function (AfterSheet $event) {
        $cellRange = 'A2:H150';
        $event->sheet->getStyle($cellRange)->applyFromArray([
          'borders' => [
            'allBorders' => [
              'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
              'color' => ['argb' => '000000'],
            ],
          ],
        ])->getAlignment()->setWrapText(true);
      },
    ];
  }
}
