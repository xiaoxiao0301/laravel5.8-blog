<?php

namespace App\Http\Controllers\Admin;

use App\Model\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Validator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *  get category
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $categoryInfo = Category::orderBy('cate_order','asc')->get();
        $data = Category::getCategoryTrees($categoryInfo, 'cate_id', 'cate_pid', 0, "cate_name");

        // 查询结果分页
        $perPage = 8;
        if ($request->has('page')) {
            $current_page = $request->input('page');
            $current_page = $current_page <= 0 ? 1 : $current_page;
        } else {
            $current_page = 1;
        }

        $itme = array_slice($data, ($current_page - 1) * $perPage, $perPage);
        $total = count($data);
        $paginator = new LengthAwarePaginator($itme, $total, $perPage, $current_page, [
            'path' => Paginator::resolveCurrentPath(),
            'pageName' => 'page'
        ]);
        $pageData = $paginator->toArray()['data'];
        return view('admin.category.index')->with(['data' => $pageData, 'page' => $paginator]);
    }


    /**
     * Show the form for creating a new resource.
     *  get category/create
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cates = Category::where('cate_pid', 0)->get();
        return view('admin.category.create')->with(['data' => $cates]);
    }

    /**
     * Store a newly created resource in storage.
     *  post category
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->except('_token');
        Validator::make($data,[
                'cate_name' => 'required',
                'cate_title' => 'required',
                'cate_keywords' => 'required',
                'cate_describe' => 'required',
            ],[
                'cate_name.required' => '分类名称不能为空',
                'cate_title.required' => '分类标题不能为空',
                'cate_keywords.required' => '关键字不能为空',
                'cate_describe.required' => '描述不能为空'
        ])->validate();

        $res = Category::create($data);

        if ($res) {
          return redirect('admin/category');
        } else {
            return back()->withErrors("数据错误");
        }
    }


    /**
     * Show the form for editing the specified resource.
     *  get category/{category}/edit
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categoryinfo = Category::find($id);
        $cates = Category::where('cate_pid', 0)->get();
        return view('admin.category.edit')->with(['cate' => $categoryinfo, 'data' => $cates]);
    }

    /**
     * Update the specified resource in storage.
     *  put category/{category}
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->except(['_token', '_method']);
        Validator::make($data,[
            'cate_name' => 'required',
            'cate_title' => 'required',
            'cate_keywords' => 'required',
            'cate_describe' => 'required',
        ],[
            'cate_name.required' => '分类名称不能为空',
            'cate_title.required' => '分类标题不能为空',
            'cate_keywords.required' => '关键字不能为空',
            'cate_describe.required' => '描述不能为空'
        ])->validate();

        $res = Category::where('cate_id', $id)->update($data);
        if ($res) {
            return redirect('admin/category');
        } else {
            return back()->withErrors("数据错误");
        }

    }

    /**
     * Remove the specified resource from storage.
     * delete category/{category}
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //传递的是顶级分类，将该顶级分类下的子级分类设置为顶级分类
        $check = Category::find($id);
        if ($check->cate_pid == 0) {
            $res = Category::where('cate_id', $id)->delete();
            if ($res) {
                $res = Category::where('cate_pid', $check->cate_id)->update(['cate_pid' => 0]);
                if ($res) {
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
            } else {
                $data = [
                    'status' => -1,
                    'msg' => "删除失败"
                ];
            }

        } else {
            $result = Category::where('cate_id', $id)->delete();
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
        }
        return response()->json($data);
    }

    /**
     * Change the specified resource order
     * @param $id
     */
    public function changeOrder(Request $request)
    {
        $data = $request->all();
        $orders = Category::where('cate_id', $data['cate_id'])->update(['cate_order' => $data['order']]);
        if ($orders) {
            $result = [
                'status' => 1,
                'msg' => "更新成功"
            ];
        } else {
            $result = [
                'status' => -1,
                'msg' => "更新失败"
            ];
        }

        return response()->json($result);
    }
}
