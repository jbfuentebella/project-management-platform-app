<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->bigIncrements('id')->nullable(false)
                ->unsigned()
                ->autoIncrement();
            $table->string('name')->nullable(false);
            $table->string('client_name')->nullable(false);
            $table->unsignedBigInteger('lead_developer_id')->nullable(false);
            $table->timestamps();

            $table->foreign('lead_developer_id')->references('id')->on('developers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('projects');
    }
}
