
@extends('layouts.app')
@section('main')
    <section class="project-list">
        @foreach($projects as $project)
            <div class="list list-group " id="{{$project['id']}}">
                <div class="project list-group-item  list-group-item-action">
                        <h1 class="list-header">Project</h1>
                        <p>{{$project['name']}}</p>

                        <button class="project-delete btn btn-sm  btn-outline-danger" >DELETE</button>


                </div>
                <div class="task-list ">
                    <div class="task-add list-group-item list-group-item-action">
                        <input type="text" placeholder="Please add new task" value="" required>
                        <button class="add btn btn-sm  btn-outline-primary">ADD NEW</button>

                    </div>
                    @foreach($project['tasks'] as $task)
                        <div class="task list-group-item list-group-item-action" id="{{$project['id']}}-{{$task['id']}}">
                            <input type="text" value="{{$task['name']}}" required>

                            <button class="edit btn btn-sm  btn-outline-success">UPDATE</button>
                            <br>
                            <button class="delete btn btn-sm  btn-outline-danger ">DELETE</button>
                        </div>

                    @endforeach

                </div>
            </div>

        @endforeach
    </section>

{{--    <section class="project-list">--}}
{{--        @foreach($projects as $project)--}}
{{--    <div class="card" style="width: 18rem;">--}}
{{--        <div class="card-header" id="{{$project['id']}}">--}}
{{--            <div>--}}
{{--                <p>PROJECT:{{$project['name']}}</p>--}}
{{--                <button class="project-delete" >DELETE</button>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <ul class="list-group list-group-flush " >--}}
{{--            <li class="list-group-item">--}}
{{--                <input type="text" placeholder="Please add new task" value="" required><br>--}}
{{--                <button class="add">ADD</button>--}}
{{--            </li>--}}
{{--            @foreach($project['tasks'] as $task)--}}
{{--                <li class="list-group-item" id="{{$project['id']}}-{{$task['id']}}">--}}
{{--                    <input type="text" value="{{$task['name']}}" required>--}}
{{--                    <button class="edit">EDIT</button>--}}
{{--                    <button class="delete">DELETE</button>--}}
{{--                </li>--}}
{{--            @endforeach--}}
{{--        </ul>--}}
{{--    </div>--}}
{{--        @endforeach--}}
{{--    </section>--}}
@endsection

