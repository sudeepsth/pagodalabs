<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class EmployeeExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */

    private $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function getCsvSettings(): array
    {
        return [
            'delimiter' => ';'
        ];
    }

    public function headings(): array
    {
        return [
            'id',
            'Name',
            'Designation',
            'Join Date',
        ];
    }

    public function collection()
    {
        return collect([
          $this->data
        ]);
    }
}
