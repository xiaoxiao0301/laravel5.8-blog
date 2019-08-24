<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\LinksRequest;
use App\Model\Links;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LinksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $links = Links::paginate(10);
        return view('admin.links.index')->with(['data' => $links]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.links.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LinksRequest $request)
    {
        $data = $request->except(['_token']);
        $res = Links::create($data);
        if ($res) {
            return redirect('admin/links');
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
        $links = Links::find($id);
        return view('admin.links.edit')->with(['links' => $links]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(LinksRequest $request, $id)
    {
        $data = $request->except(['_token','_method']);
        $res = Links::where('links_id', $id)->update($data);
        if ($res) {
            return redirect('admin/links');
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
        $result = Links::where('links_id', $id)->delete();
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
        $orders = Links::where('links_id', $data['links_id'])->update(['links_order' => $data['order']]);
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
