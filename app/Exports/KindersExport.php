<?php 

namespace App\Exports;

use App\Kinder;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;

class KindersExport implements FromArray,WithHeadings, ShouldAutoSize
{
    protected $rows;

    public function __construct(array $rows)
    {
        $this->rows = $rows;
       
    }

    public function headings(): array
    {
        return [
            'Parent Account ID',
            'Parent Name',
            'Parent Email',
            'Parent Prefecture',
            'Parent Registered Date',
            'Child Name',
            'Child gender',
            'Child Birthday',
            'Child School Link Date'
           
        ];
    }

    public function array(): array
    {
        return $this->rows;
       
       
    }

   
}

?>