@extends('layouts.admin')

@section('title')

<title>Edit product</title>

@endsection

@push('css-plugins')
    <link href="{{asset('vendors/select2/select2.min.css')}}" rel="stylesheet" />
    <link href="{{asset('admins/product/add/add.css')}}" rel="stylesheet" />
@endpush

@section('content')

<div class="content-wrapper mb-5">
    <!-- Content Header (Page header) -->
    @include('partials.content-header', ['name' => 'Product', 'key' => 'Edit'])
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
           <div class="row">
            <div class="container">
                <form action="{{route('admin.products.update',['id'=>$product->id])}}" method="post" enctype="multipart/form-data">
                    @csrf

                    <div class="col-md-6">
                            <div class="form-group">
                                <label>Tên sản phẩm</label>
                                <input type="text"
                                    class="form-control"
                                    name="name"
                                    placeholder="Nhập tên sản phẩm"
                                    value="{{$product->name}}"
                                >
                            </div>
                            <div class="form-group">
                                <label>Giá sản phẩm</label>
                                <input type="text"
                                    class="form-control"
                                    name="price"
                                    placeholder="Nhập giá sản phẩm"
                                    value="{{$product->price}}"

                                >
                            </div>

                            <div class="form-group">
                                <label>Ảnh đại diện</label>
                                <input type="file"
                                    class="form-control-file"
                                    name="feature_image_path"
                                >
                            </div>

                           <div class="col-md-3">
                                <div class="card">
                                    <img src="{{ $product->feature_image_path }}" 
                                        style=" width: 130px;
                                                height: 100px;
                                                object-fit: cover;" 
                                        class="card-img-top" alt="">
                                </div>
                           </div>

                            <div class="form-group">
                                <label>Ảnh chi tiết</label>
                                <input type="file"
                                    multiple
                                    class="form-control-file"
                                    name="image_path[]"
                                >
                            </div>

                            <div class="col-md-12 container_image_detail">
                                <div class="row">
                                    @foreach($product->images as $producImageItem)
                                                <div class="col-md-3 mr-1">
                                                    <div class="card">
                                                        <img  src="{{ $producImageItem->image_path }}" class="card-img-top" alt="" style=" width: 130px;
                                                        height: 100px;
                                                        object-fit: cover;">
                                                    </div>
                                                </div>
                                    @endforeach
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Chọn danh mục</label>
                                <select class="form-control select2_init" name="category_id">
                                    <option value="">Chọn danh mục</option>
                                    {!! $htmlOption !!}
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Nhập tags cho sản phẩm</label>

                                <select name="tags[]" class="form-control tags_select_choose" multiple="multiple">
                                    @foreach($product->tags as $tagItem )
                                        <option value="{{ $tagItem->name }}" selected>{{ $tagItem->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                           
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Nhập nội dung</label>
                            <textarea name="contents" class="form-control my-editor" rows="10">{{$product->content}}</textarea>
                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>

                    </div>
                </form>

            </div>
     
           </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
@endsection

@push('scripts')

    <script src="{{asset('vendors/select2/select2.min.js')}}"></script>
    <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
    <script src="{{asset('admins/product/add/add.js')}}"></script>

@endpush
