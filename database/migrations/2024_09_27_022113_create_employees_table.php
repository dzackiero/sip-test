<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string("id_number");
            $table->string("first_name");
            $table->string("last_name");
            $table->string("phone_number");

            $table->string("position")->nullable();
            $table->string("bank_account")->nullable();
            $table->date("birth_date")->nullable();
            $table->string("email")->nullable();
            $table->string("province")->nullable();
            $table->string("city")->nullable();
            $table->string("street")->nullable();
            $table->string("zip_code")->nullable();
            $table->string("id_scan")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
