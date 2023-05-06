<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use function MongoDB\BSON\toJSON;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {

        //
        $list=Project::all();
        foreach ($list as&$item){
            $item['tasks']=Project::find($item['id'])->tasks;
        }

        return view("projects",['projects'=>$list]);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|Response
    {
        $data['name']=$request->post('name');
        $result=DB::table('projects')->insert($data);
        return \response($result);
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request): Response|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory
    {
        $id=$request->get('id');
        $result=Project::destroy($id);
        return \response($result);
    }


}
