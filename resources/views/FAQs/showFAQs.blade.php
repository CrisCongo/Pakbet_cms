@php
    use Illuminate\Support\Str;
@endphp
@extends('layouts.app')
@section('title', 'FAQs')
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
                <h1 class="m-0">Manage FAQs</h1>
            </div>
        </div>

        <section class="content">
            <div class="container-fluid">

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center" style="background-color: rgba(162, 32, 26, 1);">
                                <h3 class="card-title text-white">FAQs List</h3>
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
                                <table id="customersTable" class="table">
                                    <thead>
                                        <tr>
                                            <th><label>
                                                Select All
                                                <input type="checkbox" id="select-all">
                                            </label></th>
                                            <th>FAQ ID</th>
                                            <th>Question</th>
                                            <th>Answer</th>
                                            <th>Status</th>
                                            <th>Publish Date</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($faqs as $faq)
                                            <tr>
                                                <td><input type="checkbox" name="faqs_checkbox" value="{{ $faq->faqID }}"></td>
                                                <td>{{ $faq->faqID }}</td>
                                                <td>{!! Str::limit(strip_tags($faq->question), 20) !!}</td>
                                                <td>{!! Str::limit(strip_tags($faq->answer), 20) !!}</td>
                                                <td>
                                                    <span class="badge
                                                        @if($faq->status === 'published') bg-success
                                                        @elseif($faq->status === 'archived') bg-danger
                                                        @else bg-secondary @endif">
                                                        {{ ucfirst($faq->status) }}
                                                    </span>
                                                </td>
                                                <td>{{ \Carbon\Carbon::parse($faq->publish_date)->format('m/d/Y') }}</td>
                                                <td>
                                                    <a href="{{ route('faq.edit', ['id' => $faq->faqID]) }}"
                                                       class="btn btn-outline-dark btn-sm edit-btn"
                                                       data-bs-toggle="tooltip"
                                                       data-bs-placement="top"
                                                       title="Edit FAQs Details">
                                                       Edit
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="d-flex justify-content-center mt-3">
                                    {{ $faqs->links('pagination::bootstrap-5') }}
                                </div>
                            </div>
                            <div class="d-flex flex-wrap gap-2 m-3 btn-group-mobile">
                                <a href="{{ route('faq.add') }}"
                                    class="btn btn-sm text-white"
                                    style="background-color: rgba(162, 32, 26, 1);"
                                    data-bs-toggle="tooltip"
                                    data-bs-placement="top"
                                    title="Add FAQs Here">
                                    Add FAQ
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
    <script>
        $(document).ready(function () {
            $('#select-all').on('change', function () {
                $('.faq-checkbox').prop('checked', $(this).is(':checked'));
            });

            $('.faq-checkbox').on('change', function () {
                let allChecked = $('.faq-checkbox').length === $('.faq-checkbox:checked').length;
                $('#select-all').prop('checked', allChecked);
            });

            $('.bulk-action').on('click', function () {
                var action = $(this).data('action');
                var selectedFaqs = [];

                $('input[name="faqs_checkbox"]:checked').each(function () {
                    selectedFaqs.push($(this).val());
                });

                if (selectedFaqs.length === 0) {
                    alert('Please select at least one FAQ.');
                    return;
                }

                $.ajax({
                    url: '{{ route("faq.updateStatus") }}',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        faqs: selectedFaqs,
                        action: action
                    },
                    success: function (response) {
                        location.reload();
                    },
                    error: function (error) {
                        alert('Something went wrong, please try again.');
                    }
                });
            });

            $('#exportExcel').on('click', function () {
                let table = document.getElementById('customersTable').cloneNode(true);

                for (let row of table.rows) {
                    row.deleteCell(0);
                    row.deleteCell(row.cells.length - 1);
                }

                let html = '<html><head><meta charset="UTF-8"></head><body>' + table.outerHTML + '</body></html>';
                let blob = new Blob([html], { type: "application/vnd.ms-excel" });
                let url = URL.createObjectURL(blob);

                let a = document.createElement('a');
                a.href = url;
                a.download = 'faqs_export.xls';
                a.click();
                URL.revokeObjectURL(url);
            });
        });
    </script>
@endsection
