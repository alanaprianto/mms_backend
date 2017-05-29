<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(AnswerSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(pjabatan_seeder1::class);
        $this->call(QuestionGroupSeeder::class);
        $this->call(QuestionSeeder::class);
        $this->call(RuleSeeder::class);
        $this->call(SettingSeeder::class);    
        $this->call(TypeSeeder::class);
    }
}
