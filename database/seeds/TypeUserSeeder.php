<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;

class TypeUserSeeder extends Seeder
{
    public function run()
    {
        DB::table('type_users')->updateOrInsert([
            'id' => Uuid::uuid4()->toString(),
            'name' => 'Comum',
            'flag' => 'C',
            'created_at' => Carbon::now(),
        ]);

        DB::table('type_users')->updateOrInsert([
            'id' => Uuid::uuid4()->toString(),
            'name' => 'Lojista',
            'flag' => 'L',
            'created_at' => Carbon::now(),
        ]);
    }
}
