<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class EnsureAdminUser extends Command
{
    protected $signature = 'admin:ensure';
    protected $description = 'Ensure admin user exists with correct password';

    public function handle(): void
    {
        $email    = env('ADMIN_EMAIL', 'sertac@hotmail.com');
        $password = env('ADMIN_PASSWORD', 'changeme');
        $hash     = Hash::make($password);
        $now      = now();

        $exists = DB::table('users')->where('email', $email)->exists();

        if ($exists) {
            DB::table('users')->where('email', $email)->update([
                'password'           => $hash,
                'email_verified_at'  => $now,
                'updated_at'         => $now,
            ]);
            $this->info("Admin updated: {$email}");
        } else {
            DB::table('users')->insert([
                'name'               => 'Sertaç Apanay',
                'email'              => $email,
                'password'           => $hash,
                'email_verified_at'  => $now,
                'created_at'         => $now,
                'updated_at'         => $now,
            ]);
            $this->info("Admin created: {$email}");
        }

        // Verify hash in DB matches password
        $stored = DB::table('users')->where('email', $email)->value('password');
        $ok = Hash::check($password, $stored);
        $this->info('Password check: ' . ($ok ? 'OK ✓' : 'FAILED ✗'));
        $this->info('Stored hash prefix: ' . substr($stored, 0, 7));
    }
}
