<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminUserInfosTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'admin_user_infos';

    /**
     * Run the migrations.
     * @table admin_user_infos
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->unsignedBigInteger('admin_user_id');
            $table->string('full_name', 100);
            $table->string('email', 150);
            $table->string('phone_number', 20);
            $table->string('address', 100)->nullable();
            $table->unsignedBigInteger('user_created_by_users_info_id')->nullable();
            $table->unsignedBigInteger('user_updated_by_users_info_id')->nullable();
            $table->unsignedBigInteger('user_deleted_by_users_info_id')->nullable();

            $table->index(["user_created_by_users_info_id"], 'fk_users_info_users_info1_idx');

            $table->index(["user_updated_by_users_info_id"], 'fk_users_info_users_info2_idx');

            $table->index(["user_deleted_by_users_info_id"], 'fk_users_info_users_info3_idx');


            $table->index(["admin_user_id"], 'fk_users_info_users1_idx');

//            $table->unique(["email"], 'email_UNIQUE');
            $table->softDeletes();
            $table->timestamps();


            $table->foreign('admin_user_id', 'fk_users_info_users1_idx')
                ->references('id')->on('admin_users')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('user_created_by_users_info_id', 'fk_users_info_users_info1_idx')
                ->references('id')->on('admin_user_infos')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('user_updated_by_users_info_id', 'fk_users_info_users_info2_idx')
                ->references('id')->on('admin_user_infos')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('user_deleted_by_users_info_id', 'fk_users_info_users_info3_idx')
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
