<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Str;

/**
 * Class InsertAdminUser
 */
class InsertAdminUser extends Migration
{
    /**
     * @return void
     */
    public function up(): void
    {
        User::query()->create([
            'name' => 'Administrador',
            'email' => 'admin@rede.ulbra.br',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ]);
    }

    /**
     * @return void
     */
    public function down(): void
    {
        User::query()->where('email', 'admin@rede.ulbra.br')->forceDelete();
    }
}
