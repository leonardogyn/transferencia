<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;

class TypeTransferSeeder extends Seeder
{
    public function run()
    {
        DB::table('type_transfers')->updateOrInsert([
            'id' => Uuid::uuid4()->toString(),
            'name' => 'Debitar',
            'flag' => 'D',
            'created_at' => Carbon::now(),
        ]);

        DB::table('type_transfers')->updateOrInsert([
            'id' => Uuid::uuid4()->toString(),
            'name' => 'Creditar',
            'flag' => 'C',
            'created_at' => Carbon::now(),
        ]);
    }
}
