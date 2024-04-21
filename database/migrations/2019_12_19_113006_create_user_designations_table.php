<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserDesignationsTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'user_designations';

    /**
     * Run the migrations.
     * @table user_designations
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->unsignedBigInteger('admin_users_info_id');
            $table->unsignedBigInteger('designation_id');

            $table->index(["admin_users_info_id"], 'fk_user_designations_users_info1_idx');

            $table->index(["designation_id"], 'fk_user_designations_designations1_idx');
            $table->softDeletes();
            $table->timestamps();


            $table->foreign('admin_users_info_id', 'fk_user_designations_users_info1_idx')
                ->references('id')->on('admin_user_infos')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('designation_id', 'fk_user_designations_designations1_idx')
                ->references('id')->on('designations')
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
