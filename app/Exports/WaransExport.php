<?php

namespace App\Exports;

use App\Models\Waran;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class WaransExport implements FromCollection, WithHeadings, WithMapping, WithStyles, WithColumnWidths
{
    protected $rowNumber = 0;
    protected $data;

    public function collection()
    {
        $this->data = Waran::with('perbelanjaans')
            ->orderBy('id', 'asc') 
            ->get();
            
        return $this->data;
    }

    public function map($waran): array
    {
        $this->rowNumber++;
        $peratus = ($waran->peruntukan > 0) ? ($waran->jum_belanja / $waran->peruntukan) : 0;

        return [
            $waran->sektor,
            $this->rowNumber,
            $waran->no_waran,
            $waran->vot, // <--- TAMBAH DI SINI (KOLUM D)
            $waran->tujuan,
            $waran->program_aktiviti,
            $waran->objek,
            (float) $waran->peruntukan,
            (float) $waran->jum_belanja, 
            (float) $waran->baki,
            (float) $peratus,
            $waran->tarikh_terima_waran ? $waran->tarikh_terima_waran->format('d/m/Y') : '-',
            $waran->senarai_catatan_belanja ?: 'Tiada Perbelanjaan',
            $waran->pegawai_meja,
        ];
    }

    public function headings(): array
    {
        return [
            'SEKTOR', 'BIL', 'NO. WARAN', 'VOT', // <--- TAMBAH DI SINI
            'TUJUAN / PROGRAM UTAMA', 'PECAHAN PROGRAM/AKTIVITI', 
            'OBJEK', 'PERUNTUKAN (RM)', 'JUM. BELANJA (RM)', 
            'BAKI (RM)', 'PERCENT (%)', 'TARIKH TERIMA', 
            'CATATAN PERBELANJAAN', 'PEGAWAI MEJA'
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 36, 'B' => 6,  'C' => 15, 'D' => 12, // D untuk VOT
            'E' => 45, 'F' => 30, 'G' => 12, 'H' => 18, 
            'I' => 18, 'J' => 18, 'K' => 12, 'L' => 15, 
            'M' => 50, 'N' => 25
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $highestRow = $sheet->getHighestRow();

        // 1. Styling Header (Sekarang A1 sampai N1 sebab dah tambah 1 kolum)
        $sheet->getStyle('A1:N1')->applyFromArray([
            'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER, 
                'vertical' => Alignment::VERTICAL_CENTER, 
                'wrapText' => true
            ],
            'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => '1B3061']],
        ]);

        // 2. Borders & Alignment (A1 sampai N)
        $sheet->getStyle('A1:N' . $highestRow)->applyFromArray([
            'borders' => ['allBorders' => ['borderStyle' => Border::BORDER_THIN]],
            'alignment' => ['vertical' => Alignment::VERTICAL_CENTER],
        ]);

        // 3. LOGIK MERGE (Sektor, No Waran, Vot, Tujuan, Tarikh, Pegawai)
        $startRow = 2;
        for ($i = 0; $i < count($this->data); $i++) {
            $current = $this->data[$i];
            $next = ($i + 1 < count($this->data)) ? $this->data[$i + 1] : null;

            if (!$next || $current->no_waran !== $next->no_waran) {
                $endRow = $i + 2; 
                
                if ($startRow < $endRow) {
                    $sheet->mergeCells("A{$startRow}:A{$endRow}"); // Sektor
                    $sheet->mergeCells("C{$startRow}:C{$endRow}"); // No Waran
                    $sheet->mergeCells("D{$startRow}:D{$endRow}"); // VOT (Baru ditambah)
                    $sheet->mergeCells("E{$startRow}:E{$endRow}"); // Tujuan
                    $sheet->mergeCells("L{$startRow}:L{$endRow}"); // Tarikh
                    $sheet->mergeCells("N{$startRow}:N{$endRow}"); // Pegawai
                }
                $startRow = $endRow + 1;
            }
        }

        // 4. Money & Percentage Formatting (H, I, J dan K)
        $sheet->getStyle('H2:J' . $highestRow)->getNumberFormat()->setFormatCode('#,##0.00');
        $sheet->getStyle('K2:K' . $highestRow)->getNumberFormat()->setFormatCode('0%');

        // 5. Wrap Text & Align
        $sheet->getStyle('E2:E' . $highestRow)->getAlignment()->setWrapText(true);
        $sheet->getStyle('M2:M' . $highestRow)->getAlignment()->setWrapText(true);
        $sheet->getStyle('B2:D' . $highestRow)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

        return [];
    }
}