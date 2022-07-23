@extends('layout')
@section('meta_desc',$meta_desc)
@section('title', $title)
@section('content')
<div class="container-fluid">

  <ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="index.html">Dashboard</a>
    </li>
    <li class="breadcrumb-item active">Overview</li>
  </ol>

  <div class="card mb-3">
    <div class="card-header">
      <i class="fas fa-table"></i> Categories
      <a href="{{url('admin/post/create')}}" class="float-right btn btn-sm btn-dark">Add Data</a>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>#</th>
              <th>Title</th>
              <th>Category</th>
              <th>Thumb</th>
              <th>Full Image</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach($data as $post)
            <tr>
              <td>{{$post->id}}</td>
              <td>{{$post->title}}</td>
              <td>{{$post->category->title}}</td>
              <td><img src="{{ asset('imgs/thumb').'/'.$post->thumb }}" width="100" /></td>
              <td><img src="{{ asset('imgs/full').'/'.$post->full_img }}" width="100" /></td>
              <td>
                <a class="btn btn-info btn-sm" href="{{url('admin/post/'.$post->id.'/edit')}}">Update</a>
                <a onclick="return confirm('Are you sure you want to delete?')" class="btn btn-danger btn-sm"
                  href="{{url('admin/post/'.$post->id.'/delete')}}">Delete</a>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
    <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
  </div>

</div>
@endsection