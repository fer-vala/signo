<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_imports_detail', function (Blueprint $table) {
            $table->id();
            $table->string('file_name');
            $table->integer('total_records_in_file');
            $table->integer('records_added');
            $table->integer('records_updated');
            $table->integer('records_with_errors');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_imports_detail');
    }
};
