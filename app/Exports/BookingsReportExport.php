<?php

declare(strict_types=1);

namespace App\Exports;

use App\Models\Booking;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\RichText\RichText;

class BookingsReportExport implements FromCollection, WithMapping, WithHeadings, WithStyles, ShouldAutoSize
{
    public function __construct(protected Collection $bookings) {}

    public function collection(): Collection
    {
        return $this->bookings;
    }

    public function headings(): array
    {
        return ['Room', 'Guest', 'Book', 'Stay', 'Status'];
    }

    public function map($b): array
    {
        return [
            $this->richText([
                ['Number:', true],
                [$b->room?->number, false],
                ['Status:', true],
                [efmt($b->room?->status), false],
            ]),
            $this->richText([
                ['Name:', true],
                [$b->guest_name, false],
                ['Email:', true],
                [$b->guest_email, false],
                ['Phone:', true],
                [$b->guest_phone, false],
            ]),
            $this->richText([
                ['From:', true],
                [dfmt($b->from_date), false],
                ['To:', true],
                [dfmt($b->to_date), false],
            ]),
            $this->richText([
                ['Check In:', true],
                [tfmt($b->check_in), false],
                ['Check Out:', true],
                [tfmt($b->check_out), false],
            ]),
            efmt($b->status),
        ];
    }

    protected function richText(array $chunks): RichText
    {
        $richText = new RichText();

        for ($i = 0; $i < count($chunks); $i += 2) {
            [$label, $bold] = $chunks[$i];
            [$value] = $chunks[$i + 1];

            $labelRun = $richText->createTextRun($label . "\n");
            if ($bold) {
                $labelRun->getFont()->setBold(true);
            }

            $richText->createTextRun($value . "\n\n");
        }

        return $richText;
    }

    public function styles(Worksheet $sheet): array
    {
        $sheet->getStyle('A1:E1')->applyFromArray([
            'font' => ['bold' => true],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['rgb' => 'E5E7EB'],
            ],
            'alignment' => [
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                'wrapText' => true,
            ],
        ]);

        $sheet->getRowDimension(1)->setRowHeight(30); // Increase header row height

        foreach (range('A', 'E') as $col) {
            $sheet->getStyle($col)->getAlignment()->setWrapText(true)->setVertical('top');
        }

        return [];
    }
}
