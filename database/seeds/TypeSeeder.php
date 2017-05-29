<?php

use Illuminate\Database\Seeder;
use App\Form_type;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = array(
                ['name' => 'Question', 'description' => '', 'html_tag' => ''],
                ['name' => 'Divider', 'description' => 'divider, without title', 'html_tag' => '<p class=bg-primary style=padding:6px;></p>'],
                ['name' => 'Divider Title', 'description' => 'Question Divider, with title', 'html_tag' => '<p class=bg-primary style=padding:6px;><strong>[divider]</strong></p>'],
                ['name' => 'Username', 'description' => '', 'html_tag' => '<input type=text class=form-control name=username>;</input>'],
                ['name' => 'Password', 'description' => '', 'html_tag' => '<input type=password class=form-control name=password>;</input>'],
                ['name' => 'Confirm Password', 'description' => '', 'html_tag' => '<input type=password class=form-control name=password_confirmation>;</input>'],              
                ['name' => 'Name', 'description' => 'field untuk mengisi tabel user:name', 'html_tag' => '<input type=text class=form-control name=name>;</input>'],
                ['name' => 'Email', 'description' => 'field untuk mengisi tabel users:email', 'html_tag' => '<input type=text class=form-control name=email>;</input>']
        );
            
        // Loop through each user above and create the record for them in the database
        foreach ($types as $type)
        {
            Form_type::create($type);
        }
    }
}
