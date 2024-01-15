<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\IOFactory;

class ExcelController extends Controller
{
    //
    public function uploadExcel(Request $request)
    {
        if ($request->hasFile('fileupload')) {
            $path = $request->file('fileupload')->getRealPath();

            $spreadsheet = IOFactory::load($path);
            $sheetNames = $spreadsheet->getSheetNames();

            // Làm gì đó với $sheetNames
            return response()->json($sheetNames);
        }

        return response()->json(['error' => 'No file uploaded'], 400);
    }
}
