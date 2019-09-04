<?php 

namespace App\Exports;

use App\Kinder;
use Maatwebsite\Excel\Concerns\FromArray;

class KindersExport implements FromArray
{
    protected $rows;

    public function __construct(array $rows)
    {
        $this->rows = $rows;
       
    }

    public function headings(): array
    {
        return array('Child Name','Child Gender','Child Birthday','Parent Account_id','Parent Name','Parent Email','Parent Prefecture','Parent Registered Date');
    }

    public function array(): array
    {
        return $this->rows;
       
    }
}

?>