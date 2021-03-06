@extends('layouts.dashboard.app')

@section('content')

    <div class="content-wrapper">

        <section class="content-header">

            <h1>@lang('site.products')</h1>

            <ol class="breadcrumb">
                <li class=""><a href="{{ route('dashboard.welcome') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a></li>
                <li class=""><a href="{{ route('dashboard.products.index') }}"> @lang('site.products')</a></li>
                <li class="active"><i class="fa fa-dashboard"></i> @lang('site.add')</li>
            </ol>
        </section>

        <section class="content">
            <div class="box box-primary">

                <div class="box-header">
                    <h3 class="box-title">@lang('site.add')</h3>
                </div>

                <div class="box-body">

                    @include('partials._errors')
                    <form action="{{ route('dashboard.products.store') }}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        {{ method_field('post') }}

                        <div class="form-group">
                            <label>@lang('site.categories')</label>
                            <select name="category_id" class="form-control">
                                <option value="">@lang('site.all_categories')</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        @foreach (config('translatable.locales') as $locale)
                            <div class="form-group">
                                <label>@lang('site.' . $locale . '.name')</label>
                                <input class="form-control" type="text" name="{{ $locale }}[name]" value="{{ old($locale . '.name') }}">
                            </div>

                            <div class="form-group">
                                <label>@lang('site.' . $locale . '.description')</label>
                                <textarea class="form-control ckeditor" name="{{ $locale }}[description]">{{ old($locale . '.description') }}</textarea>
                            </div>
                        @endforeach

                        <div class="form-group">
                            <label>@lang('site.image')</label>
                            <input class="form-control image" type="file" name="image">
                        </div>

                        <div class="form-group">
                            <img src="{{ asset('uploads/product_images/default.png') }}" style="width:100px" class="img-thumbnail image-preview">
                        </div>

                        <div class="form-group">
                            <label>@lang('site.purchase_price')</label>
                            <input class="form-control" type="number" name="purchase_price" value="{{ old('purchase_price') }}">
                        </div>

                        <div class="form-group">
                            <label>@lang('site.sale_price')</label>
                            <input class="form-control" type="number" name="sale_price" value="{{ old('sale_price') }}">
                        </div>

                        <div class="form-group">
                            <label>@lang('site.stock')</label>
                            <input class="form-control" type="number" name="stock" value="{{ old('stock') }}">
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-plus"></i>
                                @lang('site.add')
                            </button>
                        </div>

                    </form>

                </div>

            </div>
        </section>

    </div><!-- end of content wrapper -->


@endsection
