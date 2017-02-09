<?php

use Illuminate\Database\Seeder;
use App\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {        
        $seeds = array(
        		['parent_id' => '0', 'main_img' => 'barang', 'title' => 'Barang', 'description' => 'Produk berupa Barang', 'status' => 'parent'],
        		['parent_id' => '0', 'main_img' => 'jasa', 'title' => 'Jasa', 'description' => 'Produk berupa Jasa', 'status' => 'parent'],
        		['parent_id' => '1', 'main_img' => 'barang_mobil', 'title' => 'Mobil', 'description' => 'Kendaraan Roda 4', 'status' => 'on'],
        		['parent_id' => '1', 'main_img' => 'barang_motor', 'title' => 'Motor', 'description' => 'Kendaraan Roda 2', 'status' => 'on'],
        		['parent_id' => '1', 'main_img' => 'barang_properti', 'title' => 'Properti', 'description' => 'Tanah, Rumah, Apartment, dll', 'status' => 'on'],
        		['parent_id' => '1', 'main_img' => 'barang_keppribadi', 'title' => 'Keperluan Pribadi', 'description' => 'Barang Keperluan Pribadi', 'status' => 'on'],
        		['parent_id' => '1', 'main_img' => 'barang_elektronik', 'title' => 'Elektronik & Gadget', 'description' => 'Barang Elektronik & Gadget', 'status' => 'on'],
        		['parent_id' => '1', 'main_img' => 'barang_hobi', 'title' => 'Hobi & Olahraga', 'description' => 'Barang Hobi & Olahraga', 'status' => 'on'],
        		['parent_id' => '1', 'main_img' => 'barang_rtangga', 'title' => 'Rumah Tangga', 'description' => 'Barang Rumah Tangga', 'status' => 'on'],        		
        		['parent_id' => '1', 'main_img' => 'barang_bayianak', 'title' => 'Perlengkapan Bayi & Anak', 'description' => 'Barang Perlengkapan Bayi dan Anak', 'status' => 'on'],
        		['parent_id' => '1', 'main_img' => 'barang_kantorindustri', 'title' => 'Kantor & Industri', 'description' => 'Barang Kantor & Industri', 'status' => 'on'],
        		['parent_id' => '2', 'main_img' => 'jasa_', 'title' => 'Jasa', 'description' => 'Produk Berupa Jasa', 'status' => 'on'],
        		['parent_id' => '2', 'main_img' => 'jasa_loker', 'title' => 'Lowongan Kerja', 'description' => 'Iklan Lowongan Kerja', 'status' => 'on'],
        	);

        foreach ($seeds as $seed)
        {
            Category::create($seed);
        }
    }
}
