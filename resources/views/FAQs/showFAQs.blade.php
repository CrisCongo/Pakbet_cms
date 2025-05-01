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
                                <table id="faqTable" class="table">
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
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/xlsx@0.18.5/dist/xlsx.full.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function () {
            $('#faqTable').DataTable({
                "order": [[1, "desc"]],
                "columnDefs": [
                    { "orderable": false, "targets": [0, 6] }
                ]
            });

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
                    Swal.fire({
                        icon: 'warning',
                        title: 'No Selection',
                        text: 'Please select at least one FAQ.',
                        confirmButtonColor: '#a2201a'
                    });
                    return;
                }

                let actionText = action === 'publish' ? 'publish' : 'archive';
                let confirmationText = action === 'publish' ? 'publish the selected FAQs.' : 'archive the selected FAQs.';

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
                            url: '{{ route('faq.updateStatus') }}',
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
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: 'Something went wrong, please try again.',
                                    confirmButtonColor: '#a2201a'
                                });
                            }
                        });
                    }
                });
            });

            $('#exportExcel').on('click', function () {
                var wb = XLSX.utils.table_to_book(document.getElementById('faqTable'), { sheet: "FAQs" });
                XLSX.writeFile(wb, 'faqs.xlsx');
            });
        });
    </script>
@endsection

