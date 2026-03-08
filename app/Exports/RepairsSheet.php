<?php

namespace App\Exports;

use App\Models\Repair;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;

class RepairsSheet implements FromCollection, WithHeadings, WithTitle
{
    protected $ids;

    public function __construct($ids)
    {
        $this->ids = $ids;
    }

    public function collection()
    {
        return Repair::whereIn('dimonds_id', $this->ids)->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Diamond ID',
            'Created At',
            'Updated At'
        ];
    }

    public function title(): string
    {
        return 'repair-sheet';
    }
}
