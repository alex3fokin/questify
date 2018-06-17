@extends('layouts.user')

@section('content')
    <div class="container-fluid">
        <div class="row mt-2">
            <div class="col">
                <div class="jumbotron">
                    <p class="display-4">{{$user->name}} Profile Info</p>
                    <div class="row">
                        <div class="col-4">
                            <img src="/{{$user->avatar_full_url}}" alt="user avatar" class="img-thumbnail">
                        </div>
                        <div class="col-8">
                            <p>User name: {{$user->name}}</p>
                            <p>User email: {{$user->email}}</p>
                            <p>User rating: {{$user->rating}}</p>
                        </div>
                    </div>
                    @can('view', $user)
                        <a href="{{url(route('user.edit', [$user->name]))}}" class="btn btn-warning">Let's go edit that shit</a>
                    @endcan
                </div>
            </div>
        </div>
    </div>
@endsection