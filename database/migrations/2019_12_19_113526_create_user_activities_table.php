<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserActivitiesTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'user_activities';

    /**
     * Run the migrations.
     * @table user_activities
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->bigInteger('model_id');
            $table->string('model_type', 100);
            $table->string('action', 20);
            $table->text('description');
            $table->text('content')->nullable();
            $table->unsignedBigInteger('admin_users_info_id');
            $table->string('ip_address', 100)->nullable();

            $table->index(["admin_users_info_id"], 'fk_user_activities_users_info1_idx');
            $table->timestamps();


            $table->foreign('admin_users_info_id', 'fk_user_activities_users_info1_idx')
                ->references('id')->on('admin_user_infos')
                ->onDelete('no action')
                ->onUpdate('no action');
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
