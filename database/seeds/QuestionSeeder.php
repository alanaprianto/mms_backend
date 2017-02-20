<?php

use Illuminate\Database\Seeder;
use App\Form_question;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $questions = array(
                ['question' => 'Bentuk Perusahaan', 'group_question' => '1', 'answer_type' => '2', 'description' => 'Contoh Pertanyaan', 'order' => '1', 'rules' => '1', 'type' => '1', ]
				['question' => 'No Kontak Penanggung Jawab', 'group_question' => '1', 'answer_type' => '5', 'description' => 'contoh edited', 'order' => '6', 'rules' => '', 'type' => '1', ]
				['question' => 'Email Penanggung Jawab', 'group_question' => '1', 'answer_type' => '5', 'description' => 'Contoh pertanyaan no 3', 'order' => '7', 'rules' => '1, 5', 'type' => '8', ]
				['question' => 'Nama Penanggung Jawab', 'group_question' => '1', 'answer_type' => '5', 'description' => '', 'order' => '5', 'rules' => '1', 'type' => '7', ]
				['question' => 'NPWP Perusahaan', 'group_question' => '1', 'answer_type' => '5', 'description' => 'npwp perusahaan', 'order' => '4', 'rules' => '', 'type' => '1', ]
				['question' => 'Pertanyaan no 6', 'group_question' => '2', 'answer_type' => '6', 'description' => '', 'order' => '0', 'rules' => '', 'type' => '1', ]
				['question' => 'Nama Perusahaan', 'group_question' => '1', 'answer_type' => '2', 'description' => '', 'order' => '2', 'rules' => '', 'type' => '1', ]
				['question' => 'Klasifikasi Perusahaan', 'group_question' => '1', 'answer_type' => '2', 'description' => 'klasifikasi (Besar, Sedang, Kecil)', 'order' => '3', 'rules' => '', 'type' => '1', ]
				['question' => 'Alamat Perusahaan', 'group_question' => '1', 'answer_type' => '1', 'description' => 'alamat', 'order' => '8', 'rules' => '1', 'type' => '1', ]
				['question' => 'Username', 'group_question' => '1', 'answer_type' => '5', 'description' => '', 'order' => '10', 'rules' => '1, 6', 'type' => '4', ]
				['question' => 'Password', 'group_question' => '1', 'answer_type' => '9', 'description' => '', 'order' => '11', 'rules' => '2, 1', 'type' => '5', ]
				['question' => 'Confirm Password', 'group_question' => '1', 'answer_type' => '9', 'description' => '', 'order' => '12', 'rules' => '1', 'type' => '6', ]
				['question' => 'Perusahaan / Koperasi', 'group_question' => '1', 'answer_type' => '3', 'description' => '', 'order' => '0', 'rules' => '', 'type' => '3', ]
				['question' => 'Keterangan Account', 'group_question' => '1', 'answer_type' => '3', 'description' => '', 'order' => '9', 'rules' => '', 'type' => '3', ]
        );
            
        // Loop through each user above and create the record for them in the database
        foreach ($questions as $question)
        {
            Form_question::create($question);
        }
    }
}
