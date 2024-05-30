<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->text('description');
            $table->tinyInteger('featured')->default('0');
            $table->tinyInteger('is_editable')->default('1');
            $table->tinyInteger('active_status')->default('1');
            $table->unsignedBigInteger('created_by_admin_users_info_id');
            $table->unsignedBigInteger('updated_by_admin_users_info_id')->nullable();
            $table->unsignedBigInteger('deleted_by_admin_users_info_id')->nullable();
            $table->foreign('created_by_admin_users_info_id')->references('id')->on('admin_user_infos')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('updated_by_admin_users_info_id')->references('id')->on('admin_user_infos')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('deleted_by_admin_users_info_id')->references('id')->on('admin_user_infos')->onDelete('cascade')->onUpdate('cascade');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
