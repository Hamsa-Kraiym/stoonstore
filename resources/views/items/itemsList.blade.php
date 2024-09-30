@extends('master')
@section('content')
<div class="card basic-data-table">
    <div class="card-header">
        <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
            <h5 class="card-title mb-0">{{ __($title) }}</h5>
            <ul class="d-flex align-items-center gap-2">
                <li class="fw-medium">
                    <a href="/newItemForm" type="button" class="btn btn-outline-primary-600 radius-8 px-20 py-11 d-flex align-items-center gap-2" fdprocessedid="gnpbrm">
                        <iconify-icon icon="ic:baseline-plus"></iconify-icon>New Item</a>
                </li>
            </ul>
        </div>
    </div>
    <div class="card-body">
        <div id="alert-pos"></div>
        <table class="table bordered-table mb-0" id="itemsList" data-page-length='10'>
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Category</th>
                    <th scope="col">Image</th>
                    <th scope="col">Create Date</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($items as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->categoryInf->name }}</td>
                    <td>
                    @if (!empty($item->picture))
                        <img src="{{ 'data:' }}{{ $item->picType }}{{ ';base64,' }}{{ $item->picture }}" class="h-60-px w-60-px flex-shrink-0 me-12 radius-8">
                    @else
                        <label class="upload-file h-60-px w-60-px border input-form-light radius-8 overflow-hidden border-dashed bg-neutral-50 d-flex align-items-center flex-column justify-content-center gap-1">
                            <iconify-icon icon="solar:camera-outline" class="text-xl text-secondary-light"></iconify-icon>
                        </label>
                    @endif
                    </td>
                    <td>{{ $item->created_at }}</td>
                    <td>
                        <button item-id="{{ $item->id }}" class="w-32-px h-32-px bg-success-focus text-success-main rounded-circle d-inline-flex align-items-center justify-content-center edit-item">
                            <iconify-icon icon="lucide:edit"></iconify-icon>
                        </button>
                        <button item-id="{{ $item->id }}" data-bs-toggle="modal" data-bs-target="#confirmDeleteItem" 
                            class="w-32-px h-32-px bg-danger-focus text-danger-main rounded-circle d-inline-flex align-items-center justify-content-center delete-item">
                            <iconify-icon icon="mingcute:delete-2-line"></iconify-icon>
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="confirmDeleteItem" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <!--<div class="modal-header">
          <h5 class="modal-title" id="deleteModalLabel">{{ __('Delete Item') }}</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>-->
        <div class="modal-body">
            <p>{{ __('Are you sure you whant to delete this item?') }}</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Cancel') }}</button>
          <button type="button" id="deleteItem" class="btn btn-primary">{{ __('Delete') }}</button>
          <input type="hidden" id="p_itemID" value="" />
        </div>
      </div>
    </div>
  </div>
@endsection
