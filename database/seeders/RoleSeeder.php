<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = Role::create([
            'name' => 'Admin',
            'guard_name' => 'web',
        ]);
        $user = Role::create([
            'name' => 'User',
            'guard_name' => 'web',
        ]);
        $admin->givePermissionTo([
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

        $user->givePermissionTo([
            'read-dashboard',
        ]);
    }
}
