@extends('layouts.admin.main')
@section('body')
<div class="content-wrapper">
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
      <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Antrian /</span> {{ $title }}</h4>

      <!-- Examples -->
      <div class="row mb-5">
        <div class="col-md-6 col-lg-4 mb-3">
          <div class="card h-100">
            {{-- <img class="card-img-top" src="../assets/img/elements/2.jpg" alt="Card image cap"> --}}
            <div class="card-body">
              <h5 class="card-title text-center">{{ $currentAntrian->antrian->kode_antrian ?? '--'}}</h5>
              <h5 class="card-title text-center">{{ $currentAntrian->user->name ?? '--'}}</h5>
              {{-- <p class="card-text">
                Some quick example text to build on the card title and make up the bulk of the card's content.
              </p> --}}
              <button class="btn btn-outline-primary text-center" data-id="{{ $currentAntrian->id ?? '--' }}">Panggil</button>
              <button class="btn btn-outline-primary text-center" id="selesai" data-id="{{ $currentAntrian->id  ?? '--'}}">Selesai</button>
            </div>
          </div>
        </div>
       
      </div>
      <!-- Examples -->

      
  </div>
  <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
     $(document).ready(function() {
          $("#selesai").click(function() {
              var antrianId = $(this).data('id')
            
              var status = "selesai";
              // Lakukan sesuatu dengan antrianId, misalnya, tampilkan di console
              console.log("Item ID yang dipilih:", antrianId);
  
              // Selanjutnya, Anda dapat menggunakan itemId untuk melakukan tindakan lain.
              // Misalnya, mengambil data melalui AJAX menggunakan itemId.
  
              $.ajax({
                  type: "POST",
                  url: "{{ route('antrian-selesai') }}", // Gantilah dengan nama file PHP yang sesuai
                  data: { antrian_id: antrianId, status:status , _token: '{{ csrf_token() }}' },
                  success: function(response) {
                      console.log(response);
                      Swal.fire({
                    title: "Good job!",
                    text: response.message,
                    icon: "success"
                    }).then(function() {
                        // Redirect to the specified URL
                        window.location.href = "{{ route('daftar-antrian') }}";
                    });
                  },
                  error: function(error) {
                      console.error("Error:", error);
                      console.error("Error:", error.responseJSON.message);
                    Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: error.responseJSON.message,
                    footer: ''
                    });
                  }
              });
          });
      });
  </script>
@endsection