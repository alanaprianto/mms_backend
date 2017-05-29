<?php

use Illuminate\Database\Seeder;
use App\Form_rules;

class RuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ruless = array(
        		['name' => 'Required', 'parameter' => 'required', 'description' => 'Pertanyaan ini harus diisi'],
                ['name' => 'Confirmed', 'parameter' => 'confirmed', 'description' => 'Field dengan validasi ini harus memiliki field yang menyerupai foo_conifrmation. Contoh, jika field validasi adalah password, maka harus ada field dalam input yang menyerupai password_confirmation.'],
                ['name' => 'Minimum 5', 'parameter' => 'min:5', 'description' => 'text minimal 5 karakter'],
                ['name' => 'Minimum 3', 'parameter' => 'min:3', 'description' => 'text minimal 3 karakter'],                
                ['name' => 'Unique Email', 'parameter' => 'unique:users,email', 'description' => 'Rules ini hanya berlaku untuk tipe pertanyaan email, Rules ini memastikan email yang diisikan untuk user selalu unique.'],
                ['name' => 'Unique Username', 'parameter' => 'unique:users,username', 'description' => '	Rules ini hanya berlaku untuk tipe pertanyaan username, Rules ini memastikan username yang diisikan untuk user selalu unique.']
        );
            
        // Loop through each user above and create the record for them in the database
        foreach ($ruless as $rules)
        {
            Form_rules::create($rules);
        }
    }
}
