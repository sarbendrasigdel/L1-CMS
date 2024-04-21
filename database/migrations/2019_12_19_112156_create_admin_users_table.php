<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminUsersTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'admin_users';

    /**
     * Run the migrations.
     * @table admin_users
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->string('username', 50);
            $table->string('password', 191);
            $table->string('remember_token', 200)->nullable();
            $table->text('push_notification_token')->nullable();
            $table->tinyInteger('active_status')->default('1');
            $table->tinyInteger('is_super_admin')->nullable()->default('0');
            $table->tinyInteger('changed_password')->nullable()->default('0');

            $table->unique(["username"], 'username_UNIQUE');
            $table->softDeletes();
            $table->nullableTimestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
     public function down()
     {
       Schema::dropIfExists($this->tableName);
     }
}
