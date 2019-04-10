<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeysToBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('books', function(Blueprint $table) {

            $table->foreign('category_id', 'category_foreign')
                ->references('id')->on('categories')
                ->onDelete('cascade');

            $table->foreign('author_id', 'author_foreign')
                ->references('id')->on('authors')
                ->onDelete('cascade');

            $table->foreign('borrowed_by', 'borrowed_foreign')
                ->references('id')->on('users')
                ->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('books', function(Blueprint $table) {

            $table->dropForeign('category_foreign');

            $table->dropForeign('author_foreign');

            $table->dropForeign('borrowed_foreign');

        });
    }
}
