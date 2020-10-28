@extends('layouts.admin')

@section('title')
    <title>Trang chu</title>
@endsection

@push('css-plugins')
    <link href="{{asset('admins/product/index/list.css')}}" rel="stylesheet" />
@endpush

@section('content')

    <div class="content-wrapper">
        @include('partials.content-header', ['name' => 'Slider', 'key' => 'Add'])

        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <a href="{{route('admin.sliders.create')}}" class="btn btn-success float-right m-2">Add</a>
                    </div>
                    <div class="col-md-12">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Tên slider</th>
                                <th scope="col">Desciption</th>
                                <th scope="col">Hình ảnh</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($sliders as $slider)

                                    <tr>
                                        <th scope="row">{{ $slider->id }}</th>
                                        <td>{{ $slider->name }}</td>
                                        <td>{{ $slider->description }}</td>
                                        <td>
                                            <img class="product_image_150_100" src="{{ $slider->image_path }}" alt="">

                                        </td>
                                        <td>
                                            <a href="{{route('admin.sliders.edit', ['id' => $slider->id])}}"
                                            class="btn btn-default">Edit</a>
                                            <a href=""
                                                data-url="{{ route('admin.sliders.delete', ['id' => $slider->id]) }}"
                                               class="btn btn-danger action_delete">Delete</a>

                                        </td>
                                </tr>
                                @endforeach


                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-12">
                       {{ $sliders->links() }}
                    </div>

                </div>
            </div>
        </div>

    </div>

@endsection


@push('scripts')

   <script src="{{asset('vendors/sweetalert2/sweetalert2.js')}}"></script>

    <script src="{{asset('admins/slider/index/delete.js')}}"></script>

@endpush