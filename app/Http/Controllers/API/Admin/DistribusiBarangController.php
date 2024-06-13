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
            // Validasi data yang diterima
            $validatedData = $request->validate([
                'distribusis_id' => 'required|exists:distribusis,id',
                'nama_barang' => 'required',
                'volume' => 'required|numeric',
                'satuan' => 'required|in:nota,kuitansi', // Validasi khusus untuk field satuan
                'harga_satuan' => 'required|numeric',
            ]);

            // Hitung nilai untuk field "jumlah"
            $volume = floatval($validatedData['volume']);
            $harga_satuan = floatval($validatedData['harga_satuan']);
            $jumlah = $volume * $harga_satuan;

            // Tambahkan nilai "jumlah" ke dalam data yang divalidasi
            $validatedData['jumlah'] = $jumlah;

            // Ambil field anggaran dari tabel distribusi
            $distribusi = Distribusi::findOrFail($validatedData['distribusis_id']);
            $anggaran = floatval($distribusi->anggaran);

            // Periksa apakah total jumlah melebihi anggaran
            $totalJumlahDistribusiBarang = DistribusiBarang::where('distribusis_id', $validatedData['distribusis_id'])->sum('jumlah');
            if ($totalJumlahDistribusiBarang + $jumlah > $anggaran) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Total Harga Barang Melebihi Pengeluaran Yang Tertulis'
                ], 400);
            }

            // Simpan data distribusi barang ke database
            $distribusibarangs = DistribusiBarang::create($validatedData);
            $url = '/admin/distribusibarangs';

            return response()->json([
                'status' => 'success',
                'message' => 'Add distribusi barang successful',
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