<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $modoRole = Role::firstOrCreate(['name' => 'modo']);
        $userRole = Role::firstOrCreate(['name' => 'user']);
        
        $mail = 'enzo@gmail.com';

        $modo = User::where('email', $mail)->first();
        if (!$modo) {
            $modo = User::create([
                'name' => 'Modo',
                'email' => $mail,
                'password' => Hash::make('aze'),
            ]);
            $modo->assignRole($modoRole);
        }

        User::where('email', '!=', $mail)->each(function ($user) use ($userRole) {
            $user->assignRole('user');
        });
    }
}
