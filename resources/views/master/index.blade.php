@extends('layouts.admin.main')
@section('body')
<style>
  .row {
    width: 100%;
    display: flex;
    justify-content: center;
    flex-wrap: wrap;
  }
  
  .card {
    display: flex;
    justify-content: center;
    align-items: center;
    position: relative;
    margin: 20px;
    border-radius: 10px;
    color: #fff;
    font-size: 1.5rem;
    text-align: center;
    background: #e74c3c;
    width: 150px;
    max-width: 960px; /* Mengatur lebar kartu menjadi penuh sesuai dengan container */
    height: 150px;
    flex-direction: column;
  }
  
  .card .loket {
    margin-top: 10px;
    width: 100%; /* Mengatur lebar loket menjadi penuh sesuai dengan kartu */
    height: 100px;
  }
  
  .card .loket2 {
    width: 100%; /* Mengatur lebar loket2 menjadi penuh sesuai dengan kartu */
    height: 100px;
    font-size: 50px;
  }
  
  .blue-background {
    background-color: blue;
    color: white;
  }
  
  .gray-background {
    background-color: gray;
  }
  
  .disabled {
    opacity: 0.5; /* Mengatur tingkat transparansi */
    cursor: not-allowed;
    pointer-events: none; /* Menonaktifkan interaksi mouse */
  }
</style>
<div class="container-xxl flex-grow-1 container-p-y">
  <div class="row">
    <input type="hidden" id="loketUser" value="{{ auth()->user()->loket }}">
    <button class="card" id="loket1" value="1" onclick="setUserLoket(1)">
      <div class="loket">LOKET 1</div>
  </button>
  <button class="card" id="loket2" value="2" onclick="setUserLoket(2)">
      <div class="loket">LOKET 2</div>
  </button>
  <button class="card" id="loket3" value="3" onclick="setUserLoket(3)">
      <div class="loket">LOKET 3</div>
  </button>
  <button class="card" id="loket4" value="4" onclick="setUserLoket(4)">
      <div class="loket">LOKET 4</div>
  </button>
  <button class="card" id="loket5" value="5" onclick="setUserLoket(5)">
      <div class="loket">LOKET 5</div>
  </button>
    
  </div>
  
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
  // Simulasikan nilai loket dari pengguna
  var userLoket = document.getElementById('loketUser').value ;
  // Fungsi untuk mengatur warna latar belakang kartu berdasarkan nilai loket
  function setCardColor() {
    for (let i = 1; i <= 5; i++) {
      const card = document.getElementById('loket' + i);
      if (i == userLoket) {
        card.classList.add('blue-background');
      } else {
        card.classList.add('gray-background');
      }
    }
  }
  
  // Panggil fungsi saat halaman dimuat
  setCardColor();
</script>

<script>
  function setUserLoket(loketNumber) {
    var csrfToken = $('meta[name="csrf-token"]').attr('content');
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': csrfToken
                        }
                    });


      // Assuming you have a function to get the value
      var valueToSend = loketNumber;

      // Using jQuery Ajax
      $.ajax({
          type: "POST", // You can also use "GET" depending on your server setup
          url: "{{ route('loket') }}", // Replace with your server endpoint
          data: { value: valueToSend },
          success: function(response) {
              // Handle the response from the server
              Swal.fire({
                    title: "Good job!",
                    text: response.message,
                    icon: "success"
                    }).then(function() {
                        // Redirect to the specified URL
                        window.location.href = "{{ route('dashboard') }}";
                    });
          },
          error: function(error) {
              
              Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: error.responseJSON.message,
                    footer: ''
                    });
          }
      });
  }
</script>

@endsection
