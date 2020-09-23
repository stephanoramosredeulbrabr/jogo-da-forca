<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;

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
        User::factory()->create([
            'email' => 'admin@rede.ulbra.br',
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
