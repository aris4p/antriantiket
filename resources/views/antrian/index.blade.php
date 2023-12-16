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
                            <th>Kategori Antrian</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ( $antrian as $value )

                        <tr class="item-row" data-id="{{ $value->id  }}" data-user="{{ auth()->user()->id }}">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $value->kode_antrian }}</td>
                            <td>{{ $value->type_antrian }}</td>
                            <td>
                                <button type="submit" id="get" class="btn btn-primary">Get</button>
                            </td>
                        </tr>

                        @endforeach
                    </tbody>

                </table>
            </div>
        </div>
        <!--/ Basic Bootstrap Table -->


</div>
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script>
   $(document).ready(function() {
        $(".item-row").click(function() {
            var antrianId = $(this).data("id");
            var userId = $(this).data("user");
            // Lakukan sesuatu dengan antrianId, misalnya, tampilkan di console
            console.log("Item ID yang dipilih:", antrianId);
            console.log("User ID yang dipilih:", userId);

            // Selanjutnya, Anda dapat menggunakan itemId untuk melakukan tindakan lain.
            // Misalnya, mengambil data melalui AJAX menggunakan itemId.

            $.ajax({
                type: "POST",
                url: "{{ route('get-antrian') }}", // Gantilah dengan nama file PHP yang sesuai
                data: { antrian_id: antrianId, user_id: userId,  _token: '{{ csrf_token() }}' },
                success: function(response) {
                    console.log(response);
                },
                error: function(error) {
                    console.error("Error:", error);
                }
            });
        });
    });
</script>

@endsection
