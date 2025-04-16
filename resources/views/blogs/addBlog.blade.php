@extends('layouts.app')

@section('title', 'Edit Blog')

@section('content')

<style>
    body {
        background-color: #f8f9fa;
    }
    .card-custom {
        border-radius: 12px;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
        padding: 25px;
        background: #ffffff;
        max-width: 800px;
        margin: auto;
    }
    .form-control, .form-select {
        border-radius: 8px;
        font-size: 14px;
        height: 45px;
    }
    .form-control:focus, .form-select:focus {
        border-color: #007bff;
        box-shadow: 0 0 5px rgba(0, 123, 255, 0.2);
    }
    .btn-custom, .btn-cancel {
        padding: 12px 24px;
        font-size: 16px;
        border-radius: 8px;
        transition: 0.3s;
    }
    .btn-custom {
        background-color: #007bff;
        color: white;
    }
    .btn-custom:hover {
        background-color: #0056b3;
    }
    .btn-cancel {
        background-color: #dc3545;
        color: white;
    }
    .btn-cancel:hover {
        background-color: #bd2130;
    }
</style>

<div class="content-container flex-grow-1">
    <div class="container py-5">
        <div class="card card-custom">
            <h2 class="fw-bold text-center mb-4">Add Blog</h2>

            <form action="#" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="title" name="title" placeholder="Blog Title" value="#">
                    <label for="title">Title</label>
                </div>

                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="category" name="category" placeholder="Category" value="#">
                    <label for="category">Category</label>
                </div>

                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="tags" name="tags" placeholder="Tags" value="#">
                    <label for="tags">Tags (comma-separated)</label>
                </div>

                <div class="mb-3">
                    <label for="cover_image" class="form-label">Cover Image</label>
                    <input class="form-control" type="file" id="cover_image" name="cover_image">
                </div>

                <div class="mb-3">
                    <label for="content" class="form-label">Content</label>
                    <textarea id="content" name="content" class="tinymce-editor">#</textarea>
                </div>

                <div class="form-floating mb-3">
                    <input type="date" class="form-control" id="publish_date" name="publish_date" value="#">
                    <label for="publish_date">Publish Date</label>
                </div>

                <div class="form-floating mb-4">
                    <select class="form-select" id="status" name="status">
                        <option value="draft">Draft</option>
                        <option value="archive">Archive</option>
                        <option value="published">Published</option>
                    </select>
                    <label for="status">Status</label>
                </div>

                <div class="d-flex justify-content-end">
                    <a href="{{ route('blogs.index') }}" class="btn btn-cancel me-2">Cancel</a>
                    <button type="submit" class="btn btn-custom">Save Changes</button>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')


@endsection

