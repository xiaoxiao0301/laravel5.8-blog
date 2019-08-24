<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\NavsRequest;
use App\Model\Navs;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NavsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $navs = Navs::paginate(10);
        return view('admin.navs.index')->with(['data' => $navs]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.navs.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(NavsRequest $request)
    {
        $data = $request->except(['_token']);
        $res = Navs::create($data);
        if ($res) {
            return redirect('admin/navs');
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
        $navs = Navs::find($id);
        return view('admin.navs.edit')->with(['links' => $navs]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(NavsRequest $request, $id)
    {
        $data = $request->except(['_token','_method']);
        $res = Navs::where('navs_id', $id)->update($data);
        if ($res) {
            return redirect('admin/navs');
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
        $result = Navs::where('navs_id', $id)->delete();
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

    public function changeOrder(Request $request)
    {
        $data = $request->all();
        $orders = Navs::where('navs_id', $data['navs_id'])->update(['navs_order' => $data['order']]);
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
