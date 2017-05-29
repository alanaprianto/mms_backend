<?php

use Illuminate\Database\Seeder;
use App\Form_answer;

class AnswerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $answers = array(
                ['answer' => 'PT', 'description' => 'opsi bentuk perusahaan', 'question_id' => '1', 'options_type' => '3' ],
                ['answer' => 'CV', 'description' => 'opsi bentuk perusahaan', 'question_id' => '1', 'options_type' => '3' ],
                ['answer' => 'UD', 'description' => 'opsi bentuk perusahaan', 'question_id' => '1', 'options_type' => '3' ],
                ['answer' => 'Koperasi', 'description' => 'opsi bentuk perusahaan', 'question_id' => '1', 'options_type' => '3' ],
                ['answer' => 'Besar (PMDN/PMA/BUMN/BUMD/Swasta)', 'description' => 'opsi pertanyaan klasifikasi perusahaan', 'question_id' => '8', 'options_type' => '3' ],
                ['answer' => 'Menengah (PMDN/PMA/Swasta)', 'description' => 'opsi pertanyaan klasifikasi perusahaan', 'question_id' => '8', 'options_type' => '3' ],
                ['answer' => 'Kecil', 'description' => 'opsi pertanyaan klasifikasi perusahaan', 'question_id' => '8', 'options_type' => '3' ]
        );
            
        // Loop through each user above and create the record for them in the database
        foreach ($answers as $answer)
        {
            Form_answer::create($answer);
        }
    }
}
