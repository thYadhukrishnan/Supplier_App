<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromArray;


class orderExport implements FromArray
{
    /**
    * @return \Illuminate\Support\Collection
    */

    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    // public function collection()
    // {
    //     return collect($this->data);
    // }

    public function array(): array
    {
        return $this->data;
    }
}
