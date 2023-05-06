<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class TaskController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function change_order(Request $request): Response
    {
        $order=$request->get("order");
        $index=1;
        $project_id=0;
        $task_list=[];
        array_walk($order,function (&$item) use (&$task_list,&$index,&$project_id){

            $var=explode('-',$item);
            $project_id=$var[0];
            array_push($task_list,['id'=>$var[1],'priority'=>$index]);
            $index++;

        });
        $res=Task::ChangePriority($project_id,$task_list);
        return \response($res);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request): Response|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory
    {
        $id=$request->get('id');
        $task_id=explode('-',$id)[1];
        $task=Task::find($task_id);

        $result=Task::destroy($task_id);
//        dd($result);
        return \response($result);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|Response
    {
        $data['name']=$request->get('name');
        $data['project_id']=$request->get('project_id');
        $data['priority']=0;
        $data['created_at']=date('Y-m-d H:i:s',time());
//        dd($data);
        $result=DB::table('tasks')->insert($data);
        return \response($result);
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request): \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|Response
    {
        $data['name']=$request->get('name');
        $data['updated_at']=date('Y-m-d H:i:s',time());
        $id=explode('-',$request->get('id'))[1];
//        $result=Task::updateOrInsert(['id'=>$id],$data);
        $result=DB::table('tasks')->where('id',$id)->update($data);
        return \response($result);
    }
}
