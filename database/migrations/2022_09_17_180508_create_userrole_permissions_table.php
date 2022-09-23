<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserrolePermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('userrole_permissions', function (Blueprint $table) {
            $table->id();
            // $table->Integer("company_id");
            $table->Integer("role_id");
            $table->Integer("permission_id");
            $table->Integer("created_by");
            $table->Integer("updated_by");
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
        Schema::dropIfExists('userrole_permissions');
    }
}
