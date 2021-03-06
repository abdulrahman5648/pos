@extends('layouts.dashboard.app')

@section('content')

    <div class="content-wrapper">

        <section class="content-header">

            <h1>@lang('site.users')</h1>

            <ol class="breadcrumb">
                <li class=""><a href="{{ route('dashboard.welcome') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a></li>
                <li class=""><a href="{{ route('dashboard.users.index') }}"> @lang('site.users')</a></li>
                <li class="active"><i class="fa fa-dashboard"></i> @lang('site.edit')</li>
            </ol>
        </section>

        <section class="content">
            <div class="box box-primary">

                <div class="box-header">
                    <h3 class="box-title">@lang('site.add')</h3>
                </div>

                <div class="box-body">

                    @include('partials._errors')
                    <form action="{{ route('dashboard.users.update', $user->id) }}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        {{ method_field('put') }}

                        <div class="form-group">
                            <label>@lang('site.first_name')</label>
                            <input class="form-control" type="text" name="first_name" value="{{ $user->first_name }}">
                        </div>

                        <div class="form-group">
                            <label>@lang('site.last_name')</label>
                            <input class="form-control" type="text" name="last_name" value="{{ $user->last_name }}">
                        </div>

                        <div class="form-group">
                            <label>@lang('site.email')</label>
                            <input class="form-control" type="email" name="email" value="{{ $user->email }}">
                        </div>

                        <div class="form-group">
                            <label>@lang('site.image')</label>
                            <input class="form-control image" type="file" name="image">
                        </div>

                        <div class="form-group">
                            <img src="{{ $user->image_path }}" style="width:100px" class="img-thumbnail image-preview">
                        </div>

                        <div class="form-group">
                            <label>@lang('site.permissions')</label>
                            <div class="nav-tabs-custom">

                                @php
                                    $models = ['users', 'categories', 'products', 'clients', 'orders'];
                                    $maps = ['create', 'read', 'update', 'delete'];
                                @endphp

                                <ul class="nav nav-tabs">
                                    @foreach ($models as $index=>$model)
                                        <li class="{{ $index == 0 ? 'active' : '' }}"><a href="#{{ $model }}" data-toggle="tab">@lang('site.' . $model)</a></li>
                                    @endforeach
                                </ul>

                                <div class="tab-content">

                                    @foreach ($models as $index=>$model)

                                        <div class="tab-pane {{ $index == 0 ? 'active' : '' }}" id="{{ $model }}">

                                            @foreach ($maps as $map)
                                                <label><input type="checkbox" name="permissions[]" {{ $user->hasPermission($map . '_' . $model) ? 'checked' : '' }} value="{{ $map . '_' . $model }}"> @lang('site.' . $map)</label>
                                            @endforeach

                                        </div>

                                    @endforeach

                                </div><!-- end of tab content -->

                            </div><!-- end of nav tabs -->

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-edit"></i>
                                @lang('site.edit')
                            </button>
                        </div>

                    </form>

                </div>

            </div>
        </section>

    </div><!-- end of content wrapper -->

@push('scripts')
    <script>
        // image preview
        $(".image").change(function () {

        if (this.files && this.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('.image-preview').attr('src', e.target.result);
            }

            reader.readAsDataURL(this.files[0]);
        }

        });
    </script>
@endpush
@endsection
