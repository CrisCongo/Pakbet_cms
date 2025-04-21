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
                                <button id="exportCSV" class="btn btn-outline-dark btn-sm">
                                    <i class="fas fa-file-csv"></i> Export CSV
                                </button><!--redundant pwedeng tanggalin-->
                                <button id="exportExcel" class="btn btn-sm text-white" style="background-color: rgba(162, 32, 26, 1);">
                                    <i class="fas fa-file-excel"></i> Export Excel
                                </button>
                            </div>

                            <div class="d-flex flex-wrap gap-2 m-3 btn-group-mobile">
                                <button class="btn btn-success btn-sm bulk-action" data-action="activate">Publish Selected</button>
                                <button class="btn btn-danger btn-sm bulk-action" data-action="deactivate">Archive Selected</button>
                            </div>

                            <div class="table-responsive">
                                <table id="customersTable" class="table">
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
                                            <th>Cover Image</th>
                                            <th>Content</th>
                                            <th>Status</th>
                                            <th>Publish Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!--@ foreach /**($blogs as $blog)**/-->
                                            <tr>
                                                <td><input type="checkbox" name="faqs_checkbox"></td><!--value="{ { $blog->xxxx }}"-->
                                                <td>1</td><!--FAQ ID-->
                                                <td>Feng Shui Basics</td><!--Title-->
                                                <td>Guides</td><!--Category-->
                                                <td>feng shui, beginner</td><!--tags-->
                                                <td><img src="https://via.placeholder.com/50" class="img-thumbnail"></td><!--Cover Image-->
                                                <td>A quick intro to feng shui principles...</td><!--Content-->
                                                <td><span class="badge bg-secondary">Post status</td><!--Status-->
                                                <td>02/02/2025</td><!--Publish Date-->
                                                <td>
                                                    <a href="{{ route('blog.edit') }}"
                                                        class="btn btn-outline-dark btn-sm edit-btn"
                                                        data-bs-toggle="tooltip"
                                                        data-bs-placement="top"
                                                        title="Edit Blogs Details">
                                                        Edit
                                                    </a>
                                                </td><!--data-id="{ { $faq->xxx }}"-->
                                            </tr>
                                        <!--@ endforeach-->
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
@endsection
