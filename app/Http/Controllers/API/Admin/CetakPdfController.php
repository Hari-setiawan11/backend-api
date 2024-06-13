<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CetakPdfController extends Controller
{
    public function cetakPDF($id)
    {
        try {
            // Find the distribusi record by ID
            $distribusis = Distribusi::findOrFail($id);
    
            // Generate the PDF
            $pdf = \PDF::loadView('pdf.distribusi', compact('distribusis'));
    
            // Save the PDF file
            $pdfPath = public_path('file/distribusi/') . uniqid('distribusi_') . '.pdf';
            $pdf->save($pdfPath);
    
            // Respond with success and PDF URL
            return response()->json([
                'status' => 'success',
                'message' => 'PDF generated successfully',
                'pdf_url' => url('file/distribusi/' . basename($pdfPath)),
            ]);
        } catch (\Exception $e) {
            // Handle errors
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to generate PDF',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
