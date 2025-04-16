@extends('layouts.app')

@section('title', 'Edit Guide')

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
            <h2 class="fw-bold text-center mb-4">Edit Prosper Guide</h2>

            <form action="#" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="title" name="title" placeholder="Guide Title" value="#">
                    <label for="title">Title</label>
                </div>

                <div class="mb-3">
                    <label for="overview" class="form-label">Overview</label>
                    <textarea id="overview" name="overview" class="tinymce-editor">Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit</textarea>
                </div>

                <div class="mb-3">
                    <label for="career" class="form-label">Career</label>
                    <textarea id="career" name="career" class="tinymce-editor">Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit</textarea>
                </div>

                <div class="mb-3">
                    <label for="health" class="form-label">Health</label>
                    <textarea id="health" name="health" class="tinymce-editor">Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit</textarea>
                </div>

                <div class="mb-3">
                    <label for="love" class="form-label">Love</label>
                    <textarea id="love" name="love" class="tinymce-editor">Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit</textarea>
                </div>

                <div class="mb-3">
                    <label for="wealth" class="form-label">Wealth</label>
                    <textarea id="wealth" name="wealth" class="tinymce-editor">Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit</textarea>
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

                <div class="form-floating mb-4">
                    <select class="form-select" id="zodiac" name="zodiac">
                        <option value="rat">Rat</option>
                        <option value="ox">Ox</option>
                        <option value="tiger">Tiger</option>
                        <option value="rabbit">Rabbit</option>
                        <option value="dragon">Dragon</option>
                        <option value="snake">Snake</option>
                        <option value="horse">Horse</option>
                        <option value="goat">Goat</option>
                        <option value="monkey">Monkey</option>
                        <option value="rooster">Rooster</option>
                        <option value="dog">Dog</option>
                        <option value="pig">Pig</option>
                    </select>
                    <label for="status">Zodiac</label>
                </div>

                <div class="d-flex justify-content-end">
                    <a href="{{ route('guide.index') }}" class="btn btn-cancel me-2">Cancel</a>
                    <button type="submit" class="btn btn-custom">Save Changes</button>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')


@endsection

