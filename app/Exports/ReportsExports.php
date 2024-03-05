<?php
namespace App\Exports;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;


class ReportsExports implements ShouldAutoSize, FromArray{

    protected $invoices;

    public function __construct(array $invoices){
        $this->invoices = $invoices;
    }

    public function array(): array{
        return $this->invoices;
    }
}
?>

