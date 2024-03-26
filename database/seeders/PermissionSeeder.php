<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'tambah-user',
            'edit-user',
            'lihat-user',
            'hapus-user',
            'tambah-artikel',
            'edit-artikel',
            'lihat-artikel',
            'hapus-artikel',
            'tambah-program',
            'edit-program',
            'lihat-program',
            'hapus-program',
            'tambah-kegiatan-program',
            'edit-kegiatan-program',
            'lihat-kegiatan-program',
            'hapus-kegiatan-program',
            'tambah-merchandise',
            'edit-merchandise',
            'lihat-merchandise',
            'hapus-merchandise',

            'donasi-program',
            'beli-merchandise'
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
