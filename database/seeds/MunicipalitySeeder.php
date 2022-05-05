<?php

use App\MunicipalityModel;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MunicipalitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('bulacanmunicipalbarangay')->delete();

        $users = [
            [
                'municipalName' => 'angat',
                'barangayName' => 'banaban',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'municipalName' => 'angat',
                'barangayName' => 'baybay',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'municipalName' => 'angat',
                'barangayName' => 'binagbag',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'municipalName' => 'angat',
                'barangayName' => 'donacion',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'municipalName' => 'angat',
                'barangayName' => 'encanto',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'municipalName' => 'angat',
                'barangayName' => 'laog',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'municipalName' => 'angat',
                'barangayName' => 'marungko',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'municipalName' => 'angat',
                'barangayName' => 'niugan',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'municipalName' => 'angat',
                'barangayName' => 'paltok',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'municipalName' => 'angat',
                'barangayName' => 'pulong yantok',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'municipalName' => 'angat',
                'barangayName' => 'san roque',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'municipalName' => 'angat',
                'barangayName' => 'santa cruz',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'municipalName' => 'angat',
                'barangayName' => 'santa lucia',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'municipalName' => 'angat',
                'barangayName' => 'santo cristo',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'municipalName' => 'angat',
                'barangayName' => 'salucan',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'municipalName' => 'angat',
                'barangayName' => 'taboc',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'municipalName' => 'balagtas',
                'barangayName' => 'borol 1st',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'municipalName' => 'balagtas',
                'barangayName' => 'borol 2nd',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'municipalName' => 'balagtas',
                'barangayName' => 'dalig',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'municipalName' => 'balagtas',
                'barangayName' => 'panginay',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'municipalName' => 'balagtas',
                'barangayName' => 'pulong gubat',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'municipalName' => 'balagtas',
                'barangayName' => 'san juan',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'municipalName' => 'balagtas',
                'barangayName' => 'santol',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'municipalName' => 'balagtas',
                'barangayName' => 'Wawa',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],

        ];

        MunicipalityModel::insert($users);

        //     if(DB::table('municipality')->count() == 0){
        //     DB::table('municipality')->insert(
        //         [
        //             'municipalName' => 'angat',
        //             'created_at' => date('Y-m-d H:i:s'),
        //             'updated_at' => date('Y-m-d H:i:s'),
        //         ],
        //         [
        //             'municipalName' => 'angat2',
        //             'created_at' => date('Y-m-d H:i:s'),
        //             'updated_at' => date('Y-m-d H:i:s'),
        //         ]
        //     );
        // }else { echo "\e[31mTable is not empty, therefore NOT "; }
        //  DB::table('municipality')->insert([    
        //     'municipalName' => '',  
        //  ]); 
        //  DB::table('municipality')->insert([    
        //     'municipalName' => '',  
        //  ]); 
        //  DB::table('municipality')->insert([    
        //     'municipalName' => '',  
        //  ]); 
        //  DB::table('municipality')->insert([    
        //     'municipalName' => 'bulakan',  
        //  ]); 
        //  DB::table('municipality')->insert([    
        //     'municipalName' => 'bustos',  
        //  ]); 
        //  DB::table('municipality')->insert([    
        //     'municipalName' => 'calumpit',  
        //  ]); 
        //  DB::table('municipality')->insert([    
        //     'municipalName' => 'drt',  
        //  ]); 
        //  DB::table('municipality')->insert([    
        //     'municipalName' => 'guiguinto',  
        //  ]); 
        //  DB::table('municipality')->insert([    
        //     'municipalName' => 'hagonoy',  
        //  ]); 
        //  DB::table('municipality')->insert([    
        //     'municipalName' => 'malolos',  
        //  ]); 
        //  DB::table('municipality')->insert([    
        //     'municipalName' => 'marilao',  
        //  ]); 
        //  DB::table('municipality')->insert([    
        //     'municipalName' => 'meycauayan',  
        //  ]); 
        //  DB::table('municipality')->insert([    
        //     'municipalName' => 'norzagaray',  
        //  ]); 
        //  DB::table('municipality')->insert([    
        //     'municipalName' => 'obando',  
        //  ]); 
        //  DB::table('municipality')->insert([    
        //     'municipalName' => 'pandi',  
        //  ]); 
        //  DB::table('municipality')->insert([    
        //     'municipalName' => 'paombong',  
        //  ]); 
        //  DB::table('municipality')->insert([    
        //     'municipalName' => 'plaridel',  
        //  ]); 
        //  DB::table('municipality')->insert([    
        //     'municipalName' => 'pulilan',  
        //  ]); 
        //  DB::table('municipality')->insert([    
        //     'municipalName' => 'san ildefonso',  
        //  ]); 
        //  DB::table('municipality')->insert([    
        //     'municipalName' => 'san jose del monte',  
        //  ]); 
        //  DB::table('municipality')->insert([    
        //     'municipalName' => 'san miguel',  
        //  ]); 
        //  DB::table('municipality')->insert([    
        //     'municipalName' => 'san rafael',  
        //  ]); 
        //  DB::table('municipality')->insert([    
        //     'municipalName' => 'santa maria',  
        //  ]); 

    }
}
