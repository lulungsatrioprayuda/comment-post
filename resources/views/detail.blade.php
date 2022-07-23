@extends('frontlayout')
@section('title','Home Page')
@section('content')
<div class="row">
    <div class="col-md 8">
        @if(Session::has('success'))
        <p class="text-success">{{session('success')}}</p>
        @endif
        <div class="card">
            <h5 class="card-header">
                {{$detail->title}}
                <span class="float-right">Total Views <span class="badge badge-warning">{{$detail->views}}</span></span>
            </h5>
            <img src="{{asset('imgs/full/'.$detail->full_img)}}" class="card-img-top" alt="{{$detail->title}}">
            <div class="card-body">
                {{$detail->detail}}
            </div>
            <div class="card-footer pt-2">
                <a
                    href="{{url('category/'.Str::slug($detail->category->title).'/'.$detail->category->id)}}">#{{$detail->category->title}}</a>
            </div>
        </div>
        @auth
        <div class="card mb-5 mt-2">
            <h5 class="card-header">Add more comment </h5>
            <div class="card-body">
                <form method="post" action="{{url('save-comment/'. Str::slug($detail->title) .'/'. $detail->id)}}">
                    @csrf
                    <textarea name="comment" class="form-control"></textarea>
                    <input type="submit" class="btn btn-dark mb-2">
                </form>
            </div>
        </div>
        @endif
        {{-- load the comment --}}
        <div class="card my-4">
            <h5 class="card-header">Comments <span class="badge badge-success">{{count($detail->comments)}}</span></h5>
            <div class="card-body">
                @if($detail->comments)
                @foreach($detail->comments as $comment)
                <blockquote class="blockquote">
                    <p class="mb-0">{{$comment->comment}}</p>
                    @if($comment->user_id==0)
                    <footer class="blockquote-footer">Admin</footer>
                    @else
                    <footer class="blockquote-footer">{{$comment->user->name}}</footer>
                    @endif
                </blockquote>
                <hr />
                @endforeach
                @endif
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card mb-4">
            <h5 class="card-header">Search</h5>
            <div class="card-body">
                <form action="{{url('/')}}">
                    <div class="input-group">
                        <input type="text" name="q" class="form-control" />
                        <div class="input-group-append">
                            <button class="btn btn-dark" type="button" id="button-addon2">Search</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="card mb-4">
            <h5 class="card-header">Recent Posts</h5>
            <div class="list-group list-group-flush">
                @if($recent_posts)
                @foreach($recent_posts as $post)
                <a href="#" class="list-group-item">{{$post->title}}</a>
                @endforeach
                @endif
            </div>
        </div>
        <div class="card mb-4">
            <h5 class="card-header">Popular Posts</h5>
            <div class="list-group list-group-flush">
                @if($popular_posts)
                @foreach($popular_posts as $post)
                <a href="#" class="list-group-item">{{$post->title}} <span
                        class="badge badge-info">{{$detail->views}}</span></a>
                @endforeach
                @endif
            </div>
        </div>
    </div>
</div>
@endsection