@extends('template.master')



@section('css')


<style>
    .modal-dialog{
        max-width:1000px;
    }
    .note-group-select-from-files{
        display: none;
    }


    .modal-dialog .modal-footer .btn-primary{
        background: black !important;
    }
    .imagemedia img{
        cursor:pointer;
    }
</style>

@endsection
@section('judul','Soal')

@section('content')



<div class="page-inner containertambahmateri mt--5">
    
    <div class="row">
        <div class="col-md-12  mt-5">
           <div class="card">
              <div class="card-header bg-primary">
                
                 <h6 class="text-white">Edit Soal<div class="float-right kembalimateri" style="cursor :pointer;">X</div> </h6>
              </div>
              <div class="card-body">
                 <form method="post" action="{{url('kelolasoal_exam/'.$s->id)}}" enctype="multipart/form-data" id="submitdata">
                    @csrf
                    @method('PUT')

                    

                    <div  iv class="text-center">
                                    <img class="img" id="loadfotoadd" src="{{$s->image}}" alt="Foto Thumbnail"
                                        style=" height:30%; width:30%;">                            
                        </div>

                                                    <audio controls>
                            <source src="{{$s->audio}}" type="audio/mpeg"> 
                            </audio>

                            <div class="form-group">
                            <label class="badge badge-success text-white py-2 w-100" style="font-size: 15px;">Audio(Optional)</label>
                            <input type="file" class="form-control input-full w-100" required name="suara" id="isi_jawab" accept="audio/*">
                        </div>

                        <div class="form-group">
                            <label class="badge badge-success text-white py-2 w-100" style="font-size: 15px;">Image(Optional)</label>
                            <input type="file" class="form-control input-full w-100" required name="gambar" id="isi_jawab" accept="image/*">
                        </div>
                    <div class="form-group">
                       <label>Soal :</label>
                       <textarea class="summernote_dessription" name="soal" id="isi_materi">{{$s->quest_exam}}</textarea>
                    </div>

                    @foreach($s->ganda as $n=>$g)
                    @if($n == 0)
                    <div class="form-group">
                       <label class="badge badge-success text-white py-2 w-100"
                       style="font-size: 15px;" 
                       >Jawaban (Benar):</label>
                       <textarea class="summernote_dess" required name="jawbenar" id="isi_jawab">{{$g->answer}}</textarea>
                    </div>
                    
                    @endif
                    @endforeach

                    <div class="list-jawaban">
                        <div class="form-group">
                       <label class="badge badge-primary text-white py-2 w-100"
                       style="font-size: 15px;" 
                       >Jawaban Lain:</label>
                    @foreach($s->ganda as $nq=>$gq)
                    @if($nq > 0)
                    <div class="mb-3">
                    <textarea class="summernote_jaw mb-3" required name="jaw[{{$gq->id}}]">{{$gq->answer}}</textarea>
                    </div>
                    @endif
                    @endforeach
                    </div>
                    </div>


                 </form>
                 <div class="form-group text-center">
                    <button onclick="submitMateri()" class="btn btn-info btn-sm">Submit</button>
                 </div>
              </div>
           </div>
      </div>
   </div>

</div>

    
@endsection

@section('js')
<script>
    var audioPlayer = document.getElementById('audioPlayer');

    function playAudio() {
    audioPlayer.play();
    event.preventDefault(); // Mencegah aksi standar formulir
}

function pauseAudio() {
    audioPlayer.pause();
    event.preventDefault(); // Mencegah aksi standar formulir
}

</script>


<script>

var jumjawaban = 0

function hapusjawaban() {
    $('.list-jawaban .jwbn:last-child').remove()
    jumjawaban--
}

function tambahjawaban() {
    $('.list-jawaban').append(`
<div class="mb-3 jwbn">
 <textarea class="summernote_jaw" required name="jaw[]"></textarea>
</div>
        `)


      $('.summernote_jaw').summernote({
        toolbar: [
        //   ['style', ['style']],
          ['font', ['bold', 'underline', 'clear']],
          ['fontname', ['fontname']],
          ['color', ['color']],
        //   ['para', ['ul', 'ol', 'paragraph']],
        //   ['table', ['table']],
        //   ['insert', ['link', 'picture', 'video','audio']],
          ['view', ['fullscreen', 'codeview', 'help']],
        ],

})
      jumjawaban++ 

      addlastsum()


}

$(document).ready(function() {

@if(session()->has('message'))
Swal.fire({
  icon: 'success',
  title: "{{session()->get('message')}}",
})
$(".swal2-popup textarea").remove()
$(".swal2-popup .note-editor").remove()
@endif



});

$('#basic-datatables').DataTable({
});

$('#basic-datatables2').DataTable({
});

$('.searchbox-input').keyup( function () {
    $('.materi').removeClass('d-none');
    var filter = $(this).val(); // get the value of the input, which we filter on
    $('.listmateri').find('.materi .card-body .row .col-stats .numbers  p:not(:contains("'+filter+'"))').parent().parent().parent().parent().parent().addClass('d-none');
});





$(document).ready(function() {
    $('textarea').summernote({
        toolbar: [
        //   ['style', ['style']],
          ['font', ['bold', 'underline', 'clear']],
          ['fontname', ['fontname']],
          ['color', ['color']],
        //   ['para', ['ul', 'ol', 'paragraph']],
        //   ['table', ['table']],
        //   ['insert', ['link', 'picture', 'video','audio']],
          ['view', ['fullscreen', 'codeview', 'help']],
        ],

})


})  



function submitMateri(){
    if($('#isi_materi').val() == "" || $('#nama_materi').val() ==""){
        Swal.fire({
          icon: 'error',
          title: 'Gagal',
          text: "Kolom Wajib Diisi Semua",
        })
    }else{
        $("#submitdata").submit()
    }
}

 
</script>

@include('template.customsummernote')
@endsection