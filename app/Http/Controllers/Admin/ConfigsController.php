<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ConfigsRequest;
use App\Model\Configs;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ConfigsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $navs = Configs::orderBy('configs_order', 'asc')->paginate(10);

        foreach ($navs as $k => $v) {

            switch ($v->field_type) {
                case 'input':
                    $navs[$k]->_html = '<input type="text" class="lg" name="configs_content[]" value="'.$v->configs_content.'">';
                    break;
                case 'textarea':
                    $navs[$k]->_html = '<textarea name="configs_content[]" class="lg">'.$v->configs_content.'</textarea>';
                    break;
                case 'radio':
                    $fieldValue = explode(',', $v->field_value);
                    $str = '';
                    foreach ($fieldValue as $m => $n) {
                        // 1|开启 这种格式
                        $temp = explode('|', $n);
                        $c = $v->configs_content == $temp[0] ? ' checked ' : '';
                        $str .= '<input type="radio" name="configs_content[]" '.$c.'value="'.$temp[0].'">'.$temp[1].'　';
                    }
                    $navs[$k]->_html = $str;
                    break;
            }
        }

        return view('admin.configs.index')->with(['data' => $navs]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.configs.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ConfigsRequest $request)
    {
        $data = $request->except(['_token']);
        $res = Configs::create($data);
        if ($res) {
            $this->changeConfigs();
            return redirect('admin/configs');
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
        $configs = Configs::find($id);
        return view('admin.configs.edit')->with(['configs' => $configs]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ConfigsRequest $request, $id)
    {
        $data = $request->except(['_token','_method']);
        $res = Configs::where('configs_id', $id)->update($data);
        if ($res) {
            $this->changeConfigs();
            return redirect('admin/configs');
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
        $result = Configs::where('configs_id', $id)->delete();
        if ($result) {
            $data = [
                'status' => 1,
                'msg' => "删除成功"
            ];
            $this->changeConfigs();
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
        $orders = Configs::where('configs_id', $data['configs_id'])->update(['configs_order' => $data['order']]);
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


    public function changeContent(Request $request)
    {
        $data = $request->except(['_token']);

        foreach ($data['configs_id'] as $k => $v) {
           Configs::where('configs_id', $v)->update(['configs_content' => $data['configs_content'][$k]]);
        }

        //写入配置项
        $this->changeConfigs();

        return back()->withErrors("修改配置成功");

    }


    //将网站配置写入配置文件
    public  function changeConfigs()
    {
        $configsInfo = Configs::pluck('configs_content', 'configs_name')->all();
        $path =  config_path().'\web.php';
        $str = '<?php'. PHP_EOL.'return '.var_export($configsInfo, true). ';';
        file_put_contents($path, $str);
    }

    public function writeToFile()
    {
        return 1;
    }

}
