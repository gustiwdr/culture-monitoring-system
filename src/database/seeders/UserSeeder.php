<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
  public function run()
  {
    // Admin HC
    User::create([
      'name' => 'Admin HC',
      'email' => 'admin@company.com',
      'password' => 'password',
      'role' => 'admin_hc',
      'division_id' => 1,
    ]);

    // Division Heads
    $divisions = [1, 2, 3, 4, 5];
    foreach ($divisions as $div_id) {
      User::create([
        'name' => 'Division Head ' . $div_id,
        'email' => 'head' . $div_id . '@company.com',
        'password' => 'password',
        'role' => 'division_head',
        'division_id' => $div_id,
      ]);
    }

    // Culture Agents
    foreach ($divisions as $div_id) {
      User::create([
        'name' => 'Culture Agent ' . $div_id,
        'email' => 'agent' . $div_id . '@company.com',
        'password' => 'password',
        'role' => 'culture_agent',
        'division_id' => $div_id,
      ]);
    }
  }
}
