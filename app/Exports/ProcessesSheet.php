<?php

namespace App\Exports;

use App\Models\Process;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;

class ProcessesSheet implements FromCollection, WithHeadings, WithTitle
{
    protected $ids;

    public function __construct($ids)
    {
        $this->ids = $ids;
    }

    public function collection()
    {
        return Process::whereIn('dimonds_id', $this->ids)
            ->orderBy('dimonds_id', 'ASC')   // same diamond together
            ->orderBy('id', 'ASC')           // process sequence
            ->get([
                'id',
                'dimonds_id',
                'dimonds_barcode',
                'designation',
                'worker_name',
                'issue_date',
                'issue_weight',
                'return_date',
                'return_weight',
                'price',
                'r_shape',
                'r_weight',
                'r_clarity',
                'r_color',
                'r_cut',
                'r_polish',
                'r_symmetry',
                'ratecut'
            ]);
    }

    public function headings(): array
    {
        return [
            'ID',
            'Diamond ID',
            'Barcode',
            'Designation',
            'Worker Name',
            'Issue Date',
            'Issue Weight',
            'Return Date',
            'Return Weight',
            'Price',
            'Return Shape',
            'Return Weight',
            'Return Clarity',
            'Return Color',
            'Return Cut',
            'Return Polish',
            'Return Symmetry',
            'Rate Cut'
        ];
    }

    public function title(): string
    {
        return 'Process-sheet';
    }
}
