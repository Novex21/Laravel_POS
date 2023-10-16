<?php

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
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('company_name')->default('Demo Company');
            $table->string('company_address')->default('Demo Company address');
            $table->string('company_phone')->default('+959-250-146-905');
            $table->string('company_email')->default('democompany123@laravel.gm');
            $table->string('company_fax')->default('+959-250-146-905');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
