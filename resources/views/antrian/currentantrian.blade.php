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
            <h5 class="card-title text-center" id="kodeantrian" data-kode="{{ $currentAntrian->antrian->kode_antrian ?? '--'}}">{{ $currentAntrian->antrian->kode_antrian ?? '--'}}</h5>
            <h5 class="card-title text-center" id="loket" data-loket="{{ $currentAntrian->user->loket ?? '--'}}">{{ $currentAntrian->user->name ?? '--'}}</h5>
            {{-- <p class="card-text">
              Some quick example text to build on the card title and make up the bulk of the card's content.
            </p> --}}
            <button class="btn btn-outline-primary text-center" data-id="{{ $currentAntrian->id ?? '--' }}" id="panggil">Panggil</button>
            <button class="btn btn-outline-primary text-center" id="selesai" data-id="{{ $currentAntrian->id  ?? '--'}}">Selesai</button>
          </div>
        </div>
      </div>
      
    </div>
    
    
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
  
  <script>
    let kode = document.getElementById('kodeantrian').getAttribute('data-kode');
    let loket = document.getElementById('loket').getAttribute('data-loket');
    console.log(loket);
    // Memisahkan huruf dan angka
    var kodeantrian = kode.match(/[a-zA-Z]+/)[0];
    var angka = parseInt(kode.match(/\d+/)[0], 10);
    
    if (angka == 12) {
      console.log("yoms");
    }else {
      console.log("tims");
    }
    
    
    let pisahAngka = angka.toString();
    console.log("angkanya :" +pisahAngka[1]);
    
    // Menampilkan hasil
    console.log("Kode: " + kodeantrian); // Output: Kode: A
    console.log("Angka: " + typeof angka); // Output: Angka: 1
    var audio = new Audio();
    
    var audioSources = [
    '{{ asset("assets/sound/opening.mp3") }}',
    '{{ asset("assets/sound/antrian.mp3") }}',
    '{{ asset("assets/sound") }}'+ '/' + kodeantrian + '.mp3',
    '{{ asset("assets/sound/diloket.mp3") }}',
    '{{ asset("assets/sound") }}' + '/' + loket + '.mp3',
    // Tambahkan sumber audio lainnya sesuai kebutuhan
    ];
    if (angka <10){
      console.log("cik");
      audioSources.splice(3,0,'{{ asset("assets/sound") }}' + '/' + angka + '.mp3');
    }else if (angka == 10){
      audioSources.splice(3,0,'{{ asset("assets/sound/10.mp3") }}');
    }else if (angka == 11) {
      audioSources.splice(3,0,'{{ asset("assets/sound/11.mp3") }}');
    } else if (angka >= 12 && angka <= 19) {
      var puluhan = '{{ asset("assets/sound") }}' + '/' + pisahAngka[1] + '.mp3';
      var belasan = '{{ asset("assets/sound/belas.mp3") }}';
      audioSources.splice(3,0,puluhan, belasan);
    } else if (angka == 20 ||angka == 30 || angka == 40 || angka == 50 || angka == 60 || angka == 70 || angka == 80 || angka == 90) {
      console.log("yok");
      var puluh = '{{ asset("assets/sound/puluh.mp3") }}';
      audioSources.splice(3,0, '{{ asset("assets/sound") }}' + '/' + pisahAngka[0] + '.mp3', puluh);
    } else {
      console.log("cok");
      var puluhan = '{{ asset("assets/sound") }}' + '/' + pisahAngka[0] + '.mp3';
      var belasan = '{{ asset("assets/sound/puluh.mp3") }}';
      audioSources.splice(3,0,puluhan, belasan, '{{ asset("assets/sound") }}' + '/' + pisahAngka[1] + '.mp3');
    }
    

    
    
    
    
    var currentIndex = 0;
    
    document.getElementById('panggil').addEventListener('click', function() {
      playNextAudio();
    });
    
    function playAudio(source) {
      audio.src = source;
      audio.load();
      audio.play();
    }
    
    function playNextAudio() {
      if (currentIndex < audioSources.length) {
        playAudio(audioSources[currentIndex]);
        currentIndex++;
        // Tambahkan event listener untuk kejadian 'ended'
        audio.addEventListener('ended', playNextAudio);
      } else {
        currentIndex = 0; // Reset index jika semua file audio telah diputar
      }
    }
    
    // Panggil fungsi playNextAudio untuk memulai pemutaran
    // playNextAudio();
    
  </script>
  
  
  @endsection