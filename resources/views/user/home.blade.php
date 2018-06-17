@extends('layouts.user')

@section('content')
    <div class="container-fluid">
        <div class="row mt-2">
            <div class="col">
                <div class="jumbotron">
                    <p class="display-4">Last Quests</p>
                    @if(count($quests))
                        <div class="row justify-content-around">
                            @foreach($quests as $quest)
                                <div class="card my-2 p-2">
                                    <div class="row">
                                        <div class="col">
                                            <img src="/{{$quest->avatar_full_url}}" alt="some quest photo" class="img-thumbnail">
                                        </div>
                                        <div class="col">
                                            <p>{{$quest->title}}</p>
                                            <p>{{$quest->short_description}}</p>
                                            <a href="{{route('quest.show', [$quest->author->name,$quest->title])}}" class="btn btn-primary">Find more</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="h1 text-center">There are no any quest yet!</p>
                    @endif
                </div>
            </div>
        </div>
        <div class="row mt-2">
            <div class="col">
                <div class="jumbotron">
                    <p class="display-4">Last quests in process</p>
                    @if(count($quests_in_process))
                        <div class="row justify-content-around">
                            @foreach($quests_in_process as $quest_in_process)
                                <div class="card my-2 p-2">
                                    <div class="row">
                                        <div class="col">
                                            <img src="/{{$quest_in_process->quest->avatar_full_url}}" alt="some quest photo" class="img-thumbnail">
                                        </div>
                                        <div class="col">
                                            <p>{{$quest_in_process->quest->title}}</p>
                                            <p>{{$quest_in_process->quest->short_description}}</p>
                                            <p>Time when this madness has to end - {{$quest_in_process->time_end}}</p>
                                            <a href="#" class="btn btn-warning">Finish it</a>
                                            <a href="{{route('quest.show', [$quest_in_process->quest->author_name,$quest_in_process->quest->title])}}" class="btn btn-primary">Find more</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="h1 text-center">There are no any quest yet!</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection