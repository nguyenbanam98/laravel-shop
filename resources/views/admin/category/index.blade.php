@extends('layouts.admin')

@section('title')

<title>Trang chu</title>

@endsection

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    @include('partials.content-header', ['name' => 'Category', 'key' => 'List'])


    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                <a href="{{route('admin.categories.create')}}" class="btn btn-success float-right m-2">Add</a>
                </div>
                <div class="col-md-12">
                    <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">The Loai</th>
                            <th scope="col">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach($categories as $category)
                                <tr>
                                    <th scope="row">{{$category->id}}</th>
                                    <td>{{$category->name}}</td>
                                    <td>
                                        <a href="{{route('admin.categories.edit', ['id' => $category->id])}}" class="btn btn-primary">Edit</a>
                                        <a href="{{route('admin.categories.delete', ['id' => $category->id])}}" class="btn btn-danger">Xoa</a>
                                    </td>
                                </tr> 
                            @endforeach
                                              
                        </tbody>
                      </table>
                </div>
                <div class="col-md-12">
                    {{ $categories->links() }}
                </div>
              
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
@endsection
