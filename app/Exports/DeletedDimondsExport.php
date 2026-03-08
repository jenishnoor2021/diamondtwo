<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class DeletedDimondsExport implements WithMultipleSheets
{
    protected $ids;

    public function __construct($ids)
    {
        $this->ids = $ids;
    }

    public function sheets(): array
    {
        return [
            new DiamondsSheet($this->ids),
            new ProcessesSheet($this->ids),
            new RepairsSheet($this->ids),
            new DailiesSheet($this->ids),
        ];
    }
}
