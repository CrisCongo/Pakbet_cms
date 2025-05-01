@php
    use Illuminate\Support\Str;
@endphp
@extends('layouts.app')
@section('title', 'Blogs')
@section('content')
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

        .export-btn {
            background-color: #FFD700;
            color: #8B0000;
            border: none;
            padding: 8px 12px;
            font-weight: bold;
            border-radius: 5px;
            margin-bottom: 10px;
        }

        .table-responsive {
            overflow-x: auto;
            max-width: 100%;
        }

        .dataTables_filter {
            display: flex;
            justify-content: flex-end;
            width: 100%;
            flex-wrap: wrap;
            margin-bottom: 10px;
        }

        .dataTables_filter label {
            width: 100%;
            display: flex;
            justify-content: flex-end;
        }

        .dataTables_filter input {
            width: 100%;
            max-width: 250px;
            min-width: 150px;
            padding: 5px;
        }

        @media (max-width: 768px) {
            .dataTables_filter {
                justify-content: center;
            }

            .btn-group-mobile {
                flex-direction: column;
                gap: 5px;
                align-items: center;
            }
        }
    </style>

    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <h1 class="m-0">Manage Blogs</h1>
            </div>
        </div>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center" style="background-color: rgba(162, 32, 26, 1);">
                                <h3 class="card-title text-white">Blogs List</h3>
                            </div>

                            <div class="d-flex flex-wrap gap-2 m-3 btn-group-mobile">
                                <button id="exportExcel" class="btn btn-sm text-white" style="background-color: rgba(162, 32, 26, 1);">
                                    <i class="fas fa-file-excel"></i> Export Excel
                                </button>
                            </div>

                            <div class="d-flex flex-wrap gap-2 m-3 btn-group-mobile">
                                <button class="btn btn-success btn-sm bulk-action" data-action="activate">Publish Selected</button>
                                <button class="btn btn-danger btn-sm bulk-action" data-action="deactivate">Archive Selected</button>
                            </div>

                            <div class="table-responsive">
                                <table id="blogTable" class="table">
                                    <thead>
                                        <tr>
                                            <th><label>
                                                Select All
                                                <input type="checkbox" id="select-all">
                                            </label></th>
                                            <th>Blog ID</th>
                                            <th>Title</th>
                                            <th>Category</th>
                                            <th>Tags</th>
                                            <th>Status</th>
                                            <th>Publish Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($blogs as $blog)
                                            <tr id="blogRow-{{ $blog->blogID }}">
                                                <td>
                                                    <input type="checkbox" class="blog-checkbox" name="blogs_checkbox" value="{{ $blog->blogID }}">
                                                </td>
                                                <td>{{ $blog->blogID }}</td>
                                                <td>{!! Str::limit(strip_tags($blog->title), 20) !!}</td>
                                                <td>{!! Str::limit(strip_tags($blog->category), 20) !!}</td>
                                                <td>{!! Str::limit(strip_tags($blog->tags), 20) !!}</td>
                                                <td><span class="badge" data-status="{{ strtolower($blog->status) }}">
                                                    {{ ucfirst($blog->status) }}
                                                </span></td>
                                                <td>{{ \Carbon\Carbon::parse($blog->publish_date)->format('m/d/Y') }}</td>
                                                <td>
                                                    <a href="{{ route('blog.edit', $blog->blogID) }}"
                                                       class="btn btn-outline-dark btn-sm edit-btn"
                                                       data-bs-toggle="tooltip"
                                                       data-bs-placement="top"
                                                       title="Edit Blog Details">
                                                       Edit
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <div class="d-flex flex-wrap gap-2 m-3 btn-group-mobile">
                                <a href="{{ route('blog.add') }}"
                                   class="btn btn-sm text-white"
                                   style="background-color: rgba(162, 32, 26, 1);"
                                   data-bs-toggle="tooltip"
                                   data-bs-placement="top"
                                   title="Add Blogs Here">
                                   Add Blog
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/xlsx@0.18.5/dist/xlsx.full.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function () {

            function ucwords(str) {
                return str.replace(/\b\w/g, function(char) {
                    return char.toUpperCase();
                });
            }

            function updateBadgeStatus(status, badge) {
                status = status.toLowerCase();

                if (status === 'archive') status = 'archived';

                const statusClasses = {
                    'published': 'bg-success',
                    'archived': 'bg-danger',
                    'draft': 'bg-secondary'
                };

                console.log('Updating badge for status:', status);

                badge.text(ucwords(status));
                badge.removeClass('bg-success bg-danger bg-secondary').addClass(statusClasses[status]);

                console.log('Applied class:', statusClasses[status]);
            }

            $('.badge').each(function () {
                const status = $(this).data('status');
                console.log('Status from data attribute:', status);
                if (status) {
                    updateBadgeStatus(status, $(this));
                }
            });

            $('#select-all').on('click', function () {
                var isChecked = $(this).prop('checked');
                $('input[name="blogs_checkbox"]').prop('checked', isChecked);
            });

            function handleBulkAction(action) {
                var selectedBlogs = [];
                $('input[name="blogs_checkbox"]:checked').each(function () {
                    selectedBlogs.push($(this).val());
                });

                if (selectedBlogs.length > 0) {
                    let actionText = action === 'publish' ? 'publish' : 'archive';
                    let confirmationText = action === 'publish' ? 'publish the selected blogs.' : 'archive the selected blogs.';

                    Swal.fire({
                        title: 'Are you sure?',
                        text: `You are about to ${confirmationText}`,
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#28a745',
                        cancelButtonColor: '#d33',
                        confirmButtonText: `Yes, ${actionText} them!`
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                url: '{{ route('blog.bulkUpdate') }}',
                                method: 'POST',
                                data: {
                                    _token: '{{ csrf_token() }}',
                                    action: action,
                                    blogs: selectedBlogs
                                },
                                success: function (response) {
                                    if (response.success) {
                                        selectedBlogs.forEach(function (id) {
                                            let row = $('#blogRow-' + id);
                                            let badge = row.find('td:eq(5) span');
                                            updateBadgeStatus(action === 'publish' ? 'published' : 'archived', badge);
                                            row.find('input.blog-checkbox').prop('checked', false);
                                        });
                                        $('#select-all').prop('checked', false);

                                        Swal.fire({
                                            icon: 'success',
                                            title: 'Success',
                                            text: `Blogs ${actionText} successfully!`,
                                            confirmButtonColor: '#a2201a'
                                        });
                                    } else {
                                        Swal.fire({
                                            icon: 'error',
                                            title: 'Error',
                                            text: 'Could not update blogs.',
                                            confirmButtonColor: '#a2201a'
                                        });
                                    }
                                }
                            });
                        }
                    });
                } else {
                    Swal.fire({
                        icon: 'warning',
                        title: 'No Selection',
                        text: 'Please select at least one blog.',
                        confirmButtonColor: '#a2201a'
                    });
                }
            }

            $('.bulk-action[data-action="activate"]').on('click', function () {
                handleBulkAction('publish');
            });

            $('.bulk-action[data-action="deactivate"]').on('click', function () {
                handleBulkAction('archive');
            });

            $('#exportExcel').on('click', function () {
                var wb = XLSX.utils.table_to_book(document.getElementById('blogTable'), { sheet: "Blogs" });
                XLSX.writeFile(wb, 'blogs.xlsx');
            });
        });
    </script>
@endsection
