@extends('layouts.user')

@section('content')
    <div class="container-fluid">
        <div class="row mt-2">
            <div class="col">
                <div class="jumbotron">
                    <p class="display-4">All Quests</p>
                    @if(count($quests))
                        <div class="row justify-content-around">
                            @foreach($quests as $quest)
                                <div class="card my-2 p-2 w-100">
                                    <div class="row">
                                        <div class="col-2">
                                            <img src="/{{$quest->avatar_full_url}}" alt="some quest photo" class="img-thumbnail">
                                        </div>
                                        <div class="col-10">
                                            <p>{{$quest->title}}</p>
                                            <p>{{$quest->short_description}}</p>
                                            <a href="{{route('quest.show', [$quest->author_name,$quest->title])}}" class="btn btn-primary float-right mx-2">Find more</a>
                                            <a href="{{route('user.start-quest', [$quest->author_name,$quest->title])}}" class="btn btn-success float-right">Start it</a>
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