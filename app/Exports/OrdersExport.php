<?php

namespace App\Exports;

use App\Models\Order;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class OrdersExport implements FromVIew, ShouldAutoSize, WithStyles
{
    public $orders;

   public function view(): View
    {
        $this->orders = Order::with(['products.parent', 'user'])->whereNull('done')->whereNull('canceled')->get();
        return view('exports.orders', [
            'orders' => $this->orders,
        ]);
    }

    public function styles(Worksheet $sheet)
    {
        $styles = [];
        $index = 1;
        
        foreach ($this->orders as $order ) {
            $styles[$index] = ['font' => ['bold' => true]];
            $styles[$index+1] = ['font' => ['bold' => true, 'italic' => true]];
            $index = $index + $order->products->count() + 3;
        }
        return $styles;

        // return [
        //     // Style the first row as bold text.
        //     // 1    => ['font' => ['bold' => true]],

        // ];
    }
}
