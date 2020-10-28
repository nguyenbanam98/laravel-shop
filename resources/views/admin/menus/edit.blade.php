@extends('layouts.admin')

@section('title')

<title>Menu edit</title>

@endsection

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    @include('partials.content-header', ['name' => 'Menu', 'key' => 'Edit'])

    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
           <div class="row">
            <div class="container">
                <div class="col-md-6">
                <form action="{{route('admin.menus.update', ['id' => $menu->id])}}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="menu">Ten danh muc</label>
                            <input type="text" value="{{$menu->name}}" class="form-control" name="name" id="menu" placeholder="Nhap ten danh muc">
                        </div>
                        <div class="form-group">
                            <label for="menuSelect">Chon danh muc</label>
                            <select class="form-control" name="parent_id" id="menuSelect">
                                <option value="0">Chon danh muc cha</option>
                                {!! $optionSelect !!}
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
