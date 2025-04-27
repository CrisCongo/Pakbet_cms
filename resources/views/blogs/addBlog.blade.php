@extends('layouts.app')

@section('title', 'Add Blog')

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
        width: 100%;
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
    .preview-container {
        padding: 20px;
        border: 1px solid #ccc;
        border-radius: 8px;
        background-color: #f8f9fa;
        max-width: 800px;
        width: 100%;
    }
    .flex-container {
        display: flex;
        gap: 20px;
        justify-content: center;
        align-items: flex-start;
        flex-wrap: wrap;
    }
    .preview-container, .card-custom {
        width: 45%;
    }
    @media (max-width: 768px) {
        .preview-container, .card-custom {
            width: 100%;
        }
    }
</style>

<div class="content-container flex-grow-1">
    <div class="container py-5">
        <div class="flex-container">

            <!-- Live Preview Section -->
            <div class="preview-container">
                <h3>Live Preview</h3>
                <h4 id="preview-title">Title will appear here</h4>
                <p id="preview-category">Category will appear here</p>
                <p id="preview-tags">Tags will appear here</p>
                <p id="preview-content">Content will appear here</p>
                <p id="preview-publish-date">Publish Date will appear here</p>
                <p id="preview-status">Status will appear here</p>
            </div>

            <!-- Form Card Section -->
            <div class="card card-custom">
                <h2 class="fw-bold text-center mb-4">Add Blog</h2>

                <form action="#" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="title" name="title" placeholder="Blog Title" oninput="updatePreview()">
                        <label for="title">Title</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="category" name="category" placeholder="Category" oninput="updatePreview()">
                        <label for="category">Category</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="tags" name="tags" placeholder="Tags" oninput="updatePreview()">
                        <label for="tags">Tags (comma-separated)</label>
                    </div>

                    <div class="mb-3">
                        <label for="cover_image" class="form-label">Cover Image</label>
                        <input class="form-control" type="file" id="cover_image" name="cover_image">
                    </div>

                    <div class="mb-3">
                        <label for="content" class="form-label">Content</label>
                        <textarea id="content" name="content" class="form-control" rows="5" oninput="updatePreview()"></textarea>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="date" class="form-control" id="publish_date" name="publish_date" oninput="updatePreview()">
                        <label for="publish_date">Publish Date</label>
                    </div>

                    <div class="form-floating mb-4">
                        <select class="form-select" id="status" name="status" onchange="updatePreview()">
                            <option value="">Select Status</option>
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
</div>

@endsection

@push('scripts')
<script>
    function updatePreview() {
        const title = document.getElementById('title').value;
        const category = document.getElementById('category').value;
        const tags = document.getElementById('tags').value;
        const content = document.getElementById('content').value;
        const publishDate = document.getElementById('publish_date').value;
        const status = document.getElementById('status').value;

        document.getElementById('preview-title').innerText = title || 'Title will appear here';
        document.getElementById('preview-category').innerText = category || 'Category will appear here';
        document.getElementById('preview-tags').innerText = tags || 'Tags will appear here';
        document.getElementById('preview-content').innerText = content || 'Content will appear here';
        document.getElementById('preview-publish-date').innerText = publishDate ? new Date(publishDate).toLocaleDateString() : 'Publish Date will appear here';
        document.getElementById('preview-status').innerText = status || 'Status will appear here';
    }
</script>
@endpush
