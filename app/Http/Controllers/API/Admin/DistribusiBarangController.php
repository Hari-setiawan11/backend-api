<?php

namespace App\Http\Controllers\API\Admin;

use Exception;
use App\Models\Distribusi;
use Illuminate\Http\Request;
use App\Models\DistribusiBarang;
use App\Http\Controllers\Controller;

class DistribusiBarangController extends Controller
{
    public function index()             
    {
        try {
            $distribusibarangs = DistribusiBarang::with('Distribusi','DataBarang')->get();
            $url = '/admin/distribusibarangs';

            return response()->json([
                'status' => 'succes',
                'message' => 'Get data distribusi barang successfull',
                'distribusibarangs' => $distribusibarangs,
                'url' => $url,
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to get distribusi barang',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function store(Request $request)
    {

        try {
            $validatedData = $request->validate([
                'distribusis_id' => 'required|exists:programs,programs_id',
                'programs_id' => 'required|exists:programs,programs_id',
            ]);

            $distribusibarangs = DistribusiBarang::create($validatedData);
            $url = '/admin/distribusibarangs';

            return response()->json([
                'status' => 'success',
                'message' => 'Add distribusi barang seccessfull',
                'distribusibarangs' => $distribusibarangs,
                'url' => $url,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to add distribusi barang',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function edit($id)
    {
        try {
            $distribusibarangs = DistribusiBarang::with('Distribusi','DataBarang')->findOrFail($id);
            $url = sprintf('/admin/distribusibarangs/edit/%d', $id);

            return response()->json([
                'status' => 'success',
                'message' => 'Get distribusi barang successful',
                'distribusibarangs' => $distribusibarangs,
                'url' => $url,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to get distribusi barang',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $distribusibarangs = DistribusiBarang::findOrfail($id);

            $validatedData = $request->validate([
                'distribusis_id' => 'required|exists:programs,programs_id',
                'programs_id' => 'required|exists:programs,programs_id',
            ]);

            $distribusibarangs->update($validatedData);
            $url = '/admin/distribusibarangs';

            return response()->json([
                'status' => 'success',
                'message' => 'Update distribusi barang seccesfull',
                'distribusibarangs' => $distribusibarangs,
                'url' => $url,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to update distribusi barang',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $distribusibarangs = DistribusiBarang::findOrFail($id);

            if ($distribusibarangs->file) {
                File::delete(public_path('file/distribusibarangs/' . $distribusibarangs->file));
            }

            $distribusibarangs->delete();
            $url = '/admin/distribusibarangs';
            
            return response()->json([
                'status' => 'seccess',
                'message' => 'distribusi barang has been removed',
                'url' => $url,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to remove distribusi barang',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}