@extends('master')
@section('content')
<div class="card basic-data-table">
    <div class="card-header">
        <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
            <h5 class="card-title mb-0">{{ __($title) }}</h5>
            <ul class="d-flex align-items-center gap-2">
                <li class="fw-medium">
                    <a href="/newCatForm" type="button" class="btn btn-outline-primary-600 radius-8 px-20 py-11 d-flex align-items-center gap-2" fdprocessedid="gnpbrm">
                        <iconify-icon icon="ic:baseline-plus"></iconify-icon>New Category</a>
                </li>
            </ul>
        </div>
    </div>
    <div class="card-body">
        <div id="alert-pos"></div>
        <table class="table bordered-table mb-0" id="categoriesList" data-page-length='10'>
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Description</th>
                    <th scope="col">Code</th>
                    <th scope="col">Create Date</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                <tr>
                    <td>{{ $category->id }}</td>
                    <td>{{ $category->name }}</td>
                    <td>{{ $category->description }}</td>
                    <td>{{ $category->code }}</td>
                    <td>{{ $category->created_at }}</td>
                    <td>
                        <button cat-id="{{ $category->id }}" class="w-32-px h-32-px bg-success-focus text-success-main rounded-circle d-inline-flex align-items-center justify-content-center edit-category">
                            <iconify-icon icon="lucide:edit"></iconify-icon>
                        </button>
                        <button cat-id="{{ $category->id }}"  data-bs-toggle="modal" data-bs-target="#confirmDeleteCategory" 
                            class="w-32-px h-32-px bg-danger-focus text-danger-main rounded-circle d-inline-flex align-items-center justify-content-center delete-category">
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
<div class="modal fade" id="confirmDeleteCategory" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-body">
            <p>{{ __('Are you sure you whant to delete this category?') }}</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Cancel') }}</button>
          <button type="button" id="deleteCategory" class="btn btn-primary">{{ __('Delete') }}</button>
          <input type="hidden" id="p_catID" value="" />
        </div>
      </div>
    </div>
  </div>
@endsection
