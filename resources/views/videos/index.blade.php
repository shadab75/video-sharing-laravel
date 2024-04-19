@extends('layouts.panel')
@section('content')
    <br>
    <a href="{{route('videos.create')}}" class="btn btn-info">افزودن ویدیو</a><br>
    @foreach($videos as $video)
     {{$video->title}}<br>
     بارگذاری شده توسط
     {{$video->user->name}}
     <hr>
     {{Str::limit($video->description,200)}}<br>
      <div class="d-flex">
          <a class="btn btn-primary" href="{{route('videos.show',$video)}}">ادامه مطلب</a><br>
          <a class="btn btn-info" href="{{route('videos.edit',$video)}}">ویرایش</a>
          <form action="{{route('videos.destroy',$video)}}" method="post">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn btn-danger">حذف</button>
          </form>
      </div>
     <hr>
    @endforeach
    {{ $videos->render() }}
@endsection
