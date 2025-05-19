<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('phonetic_codes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('record_id')->constrained('police_records')->onDelete('cascade');
            $table->string('field_name'); // The field this phonetic code relates to (first_name, last_name, etc.)
            $table->string('original_value');
            $table->string('phonetic_code');
            $table->string('phonetic_algorithm')->default('manual'); // manual, soundex, metaphone, etc.
            $table->timestamps();
            
            // Add index for faster searching
            $table->index('phonetic_code');
        });
    }

    public function down()
    {
        Schema::dropIfExists('phonetic_codes');
    }
};
