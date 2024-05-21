@extends('template.master')

@section('css')


<style>
    .modal-dialog {
        max-width: 1000px;
    }

    .note-group-select-from-files {
        display: none;
    }


    .modal-dialog .modal-footer .btn-primary {
        background: black !important;
    }

    .imagemedia img {
        cursor: pointer;
    }
</style>

@endsection
@section('judul','Answer Exam Student Point')

@section('content')



<div class="page-inner containermateri mt--5 d-block">

    <div class="row">

  


        <div class="col-md-12">

            <div class="tab-content mt-2 mb-3" id="pills-with-icon-tabContent">
                <div class="tab-pane fade show active" id="pills-home-icon" role="tabpanel" aria-labelledby="pills-home-tab-icon">

                    <div class="col-md-12">

                        <div class="row px-2 py-3 listmateri card mx-1 mt-3">
                        <form class="form" id="formkirim" method="POST" action="{{url('hapus-answer-exam-all')}}">
                                @csrf
                                <div class="container">
                                    <div class="row">

                                    <div class="isiCekAll">

                                    </div>

                                    <div class="col-sm-2">
                                        <label for="">
                                        <input type="checkbox"  id="checkall"> <span class="badge badge-pill badge-warning text-wrap" style="height:20px; width: 7rem;">Pilih Semua</span>
                                        </label>
                                    </div>

                                    <div class="col-sm-2">
                                        <label for=""></label>
                                        <button id="button-kirim" type="button" class="btn btn-sm btn-info ml-2">
                                        Hapus Semua</button>
                                    </div>
                                    </div>

                                </form>
                            </div>

                            <div class="table-responsive">
                                <table id="basic-datatables" class="display table table-striped table-hover">
                                    <thead>
                                    <tr>
                                        <th style="width: 10%; color: black; font-weight: bold;">No</th>
                                        <th style="color: black; font-weight: bold;">Question</th>
                                        <th style="color: black; font-weight: bold;">Point</th>
                                        <th style="color: black; font-weight: bold;">Student</th>
                                        <th style="color: black; font-weight: bold;">Exam</th>
                                        <th style="width: 20%; color: black; font-weight: bold;">Action</th>
                                        <th style="color: black; font-weight: bold;">Checklist</th>
                                    </tr>

                                    </thead>
                             
                                    <tbody>

                                        <?php $no1 = 1 ?>
                                        @foreach($answer as $v)
                                        <tr>
                                            <td>{{$no1++}}</td>
                                            <td>{{$v->quest_exam}}</td>
                                            <td>{{$v->point}}</td>
                                            <td>{{$v->full_name}}</td>
                                            <td>{{$v->title}}</td>
                                            <td>

                                                <!-- <a href="{{url('kelolaanswer',$v->id)}}" class="btn btn-primary">
                                                    <i class="fe fe-edit"></i>
                                                </a> -->
                                                <a href="{{url('kelolaexamanswerdelete',$v->id)}}" class="btn btn-danger" data-target="confirmation-modal">
                                                    <i class="fe fe-trash"></i>
                                                </a>
                                                <!-- <a href="{{url('soal',$v->id)}}" class="btn btn-success text-white">
                                                    <i class="fe fe-eye"></i>
                                                </a> -->


                                            </td>
                                            <td>
                                            <!-- ceklist array supaya ikut kelooping -->
                                                <div class="check">
                                                <label for="">
                                                    <input type="checkbox" name="cek[]" value="{{$v->id}}" class="checkitem">
                                                </label>
                                                </div>
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


        </div>

        <!--  -->


    </div>

</div>

<div class="modal fade" id="confirmation-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body text-center font-18">
                <h4 class="padding-top-30 mb-30 weight-500">Apakah Anda Ingin Menghapus Soal?</h4>
                <div class="padding-bottom-30 row" style="max-width: 170px; margin: 0 auto;">
                    <div class="col-6">
                        <button type="button" class="btn btn-secondary border-radius-100 btn-block confirmation-btn" data-dismiss="modal"><i class="fa fa-times"></i></button>
                        Tidak
                    </div>
                    <div class="col-6">
                        <a href="#" id="linkhapus" class="btn btn-primary border-radius-100 btn-block confirmation-btn"><i class="fa fa-check"></i></a>
                        Ya
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




@endsection

@section('js')


<script>
    var jumjawaban = 0

    function hapusjawaban() {
        $('.list-jawaban .jwbn:last-child').remove()
        jumjawaban--
    }

    function tambahjawaban() {
        $('.list-jawaban').append(`
<div class="mb-3 jwbn">
 <textarea class="form-control" required name="jaw[]"></textarea>
</div>
        `)


        // $('.summernote_jaw').summernote({
        //     toolbar: [
        //         ['style', ['style']],
        //         ['font', ['bold', 'underline', 'clear']],
        //         ['fontname', ['fontname']],
        //         ['color', ['color']],
        //         ['para', ['ul', 'ol', 'paragraph']],
        //         ['table', ['table']],
        //         ['insert', ['link', 'picture', 'video', 'audio']],
        //         ['view', ['fullscreen', 'codeview', 'help']],
        //     ],

        // })
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

    $('#basic-datatables').DataTable({});

    $('#basic-datatables2').DataTable({});

    $('.searchbox-input').keyup(function() {
        $('.materi').removeClass('d-none');
        var filter = $(this).val(); // get the value of the input, which we filter on
        $('.listmateri').find('.materi .card-body .row .col-stats .numbers  p:not(:contains("' + filter + '"))').parent().parent().parent().parent().parent().addClass('d-none');
    });

    $('#btn-tambahmateri').click(() => {
        $('.panel-header').removeClass('d-block').addClass('d-none')
        $('.containermateri').removeClass('d-block').addClass('d-none')
        $('.containertambahmateri').removeClass('d-none').addClass('d-block')

    })


    $('.kembalimateri').click(() => {
        $('.panel-header').removeClass('d-none').addClass('d-block')
        $('.containermateri').removeClass('d-none').addClass('d-block')
        $('.containertambahmateri').removeClass('d-block').addClass('d-none')
        $('.containertambahessay').removeClass('d-block').addClass('d-none')

    })

    // $(document).ready(function() {
    //     $('textarea').summernote({
    //         toolbar: [
    //             // ['style', ['style']],
    //             ['font', ['bold', 'underline', 'clear']],
    //             ['fontname', ['fontname']],
    //             ['color', ['color']],
    //             // ['para', ['ul', 'ol', 'paragraph']],
    //             // ['table', ['table']],
    //             // ['insert', ['link', 'picture', 'video', 'audio']],
    //             ['view', ['fullscreen', 'codeview', 'help']],
    //         ],

    //     })


    // })



    function submitMateri() {
        if ($('#isi_materi').val() == "" || $('#isi_jawab').val() == "") {
            Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text: "Kolom Wajib Diisi Semua",
            })
        } else {
            $("#submitdata").submit()
        }
    }
</script>

<script>
    // fungsi saat ingin di check all atau dipilih semua
    $("#checkall").change(function() {
      $(".checkitem").prop("checked", $(this).prop("checked"))
    })
    // berfungsi untuk mengubah beberapa item checkbox terpilih(checklist) semua atau tidak terpilih (unchecklist)
    $(".checkitem").change(function() {
      if ($(this).prop("checked") == false) {
        $("#checkall").prop("checked", false)
      }
      // saat beberapa item terpilih dan hampir semua maka akan pada checkbox yang memiliki id CHECKALL terchecklist
      if ($(".checkitem:checked").length == $(".checkitem").length) {
        $("#checkall").prop("checked", true)
      }
    })


    $("#button-kirim").on('click', ()=>{
        cekAll();
    });

    function  cekAll(){
      //proses utk kirim nilia ceklist ke form

      let data = [];
      $('.isiCekAll').empty()
      $("[name='cek[]']:checked").each(function( index,el ) {
        data.push( $(el).val() );
      $('.isiCekAll').append(`
        <input type="string" class="d-none" name="ceklist[]" value="${$(el).val()}">`)
      });

      $('#formkirim').submit();

    }

  </script>
@include('template.customsummernote')
@endsection