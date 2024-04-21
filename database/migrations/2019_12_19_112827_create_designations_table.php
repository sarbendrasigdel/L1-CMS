<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDesignationsTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'designations';

    /**
     * Run the migrations.
     * @table designations
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->string('name', 60);
            $table->tinyInteger('active_status')->default('1');
            $table->tinyInteger('is_editable')->default('1');
            $table->unsignedBigInteger('created_by_admin_users_info_id');
            $table->unsignedBigInteger('updated_by_admin_users_info_id')->nullable();
            $table->unsignedBigInteger('deleted_by_admin_users_info_id')->nullable();

            $table->index(["deleted_by_admin_users_info_id"], 'fk_designations_users_info3_idx');

            $table->index(["updated_by_admin_users_info_id"], 'fk_designations_users_info2_idx');

            $table->index(["created_by_admin_users_info_id"], 'fk_designations_users_info1_idx');

            $table->unique(["name"], 'name_UNIQUE');
            $table->softDeletes();
            $table->timestamps();


            $table->foreign('created_by_admin_users_info_id', 'fk_designations_users_info1_idx')
                ->references('id')->on('admin_user_infos')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('updated_by_admin_users_info_id', 'fk_designations_users_info2_idx')
                ->references('id')->on('admin_user_infos')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('deleted_by_admin_users_info_id', 'fk_designations_users_info3_idx')
                ->references('id')->on('admin_user_infos')
                ->onDelete('cascade')
                ->onUpdate('cascade');
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
