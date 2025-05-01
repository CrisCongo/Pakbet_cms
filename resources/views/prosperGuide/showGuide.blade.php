@extends('layouts.app')
@section('title', 'Prosper Guides')
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
                <h1 class="m-0">Manage Prosper Guide</h1>
            </div>
        </div>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center" style="background-color: rgba(162, 32, 26, 1);">
                                <h3 class="card-title text-white">Guide List</h3>
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
                                <table id="guideTable" class="table">
                                    <thead>
                                        <tr>
                                            <th><label>
                                                Select All
                                                <input type="checkbox" id="select-all">
                                            </label></th>
                                            <th>Guide ID</th>
                                            <th>Zodiac</th>
                                            <th>Overview</th>
                                            <th>Career</th>
                                            <th>Health</th>
                                            <th>Love</th>
                                            <th>Wealth</th>
                                            <th>Status</th>
                                            <th>Publish Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($guides as $guide)
                                            <tr id="guideRow-{{ $guide->zodiacID }}">
                                                <td><input type="checkbox" class="guide-checkbox" value="{{ $guide->zodiacID }}"></td>
                                                <td>{{ $guide->zodiacID }}</td>
                                                <td>{{ $guide->zodiacID }}</td>
                                                <td>{{ Str::limit($guide->overview, 20) }}</td>
                                                <td>{{ Str::limit($guide->career, 20) }}</td>
                                                <td>{{ Str::limit($guide->health, 20) }}</td>
                                                <td>{{ Str::limit($guide->love, 20) }}</td>
                                                <td>{{ Str::limit($guide->wealth, 20) }}</td>
                                                <td>
                                                    <span class="badge" data-status="{{ $guide->status }}">
                                                        {{ ucfirst($guide->status) }}
                                                    </span>
                                                </td>
                                                <td>{{ \Carbon\Carbon::parse($guide->publish_date)->format('m/d/Y') }}</td>
                                                <td>
                                                    <a href="{{ route('guide.edit', ['zodiacID' => $guide->zodiacID]) }}"
                                                       class="btn btn-outline-dark btn-sm edit-btn" title="Edit Guide">
                                                        Edit
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
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
                const statusClasses = {
                    'published': 'bg-success',
                    'archived': 'bg-danger',
                    'draft': 'bg-secondary'
                };

                badge.text(ucwords(status));
                badge.removeClass('bg-success bg-danger bg-secondary').addClass(statusClasses[status]);
            }

            $('.badge').each(function () {
                const status = $(this).data('status');
                if (status) {
                    updateBadgeStatus(status, $(this));
                }
            });

            $('#select-all').on('click', function () {
                const isChecked = $(this).prop('checked');
                $('.guide-checkbox').prop('checked', isChecked);
            });

            function handleBulkAction(action) {
                var selectedGuides = [];
                $('.guide-checkbox:checked').each(function () {
                    selectedGuides.push($(this).val());
                });

                if (selectedGuides.length > 0) {
                    let actionText = action === 'publish' ? 'publish' : 'archive';
                    let confirmationText = action === 'publish' ? 'publish the selected guides.' : 'archive the selected guides.';

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
                                url: '{{ route("guide.bulkUpdate") }}',
                                method: 'POST',
                                data: {
                                    _token: '{{ csrf_token() }}',
                                    action: action,
                                    guides: selectedGuides
                                },
                                success: function(response) {
                                    if (response.success) {
                                        selectedGuides.forEach(function (id) {
                                            let row = $('#guideRow-' + id);
                                            let badge = row.find('td:eq(8) span');
                                            updateBadgeStatus(action === 'publish' ? 'published' : 'archived', badge);
                                            row.find('input.guide-checkbox').prop('checked', false);
                                        });
                                        $('#select-all').prop('checked', false);

                                        Swal.fire({
                                            icon: 'success',
                                            title: 'Success',
                                            text: `Guides ${actionText} successfully!`,
                                            confirmButtonColor: '#a2201a'
                                        });
                                    } else {
                                        Swal.fire({
                                            icon: 'error',
                                            title: 'Error',
                                            text: 'Could not update guides.',
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
                        text: 'Please select at least one guide.',
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
                var wb = XLSX.utils.table_to_book(document.getElementById('guideTable'), { sheet: "Prosper Guides" });
                XLSX.writeFile(wb, 'prosper_guides.xlsx');
            });

            $('#guideTable').DataTable({
                "paging": true,
                "searching": true,
                "ordering": true
            });
        });
    </script>
@endsection
