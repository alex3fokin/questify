@extends('layouts.user')

@section('content')
    <div class="container-fluid">
        <div class="row mt-2">
            <div class="col">
                <div class="jumbotron">
                    <p class="display-4">Quests in process</p>
                    @if(count($quests_in_process))
                        <div class="row justify-content-around">
                            @foreach($quests_in_process as $quest)
                                <div class="card my-2 p-2">
                                    <div class="row">
                                        <div class="col">
                                            <img src="/{{$quest->quest->avatar_full_url}}" alt="some quest photo" class="img-thumbnail">
                                        </div>
                                        <div class="col">
                                            <p>{{$quest->quest->title}}</p>
                                            <p>{{$quest->quest->short_description}}</p>
                                            <p>Time when this madness has to end - {{$quest->time_end}}</p>
                                            <a href="#" class="btn btn-warning">Finish it</a>
                                            <a href="{{route('quest.show', [$quest->quest->author_name,$quest->quest->title])}}" class="btn btn-primary">Find more</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="h1 text-center">There are no any quest in process yet!</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection