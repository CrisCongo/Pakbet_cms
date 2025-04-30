@extends('layouts.app')

@section('title', 'Add Guide')

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
        flex-wrap: wrap;
        justify-content: center;
        align-items: flex-start;
    }
    .card-custom, .preview-container {
        width: 100%;
        max-width: 48%;
    }
    @media (max-width: 768px) {
        .card-custom, .preview-container {
            max-width: 100%;
        }
    }
    #preview-overview,
    #preview-career,
    #preview-health,
    #preview-love,
    #preview-wealth{
        word-break: break-word;
        overflow-wrap: break-word;
    }
</style>

<div class="content-container flex-grow-1">
    <div class="container py-5">
        <div class="flex-container">
            <div class="card card-custom">
                <h2 class="fw-bold text-center mb-4">Add Prosper Guide</h2>
                <form action="#" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

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

                    <div class="form-floating mb-3">
                        <input type="date" class="form-control" id="publish_date" name="publish_date" value="#">
                        <label for="publish_date">Publish Date</label>
                    </div>

                    <div class="mb-3">
                        <label for="overview" class="form-label">Overview</label>
                        <textarea id="overview" name="overview" class="tinymce-editor">#</textarea>
                    </div>

                    <div class="mb-3">
                        <label for="career" class="form-label">Career</label>
                        <textarea id="career" name="career" class="tinymce-editor">#</textarea>
                    </div>

                    <div class="mb-3">
                        <label for="health" class="form-label">Health</label>
                        <textarea id="health" name="health" class="tinymce-editor">#</textarea>
                    </div>

                    <div class="mb-3">
                        <label for="love" class="form-label">Love</label>
                        <textarea id="love" name="love" class="tinymce-editor">#</textarea>
                    </div>

                    <div class="mb-3">
                        <label for="wealth" class="form-label">Wealth</label>
                        <textarea id="wealth" name="wealth" class="tinymce-editor">#</textarea>
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
                        <a href="{{ route('guide.index') }}" class="btn btn-cancel me-2">Cancel</a>
                        <button type="submit" class="btn btn-custom">Save Changes</button>
                    </div>
                </form>
            </div>
            <div class="preview-container" style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">
                <h2 class="fw-bold text-center mb-4">Blog Preview</h2>
                <h2 id="preview-zodiac" class="fw-bold mb-1 text-uppercase" style="font-weight: 800; font-size: 30px; margin-bottom: 8px; color: #222;">Zodiac will appear here</h2>
                <p id="preview-date" class="text-uppercase text-muted mb-4">OVERALL FORECAST OF [YEAR]</p>

                <div class="accordion" id="previewAccordion">
                    @foreach (['overview', 'career', 'health', 'love', 'wealth'] as $section)
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="heading-{{ $section }}">
                                <button class="accordion-button {{ $section !== 'overview' ? 'collapsed' : '' }}" type="button"
                                    data-bs-toggle="collapse"
                                    data-bs-target="#collapse-{{ $section }}"
                                    aria-expanded="{{ $section === 'overview' ? 'true' : 'false' }}"
                                    aria-controls="collapse-{{ $section }}">
                                    {{ ucfirst($section) }}
                                </button>
                            </h2>
                            <div id="collapse-{{ $section }}" class="accordion-collapse collapse {{ $section === 'overview' ? 'show' : '' }}"
                                aria-labelledby="heading-{{ $section }}" data-bs-parent="#previewAccordion">
                                <div class="accordion-body" id="preview-{{ $section }}">
                                    {{ ucfirst($section) }} content will appear here
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function updatePreview() {
        const publishDate = document.getElementById('publish_date').value;
        const zodiac = document.getElementById('zodiac').value;

        const year = publishDate ? new Date(publishDate).getFullYear() : '[YEAR]';
        document.getElementById('preview-zodiac').innerText = zodiac || 'Zodiac will appear here';
        document.getElementById('preview-date').innerText = `OVERALL FORECAST OF ${year}`;

        ['overview', 'career', 'health', 'love', 'wealth'].forEach(field => {
            const content = tinymce.get(field)?.getContent() || `${field.charAt(0).toUpperCase() + field.slice(1)} content will appear here`;
            document.getElementById(`preview-${field}`).innerHTML = content;
        });
    }

    document.addEventListener('DOMContentLoaded', () => {
        document.getElementById('zodiac').addEventListener('change', updatePreview);
        document.getElementById('publish_date').addEventListener('change', updatePreview);
    });
</script>
@endpush
