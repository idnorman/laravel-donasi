<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = Role::create(['name' => 'admin']);
        $admin->givePermissionTo([
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
        ]);

        $donatur = Role::create(['name' => 'donatur']);
        $donatur->givePermissionTo([
            'donasi-program',
            'beli-merchandise'
        ]);
    }
}
