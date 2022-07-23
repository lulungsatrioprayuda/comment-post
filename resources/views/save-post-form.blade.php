@extends('frontlayout')
@section('title','save post')
@section('content')
<div class="row">
    <div class="col-md-8 mb-5">
        <h5>Add your post </h5>
        <div class="table-responsive">

            @if($errors)
            @foreach($errors->all() as $error)
            <p class="text-danger">{{$error}}</p>
            @endforeach
            @endif

            @if(Session::has('success'))
            <p class="text-success">{{session('success')}}</p>
            @endif

            <form method="post" action="{{url('save-post-form')}}" enctype="multipart/form-data">
                @csrf
                <table class="table table-bordered">
                    <tr>
                        <th>Category</th>
                        <td><select name="category" class="form-control">
                                @foreach($cats as $cate)
                                <option value="{{$cate->id}}">{{$cate->title}}</option>
                                @endforeach
                            </select></td>
                    </tr>
                    <tr>
                        <th>title</th>
                        <td><input type="text" class="form-control" name="title"></td>
                    </tr>
                    <th>Detail</th>
                    <td><textarea name="detail" cols="30" rows="10" class="form-control"></textarea></td>
                    </tr>
                    <tr>
                        <th>Tags</th>
                        <td><textarea name="tags" cols="30" rows="10" class="form-control"></textarea></td>
                    </tr>
                    <tr>
                        <th>Thumbnail</th>
                        <td><input type="file" name="post_thumbnail" /></td>
                    </tr>
                    <tr>
                        <th>Full Image</th>
                        <td><input type="file" name="post_image" /></td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type="submit" class="btn btn-primary" />
                        </td>
                    </tr>
                </table>
            </form>
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
@endsection