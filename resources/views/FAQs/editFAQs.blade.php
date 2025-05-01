@extends('layouts.app')

@section('title', 'Edit FAQ')

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
    .preview-container {
        background-color: #ffffff;
        border: 1px solid #dee2e6;
        padding: 20px;
        border-radius: 12px;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
        max-width: 800px;
    }
    @media (max-width: 768px) {
        .preview-container, .card-custom {
            width: 100%;
        }
    }
    #preview-question,
    #preview-answer {
        word-break: break-word;
        overflow-wrap: break-word;
    }
</style>

<div class="content-container flex-grow-1">
    <div class="container py-5">
        <div class="flex-container" style="height: 75vh;">
            <div class="card card-custom"  style="flex: 1 1 45%; height: 100%;">
                <h2 class="fw-bold text-center mb-4">Edit FAQ</h2>

                <form action="{{ route('faq.update', $faq->faqID) }}" method="POST" enctype="multipart/form-data"  style="height: 100%; overflow-y: auto;">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="question" class="form-label">Question</label>
                        <textarea id="question" name="question" class="tinymce-editor">{{ $faq->question }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label for="answer" class="form-label">Answer</label>
                        <textarea id="answer" name="answer" class="tinymce-editor">{{ $faq->answer }}</textarea>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="date" class="form-control" id="publish_date" name="publish_date" value="{{ \Carbon\Carbon::parse($faq->publish_date)->format('Y-m-d') }}">
                        <label for="publish_date">Publish Date</label>
                    </div>

                    <div class="form-floating mb-4">
                        <select class="form-select" id="status" name="status">
                            <option value="draft" {{ $faq->status === 'draft' ? 'selected' : '' }}>Draft</option>
                            <option value="archived" {{ $faq->status === 'archived' ? 'selected' : '' }}>Archive</option>
                            <option value="published" {{ $faq->status === 'published' ? 'selected' : '' }}>Published</option>
                        </select>
                        <label for="status">Status</label>
                    </div>

                    <div class="d-flex justify-content-end">
                        <a href="{{ route('faqs.index') }}" class="btn btn-cancel me-2">Cancel</a>
                        <button type="submit" class="btn btn-custom">Save Changes</button>
                    </div>
                </form>
            </div>

            <div class="preview-container" style="flex: 1 1 45%; height: 100%;">
                <h3 class="fw-bold text-center mb-3">Live Preview</h3>
                <div class="p-4 rounded border bg-light overflow-auto" style="height: calc(100% - 60px);">
                    <h4 id="preview-question" class="fw-bold mb-3">Here's a question</h4>
                    <div id="preview-answer" class="mb-3">Here's an answer</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function updatePreview() {
        const questionContent = tinymce.get('question')?.getContent() || 'Here\'s a question';
        const answerContent = tinymce.get('answer')?.getContent() || 'Here\'s an answer';

        document.getElementById('preview-question').innerHTML = questionContent;
        document.getElementById('preview-answer').innerHTML = answerContent;
    }

    document.addEventListener('DOMContentLoaded', function () {
        updatePreview();
    });
</script>
@endpush
