<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title',200);
            $table->string('slug',100)->unique();
            $table->text('introtext')->nullable();
            $table->text('content');
            $table->integer('user_id')->unsigned()->nullable();
            $table->timestamp('published_at')->nullable();
            $table->boolean('published')->default(true);
            $table->integer('col_comment')->unsigned()->default(0);
            $table->timestamps();
        });

        Schema::table('news', function($table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });

        //DB::table('News')->delete();
        //DB::statement("ALTER TABLE news AUTO_INCREMENT=1");

        $NewsData = [
            [
              'title'           => 'First news',
              'slug'            => 'news1',
              'introtext'       => 'Lorem ipsum dolor sit amet, no dico mediocritatem his, modo lobortis eu est.',
              'content'         => 'Lorem ipsum dolor sit amet, no dico mediocritatem his, modo lobortis eu est. An sonet utamur recteque vel, ei unum similique ullamcorper eum, vis delectus consetetur elaboraret an. Ne vis elitr albucius assentior, summo tacimates mel ea. Mel te ignota vulputate. Alii accommodare ex mei, in dicat facete iracundia sed, mel ea possit inimicus. Per ut solum vituperatoribus, vide facer populo qui eu. Nam et aliquid honestatis, an democritum philosophia has. In pri eripuit admodum. An vel tota error democritum, nam ut solet tantas eruditi. Ea est electram explicari, no eam tale discere. Dicant nullam iudicabit eam ea. Vim ea purto contentiones, vidit tacimates assueverit ad eum. Sit munere dictas accumsan id, sit wisi posse ridens in, primis tacimates et mei.',
              'published'       => true,
              'published_at'    => DB::raw('CURRENT_TIMESTAMP'),
              'created_at'      => DB::raw('CURRENT_TIMESTAMP'),
              'updated_at'      => DB::raw('CURRENT_TIMESTAMP'),
            ],

            [
              'title'           => 'Пример новости 2',
              'slug'            => 'news2',
              'introtext'       => 'Превью текст новости 2',
              'content'         => 'Lorem ipsum dolor sit amet, no dico mediocritatem his, modo lobortis eu est. An sonet utamur recteque vel, ei unum similique ullamcorper eum, vis delectus consetetur elaboraret an. Ne vis elitr albucius assentior, summo tacimates mel ea. Mel te ignota vulputate. Alii accommodare ex mei, in dicat facete iracundia sed, mel ea possit inimicus. Per ut solum vituperatoribus, vide facer populo qui eu. Nam et aliquid honestatis, an democritum philosophia has. In pri eripuit admodum. An vel tota error democritum, nam ut solet tantas eruditi. Ea est electram explicari, no eam tale discere. Dicant nullam iudicabit eam ea. Vim ea purto contentiones, vidit tacimates assueverit ad eum. Sit munere dictas accumsan id, sit wisi posse ridens in, primis tacimates et mei.',
              'published'       => true,
              'published_at'    => DB::raw('CURRENT_TIMESTAMP'),
              'created_at'      => DB::raw('CURRENT_TIMESTAMP'),
              'updated_at'      => DB::raw('CURRENT_TIMESTAMP'),
            ],

            [
              'title'           => 'Пример новости 3',
              'slug'            => 'news3',
              'introtext'       => 'Превью текст новости 3',
              'content'         => 'Lorem ipsum dolor sit amet, no dico mediocritatem his, modo lobortis eu est. An sonet utamur recteque vel, ei unum similique ullamcorper eum, vis delectus consetetur elaboraret an. Ne vis elitr albucius assentior, summo tacimates mel ea. Mel te ignota vulputate. Alii accommodare ex mei, in dicat facete iracundia sed, mel ea possit inimicus. Per ut solum vituperatoribus, vide facer populo qui eu. Nam et aliquid honestatis, an democritum philosophia has. In pri eripuit admodum. An vel tota error democritum, nam ut solet tantas eruditi. Ea est electram explicari, no eam tale discere. Dicant nullam iudicabit eam ea. Vim ea purto contentiones, vidit tacimates assueverit ad eum. Sit munere dictas accumsan id, sit wisi posse ridens in, primis tacimates et mei.',
              'published'       => true,
              'published_at'    => DB::raw('CURRENT_TIMESTAMP'),
              'created_at'      => DB::raw('CURRENT_TIMESTAMP'),
              'updated_at'      => DB::raw('CURRENT_TIMESTAMP'),
            ]
        ];

        DB::table('news')->insert($NewsData);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('news');
    }
}
