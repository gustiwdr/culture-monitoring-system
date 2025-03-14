<?php

namespace Database\Seeders;

use App\Models\Division;
use Illuminate\Database\Seeder;

class DivisionSeeder extends Seeder
{
  public function run()
  {
    $divisions = [
      ['name' => 'Human Capital', 'description' => 'HR and people management'],
      ['name' => 'IT Development', 'description' => 'Software development and IT infrastructure'],
      ['name' => 'Marketing', 'description' => 'Marketing and communications'],
      ['name' => 'Finance', 'description' => 'Financial management'],
      ['name' => 'Operations', 'description' => 'Day-to-day operations'],
    ];

    foreach ($divisions as $division) {
      Division::create($division);
    }
  }
}
