<?php

namespace App\Http\Controllers\API\Admin;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DataDonasiController extends Controller
{
    public function index()
    {
        try {
            $users = User::role('user')->get();

            $url = '/admin/user';

            return response()->json([
                'status' => 'succes',
                'message' => 'Get data user successfull',
                'user' => $users,
                'url' => $url,
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to get user',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $datadonasis = User::findOrFail($id);

            $datadonasis->delete();
            $url = '/admin/datadonasi';
            
            return response()->json([
                'status' => 'seccess',
                'message' => 'data donasi has been removed',
                'url' => $url,
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to remove data donasi',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
