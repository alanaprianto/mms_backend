<?php

use Illuminate\Database\Seeder;

class pjabatan_seeder1 extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $jabatans = array(
            ['title' => 'Pengurus Lengkap', 'short_title' => 'p_lengkap', 'parent' => '0', 'description' => 'Pengurus Lengkap', 'status' => 'parent'],
            ['title' => 'Pengurus Harian Lengkap', 'short_title' => 'p_h_lengkap', 'parent' => '1', 'description' => 'Pengurus Harian Lengkap', 'status' => 'parent'],
            ['title' => 'Pengurus Harian', 'short_title' => 'p_harian', 'parent' => '2', 'description' => 'Pengurus Harian', 'status' => 'parent'],
            ['title' => 'Dewan Pertimbangan', 'short_title' => 'd_pertimbangan', 'parent' => '0', 'description' => 'Dewan Pertimbangan', 'status' => 'parent'],
            ['title' => 'Dewan Penasehat', 'short_title' => 'd_penasehat', 'parent' => '0', 'description' => 'Dewan Penasehat', 'status' => 'parent'],
        );

        // Loop through each user above and create the record for them in the database
        foreach ($jabatans as $jabatan)
        {
            \App\Pjabatan::create($jabatan);
        }
    }
}
