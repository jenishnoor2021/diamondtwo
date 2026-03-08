<?php

namespace App\Exports;

use App\Models\Dimond;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;

class DiamondsSheet implements FromCollection, WithHeadings, WithTitle
{
    protected $ids;

    public function __construct($ids)
    {
        $this->ids = $ids;
    }

    public function collection()
    {
        return Dimond::whereIn('id', $this->ids)->get([
            'id',
            'parties_id',
            'dimond_name',
            'janger_no',
            'shape',
            'weight',
            'required_weight',
            'clarity',
            'color',
            'cut',
            'polish',
            'symmetry',
            'barcode_number',
            'status',
            'amount',
            'delevery_date',
            'created_at'
        ]);
    }

    public function headings(): array
    {
        return [
            'ID',
            'Party ID',
            'Diamond Name',
            'Janger No',
            'Shape',
            'Weight',
            'Required Weight',
            'Clarity',
            'Color',
            'Cut',
            'Polish',
            'Symmetry',
            'Barcode Number',
            'Status',
            'Amount',
            'Delivery Date',
            'Created At'
        ];
    }

    public function title(): string
    {
        return 'diamonds-sheet';
    }
}
