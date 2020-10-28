@extends('layouts.admin')

@section('title')

<title>Add product</title>

@endsection

@push('css-plugins')
    <link href="{{asset('vendors/select2/select2.min.css')}}" rel="stylesheet" />
    <link href="{{asset('admins/product/add/add.css')}}" rel="stylesheet" />
@endpush

@section('content')

<div class="content-wrapper mb-5">
    <!-- Content Header (Page header) -->
    @include('partials.content-header', ['name' => 'Product', 'key' => 'Add'])
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
           <div class="row">
             
            <div class="container">
                <form action="{{route('admin.products.store')}}" method="post" enctype="multipart/form-data">
                    @csrf

                    <div class="col-md-6">
                            <div class="form-group">
                                <label>Tên sản phẩm</label>
                                <input type="text"
                                    class="form-control @error('name') is-invalid @enderror"
                                    name="name"
                                    placeholder="Nhập tên sản phẩm"
                                    value="{{old('name')}}"
                                >
                               
                            </div>
                            @error('name')
                            <div class="alert alert-danger" role="alert">
                                {{$message}}
                              </div>
                            @enderror
                             <div class="form-group">
                                <label>Giá sản phẩm</label>
                                <input type="text"
                                    class="form-control"
                                    name="price"
                                    placeholder="Nhập giá sản phẩm"
                                    value="{{old('price')}}"

                                >
                            </div>

                            <div class="form-group">
                                <label>Ảnh đại diện</label>
                                <input type="file"
                                    class="form-control-file"
                                    name="feature_image_path"
                                >
                            </div>

                            <div class="form-group">
                                <label>Ảnh chi tiết</label>
                                <input type="file"
                                    multiple
                                    class="form-control-file"
                                    name="image_path[]"
                                >
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
                                    
                                </select>
                            </div>

                           
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Nhập nội dung</label>
                            <textarea name="contents" class="form-control my-editor" rows="10">
                                {{old('contents')}}

                            </textarea>
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
