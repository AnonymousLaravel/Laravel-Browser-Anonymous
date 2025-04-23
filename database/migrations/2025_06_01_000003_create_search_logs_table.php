<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSearchLogsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('search_logs', function (Blueprint $table) {
            $table->id();

            // session_id come stringa (corrisponde all'id della tabella sessions)
            $table->string('session_id', 191);
            $table->foreign('session_id')
                  ->references('id')
                  ->on('sessions')
                  ->onDelete('cascade');

            // id della pagina collegata
            $table->foreignId('page_id')
                  ->constrained('pages')
                  ->onDelete('cascade');

            // created_at e updated_at
            $table->timestamps();

            // indice per velocizzare le ricerche per session_id
            $table->index('session_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Rimuovo prima le foreign key e l’indice
        Schema::table('search_logs', function (Blueprint $table) {
            $table->dropForeign(['session_id']);
            $table->dropForeign(['page_id']);
            $table->dropIndex(['session_id']);
        });

        // Poi elimino la tabella
        Schema::dropIfExists('search_logs');
    }
}
