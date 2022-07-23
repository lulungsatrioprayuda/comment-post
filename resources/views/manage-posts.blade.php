@extends('frontlayout')
@section('title','manage posts')
@section('content')
<div class="row">
    <div class="col-md-8 mb-5">
        <h5>Manage your post </h5>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Category</th>
                        <th>Title</th>
                        <th>Image</th>
                        <th>Full</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $post)
                    <tr>
                        <td>{{$post->id}}</td>
                        <td>{{$post->category->title}}</td>
                        <td>{{$post->title}}</td>
                        <td><img src="{{ asset('imgs/thumb').'/'.$post->thumb }}" width="100" /></td>
                        <td><img src="{{ asset('imgs/full').'/'.$post->full_img }}" width="100" /></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
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
                <a href="#" class="list-group-item">Post 1</a>
                <a href="#" class="list-group-item">Post 2</a>
            </div>
        </div>
    </div>
</div>

<link href="{{asset('backend')}}/vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
<script src="{{asset('backend')}}/vendor/datatables/jquery.dataTables.js"></script>
<script src="{{asset('backend')}}/vendor/datatables/dataTables.bootstrap4.js"></script>
<script src="{{asset('backend')}}/js/demo/datatables-demo.js"></script>
@endsection