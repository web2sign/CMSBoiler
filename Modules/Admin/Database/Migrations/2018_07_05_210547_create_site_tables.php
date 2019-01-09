<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSiteTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {

        Schema::create('groups', function (Blueprint $table) {
            $table->increments('id');
            //$table->dateTime('date_start')->nullable();
            $table->string('name');
            $table->text('description');
            $table->timestamps();
        });

        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('email', 55)->unique();
            $table->string('username', 55)->unique();
            $table->string('password');
            $table->timestamps();
        });

        Schema::create('usermeta', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('user_id')->unsigned()->index();
          $table->string('metakey');
          $table->text('metavalue')->nullable();
          $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });

        Schema::create('user_group', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('user_id')->unsigned()->index();
          $table->integer('group_id')->unsigned()->index();
          $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
          $table->foreign('group_id')->references('id')->on('groups')->onDelete('cascade');
        });

        Schema::create('user_permits', function (Blueprint $table) {
          $table->increments('id');
          $table->morphs('permitable'); 
          $table->string('module');
          $table->integer('create')->default(0);
          $table->integer('read')->default(0);
          $table->integer('update')->default(0);
          $table->integer('delete')->default(0);
        });

        Schema::create('user_sessions', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('user_id')->unsigned()->index();
          $table->string('session_type')->default('site');
          $table->string('session_key');
          $table->string('ip');
          $table->dateTime('expired_at')->nullable();
          $table->timestamps();
          $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });


        Schema::create('user_codes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code');
            $table->integer('status')->default();
            $table->timestamps();
        });


        Schema::create('pages', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->index();
            $table->integer('parent_id')->default(0);
            $table->string('slug', 55);
            $table->boolean('status')->default(false);
            $table->string('title', 55);
            $table->string('post_type', 30)->default('page');
            $table->text('description')->nullable();
            $table->text('keywords')->nullable();
            $table->longText('content')->nullable();
            $table->unique(['post_type','slug']);
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });


        Schema::create('pagemeta', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('page_id')->unsigned()->index();
          $table->string('metakey');
          $table->text('metavalue')->nullable();
          $table->foreign('page_id')->references('id')->on('pages')->onDelete('cascade');
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
      Schema::dropIfExists('pagemeta');
      Schema::dropIfExists('pages');
      Schema::dropIfExists('user_codes');
      Schema::dropIfExists('user_sessions');
      Schema::dropIfExists('user_permits');
      Schema::dropIfExists('user_group');
      Schema::dropIfExists('usermeta');
      Schema::dropIfExists('users');
      Schema::dropIfExists('groups');
    }
}
