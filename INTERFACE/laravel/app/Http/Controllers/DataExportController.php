<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataModel;
use Dompdf\Dompdf;
use Dompdf\Options;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\DataExport;

class DataExportController extends Controller
{
    public function export(Request $request)
    {
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'export_type' => 'required|in:pdf,excel',
        ]);

        $data = DataModel::whereBetween('waktu', [$request->start_date, $request->end_date])->get();

        if ($request->export_type == 'pdf') {
            $options = new Options();
            $options->set('defaultFont', 'Helvetica');
        
            $dompdf = new Dompdf($options);
            $html = view('exports.pdf', compact('data'))->render();
        
            $dompdf->loadHtml($html);
            $dompdf->setPaper('A4', 'landscape');
            $dompdf->render();
        
            return response($dompdf->output(), 200)
                ->header('Content-Type', 'application/pdf')
                ->header('Content-Disposition', 'attachment; filename="Data-Penggunaan-Listrik.pdf"');
        } elseif ($request->export_type == 'excel') {
            return Excel::download(new DataExport($data), 'Data-Penggunaan-Listrik.xlsx');
        }
    }
}

