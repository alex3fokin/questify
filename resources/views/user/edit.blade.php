@extends('layouts.user')

@section('content')
    <div class="container-fluid">
        <div class="row mt-2">
            <div class="col">
                <div class="jumbotron">
                    <p class="display-4">Edit profile info</p>
                    <div class="row">
                        <div class="col">
                            @include('common.errors')
                            <form action="{{url(route('user.update', [$user->name]))}}" method="POST" enctype="multipart/form-data">
                                {{csrf_field()}}
                                {{method_field("PUT")}}
                                <div class="form-group">
                                    <label class="w-100">
                                        Email
                                        <input type="text" name="email" required class="form-control" value="{{$user->email}}">
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label class="w-100">
                                        Avatar
                                        <input type="file" name="photo" required class="form-control">
                                    </label>
                                </div>
                                <div class="form-group">
                                    <button type="reset" class="btn btn-info">Reset</button>
                                    <button type="submit" class="btn btn-success">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection