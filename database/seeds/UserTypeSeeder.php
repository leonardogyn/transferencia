<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;

class UserTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_types')->updateOrInsert([
            'id' => Uuid::uuid4()->toString(),
            'name' => 'Comum',
            'flag' => 'C',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('user_types')->updateOrInsert([
            'id' => Uuid::uuid4()->toString(),
            'name' => 'Lojista',
            'flag' => 'L',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
