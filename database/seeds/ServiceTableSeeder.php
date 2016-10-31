<?php

use Illuminate\Database\Seeder;

class ServiceTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('service')->delete();
        
        \DB::table('service')->insert(array (
            0 => 
            array (
                'id' => 1,
                'title' => '置顶',
                'description' => '将你的任务直接置顶5小时',
                'price' => '50',
                'created_at' => '2016-03-17 17:35:42',
                'updated_at' => '2016-05-27 11:38:23',
                'status' => 1,
            ),
            1 => 
            array (
                'id' => 2,
                'title' => '加急',
                'description' => '大家好附件都是封建时代回复',
                'price' => '501',
                'created_at' => NULL,
                'updated_at' => '2016-05-25 13:46:37',
                'status' => 1,
            ),
        ));
        
        
    }
}
