@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="row justify-content-center">
        <div class="col-sm-12 col-md-4 mb-4">
            <div class="card shadow-sm">
                <div class="card-body text-center">
                    <i class="fas fa-edit fa-3x text-primary mb-3"></i>
                    <h5 class="card-title">Edit Blog Post</h5>
                    <p class="card-text">Manage and edit your blog posts with ease.</p>
                    <a href="{{ route('blogs.index') }}"  class="btn btn-primary">Go to Blog</a>
                </div>
            </div>
        </div>

        <div class="col-sm-12 col-md-4 mb-4">
            <div class="card shadow-sm">
                <div class="card-body text-center">
                    <i class="fas fa-question-circle fa-3x text-primary mb-3"></i>
                    <h5 class="card-title">FAQ</h5>
                    <p class="card-text">Update and manage your FAQs.</p>
                    <a href="#" class="btn btn-primary">Go to FAQ</a>
                </div>
            </div>
        </div>

        <div class="col-sm-12 col-md-4 mb-4">
            <div class="card shadow-sm">
                <div class="card-body text-center">
                    <i class="fas fa-book fa-3x text-primary mb-3"></i>
                    <h5 class="card-title">Prosper Guide</h5>
                    <p class="card-text">View and edit the Prosper Guide content.</p>
                    <a href="#" class="btn btn-primary">Go to Guide</a>
                </div>
            </div>
        </div>
    </div>
@endsection
