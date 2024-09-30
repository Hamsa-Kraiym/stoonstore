@extends('master')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">{{ __('Item Data') }}</h5>
            </div>
            <div class="card-body">
                <div id="alert-pos"></div>
                <form id="itemForm" method="post"  enctype="multipart/form-data" action="">
                    @csrf
                <div class="row mb-24 gy-3 align-items-center">
                    <label class="form-label mb-0 col-sm-2">{{ __('Item Name') }}</label>
                    <div class="col-sm-10 ">
                        <input type="text" name="itemName" id="itemName" class="form-control" 
                            value="{{ $item->name }}" placeholder="{{ __('Enter item name')}}" required />
                        <div class="invalid-feedback"></div>
                    </div>
                </div>
                <div class="row mb-24 gy-3 align-items-center">
                    <label class="form-label mb-0 col-sm-2">{{ __('Item Category') }}</label>
                    <div class="col-sm-10">
                        <select class="form-select" name="itemCat" id="itemCat" required>
                            @foreach ($categories as $category)
                            <option value="{{ $category->id }}" @if ($item->category == $category->id) {{ ' selected="selected" ' }} @endif>{{ $category->name }}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback"></div>
                    </div>
                </div>
                <div class="row mb-24 gy-3 align-items-center">
                    <label class="form-label mb-0 col-sm-2">{{ __('Item Image') }}</label>
                    <div class="col-sm-10">
                        @if (!empty($item->picture))
                        <img src="{{ 'data:' }}{{ $item->picType }}{{ ';base64,' }}{{ $item->picture }}" class="h-60-px w-60-px flex-shrink-0 me-12 radius-8">
                        @endif
                        <input class="form-control" type="file" name="itemImage" id="itemImage">
                        <div class="invalid-feedback"></div>
                    </div>
                </div>
                <button type="button" id="saveItem" class="btn btn-primary-600">Save</button>
                <input type="hidden" name="itemID" id="itemID" value="{{ $item->id }}" />
                </form>
            </div>
        </div>
    </div>
</div>
@endsection