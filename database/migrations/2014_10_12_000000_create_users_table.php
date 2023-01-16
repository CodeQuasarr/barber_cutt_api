<?php

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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class, 'manager_id')->nullable(true);
            $table->string('first_name');
            $table->string('last_name');
            $table->string('name')->unique();
            $table->boolean('sexe');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable(true);
            $table->string('password');
            $table->date('birthday')->nullable(true);
            $table->string('nationality')->nullable(true);
            $table->date('contract_start_date')->nullable(true);
            $table->string('address_num')->nullable(true);
            $table->string('postal_code')->nullable(true);
            $table->string('address')->nullable(true);
            $table->string('phone')->nullable(true);
            $table->boolean('is_off')->nullable(true);
            $table->boolean('on_leave')->nullable(true);
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
};
