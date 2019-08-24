<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Articles as ArticlesRequest;
use App\Model\Articles;
use App\Model\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ArticlesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $data = Articles::paginate(10);
        return view('admin.article.index')->with(['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categoryInfo = Category::orderBy('cate_order','asc')->get();
        $data = Category::getCategoryTrees($categoryInfo, 'cate_id', 'cate_pid', 0, "cate_name");
        return view('admin.article.create')->with(['data' => $data]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ArticlesRequest $request)
    {
        $data = $request->except(['_token', 'file']);
        $data['art_timer'] = date('Y-m-d H:i:s', time());
        $res = Articles::create($data);
        if ($res) {
            return redirect('admin/article');
        }  else {
            return back()->withErrors("请稍后再试!");
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $articles = Articles::find($id);
        $categoryInfo = Category::orderBy('cate_order','asc')->get();
        $data = Category::getCategoryTrees($categoryInfo, 'cate_id', 'cate_pid', 0, "cate_name");
        return view('admin.article.edit')->with(['data' => $data, 'articles' => $articles]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ArticlesRequest $request, $id)
    {
        $data = $request->except(['_token','file','_method']);
        $res = Articles::where('art_id', $id)->update($data);
        if ($res) {
            return redirect('admin/article');
        }  else {
            return back()->withErrors("请稍后再试!");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $result = Articles::where('art_id', $id)->delete();
        if ($result) {
            $data = [
                'status' => 1,
                'msg' => "删除成功"
            ];
        } else {
            $data = [
                'status' => -1,
                'msg' => "删除失败"
            ];
        }

        return response()->json($data);
    }
}
