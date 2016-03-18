<?php

use Illuminate\Database\Seeder;
use Attract\Models\News;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call(NewsTableSeeder::class);
    }
}

class NewsTableSeeder extends Seeder {

    public function run()
    {
        DB::table('news')->delete();
        DB::statement("ALTER TABLE news AUTO_INCREMENT=1");

        News::create([
          'title' => 'First news',
          'slug' => 'news1',
          'introtext' => 'Lorem ipsum dolor sit amet, no dico mediocritatem his, modo lobortis eu est.',
          'content' => 'Lorem ipsum dolor sit amet, no dico mediocritatem his, modo lobortis eu est. An sonet utamur recteque vel, ei unum similique ullamcorper eum, vis delectus consetetur elaboraret an. Ne vis elitr albucius assentior, summo tacimates mel ea. Mel te ignota vulputate. Alii accommodare ex mei, in dicat facete iracundia sed, mel ea possit inimicus. Per ut solum vituperatoribus, vide facer populo qui eu. Nam et aliquid honestatis, an democritum philosophia has. In pri eripuit admodum. An vel tota error democritum, nam ut solet tantas eruditi. Ea est electram explicari, no eam tale discere. Dicant nullam iudicabit eam ea. Vim ea purto contentiones, vidit tacimates assueverit ad eum. Sit munere dictas accumsan id, sit wisi posse ridens in, primis tacimates et mei.',
          'published' => true,
          'published_at' => DB::raw('CURRENT_TIMESTAMP')
        ]);

        News::create([
            'title' => 'Пример новости 2',
            'slug' => 'news2',
            'introtext' => 'Превью текст новости 2',
            'content' => 'Lorem ipsum dolor sit amet, no dico mediocritatem his, modo lobortis eu est. An sonet utamur recteque vel, ei unum similique ullamcorper eum, vis delectus consetetur elaboraret an. Ne vis elitr albucius assentior, summo tacimates mel ea. Mel te ignota vulputate. Alii accommodare ex mei, in dicat facete iracundia sed, mel ea possit inimicus. Per ut solum vituperatoribus, vide facer populo qui eu. Nam et aliquid honestatis, an democritum philosophia has. In pri eripuit admodum. An vel tota error democritum, nam ut solet tantas eruditi. Ea est electram explicari, no eam tale discere. Dicant nullam iudicabit eam ea. Vim ea purto contentiones, vidit tacimates assueverit ad eum. Sit munere dictas accumsan id, sit wisi posse ridens in, primis tacimates et mei.',
            'published' => true,
            'published_at' => DB::raw('CURRENT_TIMESTAMP')
        ]);

        News::create([
            'title' => 'Пример новости 3',
            'slug' => 'news3',
            'introtext' => 'Превью текст новости 3',
            'content' => 'Lorem ipsum dolor sit amet, no dico mediocritatem his, modo lobortis eu est. An sonet utamur recteque vel, ei unum similique ullamcorper eum, vis delectus consetetur elaboraret an. Ne vis elitr albucius assentior, summo tacimates mel ea. Mel te ignota vulputate. Alii accommodare ex mei, in dicat facete iracundia sed, mel ea possit inimicus. Per ut solum vituperatoribus, vide facer populo qui eu. Nam et aliquid honestatis, an democritum philosophia has. In pri eripuit admodum. An vel tota error democritum, nam ut solet tantas eruditi. Ea est electram explicari, no eam tale discere. Dicant nullam iudicabit eam ea. Vim ea purto contentiones, vidit tacimates assueverit ad eum. Sit munere dictas accumsan id, sit wisi posse ridens in, primis tacimates et mei.',
            'published' => true,
            'published_at' => DB::raw('CURRENT_TIMESTAMP')
        ]);

    }
}