<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permission = collect([
            'read-dashboard',
            'read-distribusi', 'create-distribusi','update-distribusi','delete-distribusi',
            'read-program', 'create-program','update-program','delete-program',
            'read-arsip', 'create-arsip','update-arsip','delete-arsip',
            'read-data-donasi', 'create-data-donasi', 'update-data-donasi', 'delete-data-donasi',
            'read-data-user',
            'read-jenis-arsip', 'create-jenis-arsip','update-jenis-arsip','delete-jenis-arsip',
            'read-data-barang', 'create-data-barang','update-data-barang','delete-data-barang',
            'read-lpj', 'create-lpj','update-lpj','delete-lpj',
            'read-kelola-konten', 'create-kelola-konten','update-kelola-konten','delete-kelola-konten',
        ]);

        $this->insertPermission($permission);
    }

    private function insertPermission(Collection $permissions, $guardName = 'web'){
        Permission::insert($permissions->map(function($permission) use ($guardName){
            return [
                'name' => $permission,
                'guard_name' => $guardName,
                'created_at' => Carbon::now()
            ];
        })->toArray());
    }
}
