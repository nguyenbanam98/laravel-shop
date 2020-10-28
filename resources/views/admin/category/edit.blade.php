@extends('layouts.admin')

@section('title')

<title>Trang chu</title>

@endsection

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    @include('partials.content-header', ['name' => 'Category', 'key' => 'Edit'])

    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
           <div class="row">
            <div class="container">
                <div class="col-md-6">
                <form action="{{route('admin.categories.update', ['id' => $category->id])}}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="category">Ten danh muc</label>
                            <input type="text" value="{{$category->name}}" class="form-control" name="category" id="category" placeholder="Nhap ten danh muc">
                        </div>
                        <div class="form-group">
                            <label for="categorySelect">Chon danh muc</label>
                            <select class="form-control" name="parent_id" id="categorySelect">
                                <option value="0">Chon danh muc cha</option>
                                {!! $htmlOption !!}
                            </select>
                            </div>
                    
                        <button type="submit" class="btn btn-primary">Sua</button>
                        </form>
                </div>
            </div>
     
           </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
@endsection
