@extends('layouts.panel')
@section('content')
    <form action="{{route('videos.store')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="">فایل ویدیو</label>
                <input type="file" name="videoFile" class="form-control">

        </div>
        <div class="form-group">
            <label for="">عنوان ویدیو</label>
            <input type="text" name="title" class="form-control">
            @error('title')
            <div class="text text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="">توضیحات ویدیو</label>
            <textarea type="text" name="description" class="form-control"></textarea>
            @error('description')
            <div class="text text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">ذخیره</button>
        </div>
    </form>
@endsection

