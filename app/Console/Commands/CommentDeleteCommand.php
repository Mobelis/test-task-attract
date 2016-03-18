<?php

namespace Attract\Console\Commands;

use Illuminate\Console\Command;
use Attract\Models\Comment;
use Attract\Models\News;
class CommentDeleteCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'comment:delete
                            {id : The ID of the comment} ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete comment';

    /**
     * The console command description.
     *
     * @var Attract\Models\Comment
     */
    protected $commentModel;

    /**
     * The console command description.
     *
     * @var Attract\Models\News
     */
    protected $newsModel;

    /**
     * Create a new command instance.
     *
     * @param News $newsModel
     * @param Comment $commentModel
     * @return void
     */
    public function __construct(News $newsModel,Comment $commentModel)
    {
        $this->newsModel = $newsModel;
        $this->commentModel = $commentModel;
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $id         = $this->argument('id');

        if($comment = $this->commentModel->find($id)) {
            if($comment->delete())
                $this->info('comment delete');
            else
                $this->info('error delete');
        } else {
            $this->error('comment not found');
        }
    }
}
