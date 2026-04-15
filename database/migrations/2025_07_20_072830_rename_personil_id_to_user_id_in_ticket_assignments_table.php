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
    if (Schema::hasColumn('ticket_assignments', 'personil_id')) {
        Schema::table('ticket_assignments', function (Blueprint $table) {
            $table->renameColumn('personil_id', 'user_id');
        });
    }
}

    /**
     * Reverse the migrations.
     */
  public function down(): void
{
    if (Schema::hasColumn('ticket_assignments', 'user_id')) {
        Schema::table('ticket_assignments', function (Blueprint $table) {
            $table->renameColumn('user_id', 'personil_id');
        });
    }
}
};
