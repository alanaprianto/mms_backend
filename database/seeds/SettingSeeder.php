<?php

use Illuminate\Database\Seeder;
use App\Form_setting;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $settings = array(
                ['name' => 'Text Area', 'description' => 'input berupa text area. biasanya untuk alamat, deskripsi, dll	', 'html_tag' => '<textarea class=form-control name=[name]>;</textarea>'],
                ['name' => 'Select Box', 'description' => 'Pilihan dalam kotak', 'html_tag' => '<select class=form-control name=[name]>;</select>'],
                ['name' => 'Options Select Box	', 'description' => 'setting untuk pilihan jawaban select box', 'html_tag' => '<option value=[value]>[answer]</option>'],
                ['name' => 'Options Radio Button', 'description' => 'Options untuk pilihan jawaban radio', 'html_tag' => '<input type=radio name=[name] value=[value]> [answer]<br>'],
                ['name' => 'Input Text', 'description' => 'input box berupa text', 'html_tag' => '<input type=text class=form-control name=[name]>;</input>'],
                ['name' => 'Radio Button', 'description' => 'Pilihan berganda', 'html_tag' => '<Radio>;</Radio>'],
                ['name' => 'Checkbox', 'description' => 'Checkbox', 'html_tag' => '<checkbox>;</checkbox>'],
                ['name' => 'Options Checkbox', 'description' => 'checkbox', 'html_tag' => '<input type=checkbox name=[name][] value=[value]> [answer]<br>'],
                ['name' => 'Input Password Text', 'description' => 'password text hidden', 'html_tag' => '<input type=password class=form-control name=[name]>;</input>'],
        );
            
        // Loop through each user above and create the record for them in the database
        foreach ($settings as $Setting)
        {
            Form_setting::create($Setting);
        }
    }
}
