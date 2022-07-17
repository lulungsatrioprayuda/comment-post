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

                <form method="post" action="{{url('admin/post')}}" enctype="multipart/form-data">
                    @csrf
                    <table class="table table-bordered">
                        <tr>
                            <th>Comment auto Approve</th>
                            <td><input type="text" class="form-control" name="comment_auto"></td>
                        </tr>
                        <tr>
                            <th>User Auto Approve</th>
                            <td><input type="text" class="form-control" name="user_auto"></td>
                        </tr>
                        <tr>
                            <th>Recent Post Limit</th>
                            <td><input type="text" class="form-control" name="recent_limit"></td>
                        </tr>
                        <tr>
                            <th>Popular Post Limit</th>
                            <td><input type="text" class="form-control" name="popular_limit"></td>
                        </tr>
                        <tr>
                            <th>Recent Comment Limit</th>
                            <td><input type="text" class="form-control" name="recent_comment_limit"></td>
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