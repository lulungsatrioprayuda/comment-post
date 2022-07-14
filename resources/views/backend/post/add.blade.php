@extends('layout')
@section('content')
<div class="container-fluid">
  <ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="#">Dashboard</a>
    </li>
    <li class="breadcrumb-item active">Overview</li>
  </ol>


  <div class="card mb-3">
    <div class="card-header">
      <i class="fas fa-table"></i> Add Category
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

        <form method="post" action="{{url('admin/category')}}" enctype="multipart/form-data">
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
              <th>Detail</th>
              <td><textarea name="detail" cols="30" rows="10" class="form-control"></textarea></td>
            </tr>
            <tr>
              <th>Image</th>
              <td><input type="file" name="cat_image" /></td>
            </tr>
            <tr>
              <th>Detail</th>
              <td><textarea name="detail" cols="30" rows="10" class="form-control"></textarea></td>
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
    <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
  </div>

</div>
<!-- /.container-fluid -->
@endsection