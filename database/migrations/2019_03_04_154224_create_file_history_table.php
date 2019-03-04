<?php
/**
 * Created by Weslley Ribeiro.
 * User: Weslley Ribeiro <wess_ribeiro@hotmail.com>
 * Date: 04/03/2019 12:05
 */
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFileHistoryTable extends Migration
{
    /*
     * Table use
     * */
    private $_tb = 'file_history';

    public function up()
    {
        if (!Schema::hasTable($this->_tb)) {
            Schema::create($this->_tb, function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->string('name')->default('sem_nome');
                $table->boolean('is_processed')->default(false);
                $table->timestamps();
                $table->softDeletes();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists($this->_tb);
    }
}
