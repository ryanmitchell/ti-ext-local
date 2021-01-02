<?php

namespace Igniter\Local\Database\Migrations;

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Schema;

/**
 * Add last_location_area column to customer table
 */
class AddLastLocationAreaCustomersTable extends Migration
{
    public function up()
    {
        Schema::table('customers', function (Blueprint $table) {
            $table->text('last_location_area');
        });
    }

    public function down()
    {
        Schema::table('customers', function (Blueprint $table) {
            $table->dropColumn('last_location_area');
        });
    }
}
