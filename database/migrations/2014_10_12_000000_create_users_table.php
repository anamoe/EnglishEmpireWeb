<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->string('nick_name');
            $table->string('id_number');
            $table->string('role');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('foto_profil')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        User::create([
            'full_name' =>'Anan Anam',
            'nick_name'=>'Anan',
            'id_number'=>'220303',
            'password'=>bcrypt(123),
            'role'=>'student'
        ]);

        User::create([
            'full_name' =>'Admin Dana',
            'nick_name'=>'Dana',
            'id_number'=>'220304',
            'password'=>bcrypt(123),
            'role'=>'admin'
        ]);

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
