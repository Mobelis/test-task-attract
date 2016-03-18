<?php

namespace Attract\Http\Controllers;

use Illuminate\Http\Request;

use Attract\Http\Requests;
use Attract\Models\News;
use Attract\Http\Requests\CreateNewsRequest;
use Illuminate\Support\Facades\Validator;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Attract\Models\News $newsModel
     * @return \Illuminate\Http\Response
     */
    public function index(News $newsModel)
    {
        $news = $newsModel->getPublishedNews();
        $title = 'Новости';
        return view('home')->withNews($news)->withTitle($title);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('news.create',['title'=>trans('news.add-news-title')]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @param  News $newsModel
     * @return \Illuminate\Http\Response
     */
    public function store(News $newsModel, Request $request)
    {
        $this->validate($request,$newsModel::$rules);
        //$newsModel->create($request->all());

        $newsModel->title = $request->get('title');
        $newsModel->content = $request->get('content');
        $newsModel->save();
        return redirect('news/' . $newsModel->slug)->withMessage('Новость успешно добавлена.');
    }

    /**
     * Display the specified resource.
     *
     * @param  News $newsModel
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function show(News $newsModel,$slug)
    {
        $news = $newsModel->getSlugNews($slug);
        if($news)
        {
            if($news->published == false)
                return redirect('/')->withErrors('requested page not found');
            $comments = $news->comments;
        }
        else
        {
            return redirect('/')->withErrors('requested page not found');
        }
        return view('news.show')->withNews($news)->withComments($comments);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        return redirect('news/' . $slug)->withMessage('В данный момент отключена возможность редактирования новостей.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
