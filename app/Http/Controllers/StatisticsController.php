<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StatisticsController extends Controller
{
    public function getSalesHistory()
    {
        $salesHistory = DB::table('ventas')
            ->select(DB::raw('TO_CHAR(fecha::date, \'MM-YYYY\') as month_year'), DB::raw('SUM(total) as total'))
            ->groupBy(DB::raw('TO_CHAR(fecha::date, \'MM-YYYY\')'))
            ->orderBy('month_year', 'asc')
            ->get();

        $response = [
            'data' => $salesHistory->pluck('month_year'),
            'values' => $salesHistory->pluck('total'),
        ];

        return response()->json($response);
    }

    public function getInventoryMovements()
    {
        $inventoryMovements = DB::table('inventarios')
            ->select(DB::raw('TO_CHAR(fecha_movimiento::date, \'MM-YYYY\') as month_year'), DB::raw('SUM(cantidad) as total_movements'))
            ->groupBy(DB::raw('TO_CHAR(fecha_movimiento::date, \'MM-YYYY\')'))
            ->orderBy('month_year', 'asc')
            ->get();

        $response = [
            'data' => $inventoryMovements->pluck('month_year'),
            'values' => $inventoryMovements->pluck('total_movements'),
        ];

        return response()->json($response);
    }
}
