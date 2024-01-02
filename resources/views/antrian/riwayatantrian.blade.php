@extends('layouts.admin.main')
@section('body')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">{{ $title }}</h4>
        <!-- Basic Bootstrap Table -->
        <div class="card">
            <h5 class="card-header">Data Antrian</h5>
            <div class="table-responsive text-nowrap">
                <table id="myTable" class="table table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode Antrian</th>
                            <th>Status Antrian</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
        <!--/ Basic Bootstrap Table -->
        
        
    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#myTable').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: '{{ url()->current() }}',
                    columns: [
                        { 
                            data: 'DT_RowIndex', 
                            name: 'DT_RowIndex', 
                            orderable: false, 
                            searchable: false,
                            width: '5%'
                        },
                        { 
                            data: 'kode_antrian',
                            name: 'kode_antrian',
                            orderable: true,
                            searchable: true,
                            width: '25%'
                        },
                        { 
                            data: 'status', 
                            name: 'status',
                            orderable: true,
                            searchable: true,
                            width: '20%'
                        },
                        { 
                            data: 'action', 
                            name: 'action', 
                            orderable: false, 
                            searchable: false,
                            width: '10%'
                        }
                    ]
                }); 
        });
    </script>
    
    @endsection
    