<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRotasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rotas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('staff_id')->constrained('staff');
            $table->date('weekcommencing');
            $table->foreignId('hotel_id')->constrained('hotels');
            $table->time('mondaystartone')->nullable();
            $table->time('mondayfinishone')->nullable();
            $table->string('mondayroleone')->nullable();
            $table->time('mondaystarttwo')->nullable();
            $table->time('mondayfinishtwo')->nullable();
            $table->string('mondayroletwo')->nullable();
            $table->time('tuesdaystartone')->nullable();
            $table->time('tuesdayfinishone')->nullable();
            $table->string('tuesdayroleone')->nullable();
            $table->time('tuesdaystarttwo')->nullable();
            $table->time('tuesdayfinishtwo')->nullable();
            $table->string('tuesdayroletwo')->nullable();
            $table->time('wednesdaystartone')->nullable();
            $table->time('wednesdayfinishone')->nullable();
            $table->string('wednesdayroleone')->nullable();
            $table->time('wednesdaystarttwo')->nullable();
            $table->time('wednesdayfinishtwo')->nullable();
            $table->string('wednesdayroletwo')->nullable();
            $table->time('thursdaystartone')->nullable();
            $table->time('thursdayfinishone')->nullable();
            $table->string('thursdayroleone')->nullable();
            $table->time('thursdaystarttwo')->nullable();
            $table->time('thursdayfinishtwo')->nullable();
            $table->string('thursdayroletwo')->nullable();
            $table->time('fridaystartone')->nullable();
            $table->time('fridayfinishone')->nullable();
            $table->string('fridayroleone')->nullable();
            $table->time('fridaystarttwo')->nullable();
            $table->time('fridayfinishtwo')->nullable();
            $table->string('fridayroletwo')->nullable();
            $table->time('saturdaystartone')->nullable();
            $table->time('saturdayfinishone')->nullable();
            $table->string('saturdayroleone')->nullable();
            $table->time('saturdaystarttwo')->nullable();
            $table->time('saturdayfinishtwo')->nullable();
            $table->string('saturdayroletwo')->nullable();
            $table->time('sundaystartone')->nullable();
            $table->time('sundayfinishone')->nullable();
            $table->string('sundayroleone')->nullable();
            $table->time('sundaystarttwo')->nullable();
            $table->time('sundayfinishtwo')->nullable();
            $table->string('sundayroletwo')->nullable();
            $table->decimal('mondayhoursone',$precision = 4, $scale = 2)->nullable();
            $table->decimal('mondayhourstwo',$precision = 4, $scale = 2)->nullable();
            $table->decimal('tuesdayhoursone',$precision = 4, $scale = 2)->nullable();
            $table->decimal('tuesdayhourstwo',$precision = 4, $scale = 2)->nullable();
            $table->decimal('wednesdayhoursone',$precision = 4, $scale = 2)->nullable();
            $table->decimal('wednesdayhourstwo',$precision = 4, $scale = 2)->nullable();
            $table->decimal('thursdayhoursone',$precision = 4, $scale = 2)->nullable();
            $table->decimal('thursdayhourstwo',$precision = 4, $scale = 2)->nullable();
            $table->decimal('fridayhoursone',$precision = 4, $scale = 2)->nullable();
            $table->decimal('fridayhourstwo',$precision = 4, $scale = 2)->nullable();
            $table->decimal('saturdayhoursone',$precision = 4, $scale = 2)->nullable();
            $table->decimal('saturdayhourstwo',$precision = 4, $scale = 2)->nullable();
            $table->decimal('sundayhoursone',$precision = 4, $scale = 2)->nullable();
            $table->decimal('sundayhourstwo',$precision = 4, $scale = 2)->nullable();
            $table->decimal('totalhours',$precision = 4, $scale = 2)->nullable();
            // Sick Days Taken
            $table->integer('sickdays')->nullable()->unsigned()->default(0);
            // Holiday Days Taken
            $table->integer('holidaydays')->nullable()->unsigned()->default(0);
            // Job Scheme
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
        Schema::dropIfExists('rotas');
    }
}
