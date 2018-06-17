@extends('layouts.user')

@section('content')
    <div class="container-fluid">
        <div class="row mt-2">
            <div class="col">
                <div class="jumbotron">
                    <p class="display-4">Edit quest</p>
                    <div class="row">
                        <div class="col">
                            @include('common.errors')
                            <form action="{{url(route('quest.update', [$user->name, $quest->title]))}}" method="POST" enctype="multipart/form-data">
                                {{csrf_field()}}
                                {{method_field('PUT')}}
                                <div class="form-group">
                                    <label class="w-100">
                                        Title
                                        <input type="text" name="title" required class="form-control" value="{{$quest->title}}">
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label class="w-100">
                                        Photo
                                        <input type="file" name="photo" required class="form-control">
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label class="w-100">
                                        Short description
                                        <textarea name="short_desc" required class="form-control">{{$quest->short_description}}</textarea>
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label class="w-100">
                                        Description
                                        <textarea name="desc" required class="form-control">{{$quest->description}}</textarea>
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label class="w-100">
                                        Answer
                                        <input type="text" name="answer" required class="form-control" value="{{$quest->answer}}">
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label class="w-100">
                                        Execution time
                                        <input type="text" name="exec_time" required class="form-control" value="{{$quest->execution_time}}">
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label>
                                        Publish
                                        <input type="checkbox" name="published" class="form-control">
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