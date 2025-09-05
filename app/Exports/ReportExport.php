<?php

namespace App\Exports;

use App\Models\DeliveryOrder;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ReportExport implements FromCollection, WithHeadings, WithMapping, WithStyles
{
    public $filters;

    public function __construct($filters = [])
    {
        $this->filters = $filters;
    }

    public function collection()
    {
        $query = DeliveryOrder::query();

        if (!empty($this->filters['start_date'])) {
            $query->whereDate('created_at', '>=', $this->filters['start_date']);
        }
        if (!empty($this->filters['end_date'])) {
            $query->whereDate('created_at', '<=', $this->filters['end_date']);
        }

        return $query->get();
    }

    public function headings(): array
    {
        return [
            'No',
            'Order Number',
            'Destination Address',
            'Driver',
            'Total Items',
            'Status'
        ];
    }

    public function map($order): array
    {
        static $no = 1;

        return [
            $no++,
            $order->order_number ?? '-',
            $order->destination_address ?? '-',
            $order->driver->name ?? '-',    // asumsi ada relasi driver
            $order->total_items ?? 0,
            ucfirst($order->status) ?? '-',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $lastColumn = 'F'; // karena cuma 6 kolom
        $rowCount   = $this->collection()->count() + 1;

        // Header style
        $sheet->getStyle("A1:{$lastColumn}1")->applyFromArray([
            'font' => [
                'bold' => true,
                'color' => ['rgb' => 'FFFFFF'],
                'size' => 12,
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['rgb' => '4F46E5'],
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical'   => Alignment::VERTICAL_CENTER,
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_MEDIUM,
                ],
            ],
        ]);

        // Autofit kolom
        foreach (range('A', $lastColumn) as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }

        // Data row style
        $sheet->getStyle("A2:{$lastColumn}{$rowCount}")->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                ],
            ],
            'alignment' => [
                'vertical' => Alignment::VERTICAL_CENTER,
            ],
        ]);

        // Zebra row
        for ($i = 2; $i <= $rowCount; $i++) {
            if ($i % 2 === 0) {
                $sheet->getStyle("A{$i}:{$lastColumn}{$i}")->applyFromArray([
                    'fill' => [
                        'fillType' => Fill::FILL_SOLID,
                        'startColor' => ['rgb' => 'F3F4F6'],
                    ],
                ]);
            }
        }

        return [];
    }
}
