@extends('layout')
@section('content')
<div class="container-fluid">

  <!-- Breadcrumbs-->
  <ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="#">Dashboard</a>
    </li>
    <li class="breadcrumb-item active">Overview</li>
  </ol>


  <!-- DataTables Example -->
  <div class="card mb-3">
    <div class="card-header">
      <i class="fas fa-table"></i> Update Posting
      <a href="{{url('admin/post')}}" class="float-right btn btn-sm btn-dark">All Data</a>
    </div>
    <div class="card-body">
      <div class="table-responsive">

        @if($errors)
        @foreach($errors->all() as $error)
        <p class="text-danger">{{$error}}</p>
        @endforeach
        @endif

        @if(Session::has('success'))
        <p class="text-success">{{session('success')}}</p>
        @endif

        <form method="post" action="{{url('admin/post/'.$data->id)}}" enctype="multipart/form-data">
          @csrf
          @method('put')
          <table class="table table-bordered">
            <tr>
              <th>Category</th>
              <td><select name="category" class="form-control">
                  @foreach($cats as $cate)
                  @if($cate->id == $data->cat_id)
                  <option selected value="{{$cate->id}}">{{$cate->title}}</option>
                  @else
                  <option value="{{$cate->id}}">{{$cate->title}}</option>
                  @endif
                  @endforeach
                </select></td>
            </tr>
            <tr>
              <th>Title</th>
              <td><input type="text" value="{{$data->title}}" name="title" class="form-control" /></td>
            </tr>
            <th>Detail</th>
            <td><textarea name="detail" cols="30" rows="10" class="form-control">{{$data->detail}}</textarea></td>
            </tr>
            <tr>
              <th>Tags</th>
              <td><textarea name="tags" cols="30" rows="10" class="form-control">{{$data->tags}}</textarea></td>
            </tr>
            <tr>
              <th>Thumb</th>
              <td>
                <p class="my-2"><img width="80" src="{{asset('imgs/thumb')}}/{{$data->thumb}}" /></p>
                <input type="hidden" value="{{$data->thumb}}" name="post_thumbnail" />
                <input type="file" name="post_thumbnail" />
              </td>
            </tr>
            <tr>
              <th>Full Image</th>
              <td>
                <p class="my-2"><img width="80" src="{{asset('imgs/full')}}/{{$data->full_img}}" /></p>
                <input type="hidden" value="{{$data->full_img}}" name="post_image" />
                <input type="file" name="post_image" />
              </td>
            </tr>
            <tr>
              <th>Detail</th>
              <td><input type="text" value="{{$data->detail}}" name="detail" class="form-control" /></td>
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
  </div>

</div>
<!-- /.container-fluid -->
@endsection