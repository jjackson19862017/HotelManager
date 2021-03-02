<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStaffTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('staff', function (Blueprint $table) {
            $table->id();
            $table->string('forename');
            $table->string('surname');
            $table->string('telephone');
            $table->string('email')->nullable();
            $table->string('ninumber')->nullable();
            $table->string('address')->nullable();
            $table->string('townCity')->nullable();
            $table->string('county')->nullable();
            $table->string('postCode')->nullable();
            $table->enum('personallicense',['Yes','No']);
            $table->enum('employmenttype',['Salary','Hourly','Temp']);
            $table->float('wage')->nullable();
            $table->foreignId('hotel_id')->constrained()->onDelete('cascade');
            $table->enum('status',['Employed','Furloughed','Unemployed','Sick']);
            $table->integer('holidaysleft')->default('0');
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
        Schema::dropIfExists('staff');
    }
}
