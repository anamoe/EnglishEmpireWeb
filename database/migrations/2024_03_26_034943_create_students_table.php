<?php

use App\Models\Student;
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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('course_program_id')->constrained();
            $table->string('school');
            $table->string('date_birth');
            $table->string('no_hp');
     
            $table->timestamps();
        });

        Student::create([
            'user_id'=>1,
            'course_program_id'=>1,
            'school' =>'MI Al Ishlah',
            'date_birth'=>'2014-09-02',
            'no_hp'=>'08217531'
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
