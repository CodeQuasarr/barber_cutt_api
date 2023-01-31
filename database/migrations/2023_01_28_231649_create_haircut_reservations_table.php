<?php

use App\Models\HaircutService;
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
            $table->foreignIdFor(HaircutService::class);
            $table->foreignIdFor(User::class);
            $table->string('haircut_reservation_time');
            $table->date('haircut_reservation_start_date');
            $table->boolean('haircut_reservation_status');
//            $table->string('haircut_service_end_date');
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
