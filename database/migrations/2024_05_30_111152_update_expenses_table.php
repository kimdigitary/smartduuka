<?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    return new class extends Migration {
        public function up() : void
        {
            Schema ::table('expenses', function (Blueprint $table) {
                $table -> integer('repetitions') -> default(0) -> after('recurs');
                $table -> integer('paid') -> default(0) -> after('repetitions');
                $table -> dateTime('paid_on') -> nullable() -> default(null) -> after('repetitions');
                $table -> dateTime('repeats_on') -> nullable() -> default(null) -> after('repetitions');
            });
        }

        public function down() : void
        {
            //
        }
    };
