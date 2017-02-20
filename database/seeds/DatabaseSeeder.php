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
        $this->call(SettingSeeder::class);        
        $this->call(TypeSeeder::class);
        $this->call(RuleSeeder::class);
        $this->call(QuestionSeeder::class);
        $this->call(QuestionGroupSeeder::class);
        $this->call(AnswerSeeder::class);
    }
}
