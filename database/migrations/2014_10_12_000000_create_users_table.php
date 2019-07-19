<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username')->nullable();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('firstname')->nullable();
            $table->string('lastname')->nullable();
            $table->string('image')->nullable();
            $table->date('dob')->nullable();
            $table->tinyInteger('gender')->default(1)->comment('1=male 2=female');
            $table->tinyInteger('relationship_status')->default(4)->comment('1=Its Complecated 2=Married 3=Open Relationship 4=Single 5=Divorced 6=Seprated 7=Widowed');
            $table->string('height')->nullable();
            $table->string('weight')->nullable();
            $table->tinyInteger('birth_control')->default(0)->comment('0=no 1=yes');
            $table->tinyInteger('role')->default(2)->comment('1=admin 2=app user');
            $table->tinyInteger('is_active')->default(1)->comment('1=active 0=inactive');
            $table->tinyInteger('is_verified')->default(0)->comment('1=verified 0=unverified');
            $table->string('verification_token')->nullable();
            $table->datetime('verify_code_validity')->nullable();
            $table->integer('profile_step')->default(0);
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
    public function down() {
        Schema::dropIfExists('users');
    }

}
