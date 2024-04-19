@extends('layouts.panel')
@section('content')
    <form action="{{route('videos.update',$video)}}" method="post">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="">عنوان ویدیو</label>
            <input type="text" name="title" class="form-control" value="{{$video->title}}">
        </div>
        <div class="form-group">
            <label for="">توضیحات ویدیو</label>
            <textarea type="text" name="description" class="form-control">{{$video->description}}</textarea>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">ذخیره</button>
        </div>
    </form>
@endsection

