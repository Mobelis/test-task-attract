<?php

namespace Attract\Console\Commands\News;

use Illuminate\Console\Command;
use Attract\Models\News;
use Attract\Models\Comment;
use Attract\Models\User;
use Illuminate\Support\Facades\Validator;

class NewsCommentCommand extends Command
{
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
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'news-comment:create 
                            {newsId : The ID of the news} 
                            {--C|comment= : Comment text}
                            {--userId=1 : User id}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create news comment';

    /**
     * The table headers for the command.
     *
     * @var array
     */
    protected $headers = ['Title' , 'Text' ];

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
        $newsId         = $this->argument('newsId');
        $commentText    = $this->option('comment');
        $userId         = $this->option('userId');

        if($commentText==null)
            return $this->error('comment text empty set text use option --comment=""');

        if(!User::find($userId)) {
            return $this->error('user not found set user_id use option --userId=');
        }

        if($news = $this->newsModel->find($newsId)) {

            $validator = Validator::make(
              ['text' => $commentText],
              $this->commentModel->getRules()
            );

            if ($validator->fails())
            {
                $this->error(print_r($validator->messages()->toArray(),1));
            }   else {
                $comment = $this->commentModel;
                $comment->news_id = $newsId;
                $comment->text = $commentText;
                $comment->user_id = $userId;
                if ($comment->save()) {
                    $this->info('Comment successfully created');
                }
            }
        } else {
            $this->error('news not found');
        }

    }
}
