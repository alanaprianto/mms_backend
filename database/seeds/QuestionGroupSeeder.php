<?php

use Illuminate\Database\Seeder;
use App\Form_question_group;

class QuestionGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $question_groups = array(
                ['name' => 'Pendaftaran', 'description' => 'Form berisi Pendaftaran', ]
                ['name' => 'Isian Langsung', 'description' => 'Pertanyaan yang langsung diisi oleh text dari user', ]
                ['name' => 'Laravel', 'description' => 'Group for Laravel typed question', ]
                ['name' => 'Percobaan', 'description' => 'Percobaan Developer', ]
        );
            
        // Loop through each user above and create the record for them in the database
        foreach ($question_groups as $question_group)
        {
            Form_question_group::create($question_group);
        }
    }
}
