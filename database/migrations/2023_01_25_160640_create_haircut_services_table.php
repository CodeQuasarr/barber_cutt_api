<?php

use App\Models\Category;
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
        Schema::create('haircut_services', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description')->nullable(true);
            // category_id is a foreign key to the categories table
            $table->foreignId('haircut_service_category_id')->constrained('categories');
            $table->integer('price');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('haircut_services');
    }
};
