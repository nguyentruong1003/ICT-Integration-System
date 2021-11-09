<?php

namespace App\Http\Controllers\Admin\Config;
use App\Http\Controllers\Controller;
use App\Models\MasterData;
use DB;
use Session;
use Illuminate\Http\Request;

class MasterController extends Controller
{
    public function index()
    {
        $category=MasterData::Paginate(25);
        return view('admin.master.index')->with("category",$category);
    }

    public function delete($id)
    {
       MasterData::findOrFail($id)->delete();
       return redirect()->route('admin.config.master');
    }

    public function create()
    {
       return view('admin.config.master.create');
    }

    public function insert(Request $request)
    {
      $this->validate($request, [
        'v_key' => 'Required',
        'type' => 'Numeric',
      ]);
      $master = new  MasterData;
      $master->v_key = $request->v_key;
      $master->v_value = $request->v_value;
      $master->order_number = $request->order_number;
      $master->type = $request->type;
      $master->v_value_en = $request->v_value_en;
      $master->parent_id = $request->parent_id;
      $master->save();

      if($master)
      {
          Session::put("message","Tạo Mới Đối Tượng Thành Công");
      }
       return redirect()->route('admin.config.master.create');
    }

    public function edit($id)
    {
         $masterid=MasterData::where('id',$id)->first();
         return view('admin.config.master.edit')->with("masterid", $masterid);
    }
    public function update(Request $request)
    {
      $this->validate($request, [
        'v_key' => 'Required',
        'type' => 'Numeric',
      ]);
      $id = $request->id;
      $master=MasterData::where('id',$id)
      ->update([
        'v_key' =>$request->v_key,
        'v_value'=>$request->v_value,
        'order_number'=>$request->order_number,
        'type'=>$request->type,
        'v_value_en'=>$request->v_value_en,
        'parent_id'=>$request->parent_id,
    ]);
    if($master)
      {
          Session::put("message","Sửa Đối Tượng Thành Công");
      }

      return redirect()->route('admin.config.master.edit',[$id]);
    }
}
