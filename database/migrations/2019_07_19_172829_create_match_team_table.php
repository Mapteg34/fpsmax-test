<?php

use App\Models\Match;
use App\Models\Team;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMatchTeamTable extends Migration
{
    public function up()
    {
        Schema::create('match_team', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('match_id');
            $table->integer('team_id');

            $table->foreign('match_id')
                  ->references('id')
                  ->on((new Match())->getTable())
                  ->onUpdate('CASCADE')
                  ->onDelete('CASCADE');

            $table->foreign('team_id')
                  ->references('id')
                  ->on((new Team())->getTable())
                  ->onUpdate('CASCADE')
                  ->onDelete('CASCADE');
            // @TODO: may be uniq[match_id,team_id] ?
        });
    }

    public function down()
    {
        Schema::dropIfExists('match_team');
    }
}
