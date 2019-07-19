<?php

use App\Enums\MatchTypesEnum;
use App\Models\League;
use App\Models\Match;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMatchesTable extends Migration
{
    /** @var string */
    private $table;

    public function __construct()
    {
        $this->table = (new Match)->getTable();
    }

    public function up()
    {
        Schema::create($this->table, function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->dateTime('begin_at');
            $table->dateTime('end_at');
            $table->bigInteger('league_id');
            $table->enum('match_type', MatchTypesEnum::values());
            $table->string('name');
            $table->timestamps();

            $table->foreign('league_id')
                  ->references('id')
                  ->on((new League)->getTable())
                  ->onUpdate('CASCADE')
                  ->onDelete('CASCADE');
        });
    }

    public function down()
    {
        Schema::dropIfExists($this->table);
    }
}
