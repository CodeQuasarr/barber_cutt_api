<?php

use App\Models\Haircuts\Haircut;
use App\Models\User;
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
        Schema::create('haircut_reservations', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Haircut::class);
            $table->foreignIdFor(User::class);
            $table->date('start_date');
            $table->string('start_time');
            $table->string('status')->default('pending');
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
        Schema::dropIfExists('haircut_reservations');
    }
};
