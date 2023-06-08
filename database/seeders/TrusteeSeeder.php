<?php

namespace Database\Seeders;

use App\Models\Trustee;
use Illuminate\Database\Seeder;

class TrusteeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Trustee::factrory(1)->create();
    }
}
