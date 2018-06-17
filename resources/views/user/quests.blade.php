@extends('layouts.user')

@section('content')
    <div class="container-fluid">
        <div class="row mt-2">
            <div class="col">
                <div class="jumbotron">
                    <p class="display-4">All Quests created by {{$user->name}}</p>
                    @if($user->quests)
                        <div class="row justify-content-around">
                            @foreach($user->quests as $quest)
                                <div class="card my-2 p-2">
                                    <div class="row">
                                        <div class="col">
                                            <img src="/{{$quest->avatar_full_url}}" alt="some quest photo" class="img-thumbnail">
                                        </div>
                                        <div class="col">
                                            <p>{{$quest->title}}</p>
                                            <p>{{$quest->short_description}}</p>
                                            <a href="{{route('quest.show', [$user->name,$quest->title])}}" class="btn btn-primary">Find more</a>
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