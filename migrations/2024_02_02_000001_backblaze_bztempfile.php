<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Capsule\Manager as Capsule;

class BackblazeBztempfile extends Migration
{
    private $tableName = 'backblaze';

    public function up()
    {
        $capsule = new Capsule();
        
        $capsule::schema()->table($this->tableName, function (Blueprint $table) {
            $table->string('bztempfile_size')->nullable();

            $table->index('bztempfile_size');
        });
    }

    public function down()
    {
        $capsule = new Capsule();
        $capsule::schema()->table($this->tableName, function (Blueprint $table) {
            $table->dropColumn('bztempfile_size');
        });
    }
}
