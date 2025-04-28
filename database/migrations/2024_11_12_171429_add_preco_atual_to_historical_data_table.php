<?php 
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPrecoAtualToHistoricalDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('historical_data', function (Blueprint $table) {
            $table->decimal('preco_atual', 10, 2)->nullable()->after('potencial_valorizacao');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('historical_data', function (Blueprint $table) {
            $table->dropColumn('preco_atual');
        });
    }
}