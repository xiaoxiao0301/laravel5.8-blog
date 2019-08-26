<?php

namespace App\Http\Controllers\Home;

use App\Model\Articles;
use App\Model\Category;
use App\Model\Configs;
use App\Model\Links;
use Illuminate\Http\Request;

class IndexController extends CommonController
{
    public function index()
    {
        //获取点击量前6篇文章
        $hotArticles = Articles::orderBy('art_view', 'desc')->take(6)->get();

        // 图文列表，带分页
        $articlesLists = Articles::orderBy('art_timer', 'desc')->paginate(5);

        // 最新发布的8篇文章
        $newsArticles = Articles::orderBy('art_timer', 'desc')->take(8)->get();

        // 友情链接
        $links = Links::orderBy('links_order', 'asc')->get();

        $data = [
            'hot' => $hotArticles,
            'lists' => $articlesLists,
            'links' => $links,
            'news' => $newsArticles,
        ];

        return view('home.index.index')->with($data);
    }


    public function category(Category $category)
    {



        //当前分类是否是二级分类，二级分类查找主分类下的所有分类
        if ($category->cate_pid != 0) {
            // 查找相关分类
            $subCates = Category::where('cate_pid', $category->cate_pid)->where('cate_id', '<>', $category->cate_id)->get();
            // 当前分类下的最新8篇文章
            $newsArticles = Articles::orderBy('art_timer', 'desc')->where('art_cate_id', $category->cate_id)->take(8)->get();

            // 当前分类下的5篇点击最高的
            $hotArticles = Articles::orderBy('art_view', 'desc')->where('art_cate_id', $category->cate_id)->take(6)->get();

            // 图文列表，带分页
            $articlesLists = Articles::orderBy('art_timer', 'desc')->where('art_cate_id', $category->cate_id)->paginate(5);

            // 当前分类浏览量加1
            Category::where('cate_id', $category->cate_id)->increment('cate_view', 1);
        } else {
            // 是主分类，查找子分类
            $subCates = Category::where('cate_pid', $category->cate_id)->get();

            //获取子分类的所有id
            $subIds = collect($subCates)->pluck('cate_id');

            // 当前分类下的最新8篇文章
            $newsArticles = Articles::orderBy('art_timer', 'desc')->whereIn('art_cate_id', $subIds)->take(8)->get();

            // 当前分类下的5篇点击最高的
            $hotArticles = Articles::orderBy('art_view', 'desc')->whereIn('art_cate_id', $subIds)->take(6)->get();
            // 图文列表，带分页
            $articlesLists = Articles::orderBy('art_timer', 'desc')->whereIn('art_cate_id', $subIds)->paginate(5);

            // 当前分类浏览量加1
            Category::where('cate_id', $category->cate_id)->increment('cate_view', 1);
        }

        $data = [
            'cate' => $category,
            'subCates' => $subCates,
            'hot' => $hotArticles,
            'news' => $newsArticles,
            'links' => $articlesLists
        ];


        return view('home.articles.cates')->with($data);
    }

    public function articles(Articles $articles)
    {
        // 当前文章浏览数加1
        Articles::where('art_id', $articles->art_id)->increment('art_view', 1);

        //获取当前分类下的点击和排行

        // 当前分类下的最新8篇文章
        $newsArticles = Articles::orderBy('art_timer', 'desc')->where('art_cate_id', $articles->art_cate_id)->take(8)->get();

        // 当前分类下的5篇点击最高的
        $hotArticles = Articles::orderBy('art_view', 'desc')->where('art_cate_id', $articles->art_cate_id)->take(5)->get();

        //上一篇
        $prevArticles = Articles::where('art_id', '<', $articles->art_id)->orderBy('art_id', 'desc')->first();

        //下一篇
        $nextArticles = Articles::where('art_id', '>', $articles->art_id)->orderBy('art_id', 'asc')->first();


        $data = [
            'articles' => $articles,
            'hots' => $hotArticles,
            'news' => $newsArticles,
            'prev' => $prevArticles,
            'next' => $nextArticles
        ];

        return view('home.articles.articles')->with($data);
    }



}
