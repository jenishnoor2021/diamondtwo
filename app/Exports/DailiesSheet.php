<?php

namespace App\Exports;

use App\Models\Daily;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;

class DailiesSheet implements FromCollection, WithHeadings, WithTitle
{
    protected $ids;

    public function __construct($ids)
    {
        $this->ids = $ids;
    }

    public function collection()
    {
        return Daily::whereIn('dimonds_id', $this->ids)->get([
            'id',
            'dimonds_id',
            'barcode',
            'stage',
            'status',
            'created_at'
        ]);
    }

    public function headings(): array
    {
        return [
            'ID',
            'Diamond ID',
            'Barcode',
            'Stage',
            'Status',
            'Created At'
        ];
    }

    public function title(): string
    {
        return 'Dailies-sheet';
    }
}
