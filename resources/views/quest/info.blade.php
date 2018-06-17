@extends('layouts.user')

@section('content')
    <div class="container-fluid">
        <div class="row mt-2">
            <div class="col">
                <div class="jumbotron">
                    <p class="display-4">{{$quest->title}}</p>
                    <div class="row">
                        <div class="col-4">
                            <img src="/{{$quest->avatar_full_url}}" alt="quest avatar" class="img-thumbnail">
                        </div>
                        <div class="col-8">
                            <p>{{$quest->description}}</p>
                            <p>{{$quest->execution_time}}</p>
                        </div>
                    </div>
                    @can('view', $user)
                        <a href="{{route('quest.edit', [$user->name, $quest->title])}}" class="btn btn-warning">Let's go edit that shit</a>
                    @endcan

                    @cannot('view', $user)
                        @if(count($quest_in_process))
                            @if($quest_in_process->status === 0)
                                You have to finish this madness till that time - {{$quest_in_process->time_end}}

                                <form action="{{route('user.finish-quest', [$quest->author_name,$quest->title])}}" method="POST">
                                    {{csrf_field()}}
                                    <label for="answer">I can't believe that you did it. Com'n show watch ya got</label>
                                    @include('common.errors')
                                    <textarea name="answer" id="answer" class="form-control"></textarea>
                                    <button class="btn btn-success float-right">Finish it</button>
                                </form>
                            @elseif($quest_in_process->status === 1)
                                <div class="alert alert-success">
                                    Congarts You have finished it successfully
                                </div>
                            @elseif($quest_in_process->status === 2)
                                <div class="alert alert-danger">
                                    What a looser... Com'n buddy people can't be that bad.
                                </div>
                            @endif
                        @else
                            <form action="{{route('user.start-quest', [$quest->author_name,$quest->title])}}"
                                  method="POST">
                                {{csrf_field()}}
                                <button class="btn btn-success float-right">Start it</button>
                            </form>
                        @endif
                    @endcannot
                </div>
            </div>
        </div>
    </div>
@endsection