<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataModel;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Support\Facades\View;

class GrafikController extends Controller
{
    public function grafikMonitoring(Request $request)
    {
        // Ambil tanggal dari request atau set default ke hari ini
        $startDate = $request->query('start_date', date('Y-m-d'));
        $endDate = $request->query('end_date', date('Y-m-d', strtotime('+1 day')));
        // List metrik yang diambil
        $metrics = ['Voltage', 'Current', 'Power', 'Energy', 'Frequency', 'PowerFactor'];
        $dataChart = [];

        foreach ($metrics as $metric) {
            $data = DataModel::select('waktu', $metric)
                ->whereBetween('waktu', [$startDate, $endDate])
                ->orderByDesc('id')
                ->get();

            $labels = $data->pluck('waktu')->map(fn($w) => date('Y-m-d H:i:s', strtotime($w)))->toArray();
            $values = $data->pluck($metric)->toArray();

            $dataChart[$metric] = [
                'labels' => array_reverse($labels),
                'data' => array_reverse($values),
            ];
        }

        return view('grafik', compact('startDate', 'endDate', 'dataChart', 'metrics'));
    }

    public function exportPdf(Request $request)
    {
        // Ambil tanggal dari request
        $startDate = $request->input('start_date', date('Y-m-d'));
        $endDate = $request->input('end_date', date('Y-m-d', strtotime('+1 day')));
        $metrics = ['Voltage', 'Current', 'Power', 'Energy', 'Frequency', 'PowerFactor'];
        $dataChart = [];

        foreach ($metrics as $metric) {
            $data = DataModel::select('waktu', $metric)
                ->whereBetween('waktu', [$startDate, $endDate])
                ->orderByDesc('id')
                ->get();

            $labels = $data->pluck('waktu')->map(fn($w) => date('Y-m-d H:i:s', strtotime($w)))->toArray();
            $values = $data->pluck($metric)->toArray();

            $dataChart[$metric] = [
                'labels' => array_reverse($labels),
                'data' => array_reverse($values),
            ];
        }

        // Ambil data gambar dari frontend (opsional kalau gambar canvas dipakai)
        $imageDataArray = json_decode($request->input('imageData'), true);

        // Render view ke HTML
        $htmlContent = View::make('exports.grafikpdf', compact('imageDataArray', 'startDate', 'endDate', 'dataChart', 'metrics'))->render();

        // Buat PDF
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isPhpEnabled', true);
        $options->set('defaultFont', 'Helvetica');

        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($htmlContent);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        return response($dompdf->output(), 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="Grafik-Penggunaan-Listrik.pdf"',
        ]);
    }
}
