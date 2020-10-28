@extends('layouts.admin')

@section('title')
    <title>Settings</title>
@endsection




@section('content')

    <div class="content-wrapper">
        @include('partials.content-header', ['name' => 'Settings', 'key' => 'List'])

        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="btn-group float-right">
                            <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
                                Add setting
                                <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a href="{{ route('admin.settings.create') . '?type=Text' }}">Text</a></li>
                                <li><a href="{{ route('admin.settings.create') . '?type=Textarea' }}">Textarea</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Config key</th>
                                <th scope="col">Config value</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>

                           @foreach($settings as $setting)

                                <tr>
                                    <th scope="row">{{ $setting->id }}</th>
                                    <td>{{ $setting->config_key }}</td>
                                    <td>{{ $setting->config_value }}</td>
                                    <td>
                                        <a href="{{ route('admin.settings.edit', ['id' => $setting->id]) . '?type=' . $setting->type}}"
                                            class="btn btn-default">Edit</a>
                                            <a href=""
                                            data-url="{{ route('admin.settings.delete', ['id' => $setting->id]) }}"
                                           class="btn btn-danger action_delete">Delete</a>
 

                                    </td>
                                </tr>

                           @endforeach

                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-12">
                       {{ $settings->links() }}
                    </div>

                </div>
            </div>
        </div>

    </div>

@endsection

@push('scripts')

   <script src="{{asset('vendors/sweetalert2/sweetalert2.js')}}"></script>

    {{-- <script src="{{asset('admins/main.js')}}></script> --}}
    <script src="{{asset('admins/main.js')}}"></script>


@endpush