<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Phpml\Regression\LeastSquares;

class TimeSeriesController extends Controller
{
    public function predictByMonth($data)
    {
        $maxMonthYear = max(array_column($data, 'month_year'));
        $maxMonth = (int)substr($maxMonthYear, 0, 2);
        $maxYear = (int)substr($maxMonthYear, -4);

        // Calcular el siguiente mes y año
        $nextMonth = ($maxMonth % 12) + 1;
        $nextYear = ($nextMonth === 1) ? $maxYear + 1 : $maxYear;

        // Formatear el próximo mes y año
        $nextMonthYear = sprintf('%02d-%04d', $nextMonth, $nextYear);

        // Crear la matriz para la predicción del próximo mes
        $futureData = [[$nextMonth]];
        $samples = [];
        $targets = [];
        foreach ($data as $row) {
            $samples[] = [($row->month_year === $maxMonthYear) ? 0 : 1]; // 0 para el último mes, 1 para otros
            $targets[] = $row->total;
        }

        $regression = new LeastSquares(); // minimos cuadrados
        $regression->train($samples, $targets);

        $predicted_income = $regression->predict($futureData);

        return response()->json([
            'predicted_income' => $predicted_income[0],
            'month_year' => $nextMonthYear
        ]);
    }


}
