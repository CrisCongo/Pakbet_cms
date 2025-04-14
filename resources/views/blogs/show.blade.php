@extends('layouts.app')
@section('content')
<div class="container mt-5">
    <div class="card shadow">
        <div class="card-header bg-danger text-white">
            <h4>All Blog Posts</h4>
        </div>
        <div class="card-body" style="background-color: #FDF9EE;">
            <table class="table table-bordered table-hover text-center align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Tags</th>
                        <th>Cover</th>
                        <th>Content</th>
                        <th>Publish Date</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Feng Shui Basics</td>
                        <td>Guides</td>
                        <td>feng shui, beginner</td>
                        <td><img src="https://via.placeholder.com/50" class="img-thumbnail"></td>
                        <td>A quick intro to feng shui principles...</td>
                        <td>April 15, 2025</td>
                        <td><span class="badge bg-success">Published</span></td>
                        <td>
                            <button class="btn btn-sm btn-warning" disabled>Edit</button>
                        </td>
                    </tr>
                    <tr>
                        <td>House Placement Tips</td>
                        <td>Blog</td>
                        <td>placement, home, tips</td>
                        <td><img src="https://via.placeholder.com/50" class="img-thumbnail"></td>
                        <td>Choosing the right direction for your home...</td>
                        <td>March 30, 2025</td>
                        <td><span class="badge bg-secondary">Draft</span></td>
                        <td>
                            <button class="btn btn-sm btn-warning" disabled>Edit</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
