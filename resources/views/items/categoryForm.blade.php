@extends('master')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">{{ __('Category Data') }}</h5>
            </div>
            <div class="card-body">
                <div id="alert-pos"></div>
                <form id="categoryForm" method="post">
                    @csrf
                <div class="row mb-24 gy-3 align-items-center">
                    <label class="form-label mb-0 col-sm-2">{{ __('Category Name') }}</label>
                    <div class="col-sm-10">
                        <input type="text" name="catName" id="catName" class="form-control" 
                            value="{{ $category->name }}" placeholder="{{ __('Enter category name')}}" required>
                            <div class="invalid-feedback"></div>
                    </div>
                </div>
                <div class="row mb-24 gy-3 align-items-center">
                    <label class="form-label mb-0 col-sm-2">{{ __('Category Description') }}</label>
                    <div class="col-sm-10">
                        <textarea name="catDesc" id="catDesc" class="form-control" rows="4" 
                            placeholder="{{ __('Enter short description') }}" required>{{ $category->description }}</textarea>
                            <div class="invalid-feedback"></div>
                    </div>
                </div>
                <div class="row mb-24 gy-3 align-items-center">
                    <label class="form-label mb-0 col-sm-2">{{ __('Category Code') }}</label>
                    <div class="col-sm-10">
                        <input type="text" id="catCode" name="catCode" class="form-control" 
                            value="{{ $category->code }}" placeholder="{{ __('Enter category coding')}}" required>
                            <div class="invalid-feedback"></div>
                    </div>
                </div>
                <button type="button" id="saveCategory" class="btn btn-primary-600">Save</button>
                <input type="hidden" name="catID" id="catID" value="{{ $category->id }}" />
                </form>
            </div>
        </div>
    </div>
</div>
@endsection