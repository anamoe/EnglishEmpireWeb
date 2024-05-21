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
@section('judul','Soal')

@section('content')



<div class="page-inner containermateri mt--5 d-block">

    <div class="row">

        <!--  -->

        <div class="col-md-12 mb-3">
            <div class="px-3">
                <div class="card-header row" style="border: 1px solid black !important;">
                    <div class="col-md-12">
                        <button class="btn btn-sm btn-primary float-right" id="btn-tambahmateri">Tambah Soal</button>
                        <!-- 
                  
                   <a href="" class="btn btn-sm btn-primary mr-3 float-right">Cek Soal</a> -->
                    </div>

                </div>

            </div>
        </div>


        <!--  -->
        <div class="col-md-12">

            <ul class="nav nav-pills nav-secondary  nav-pills-no-bd nav-pills-icons justify-content-center" id="pills-tab-with-icon" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="pills-home-tab-icon" data-toggle="pill" href="#pills-home-icon" role="tab" aria-controls="pills-home-icon" aria-selected="true">
                        <i class="fa fa-quiz"></i>
                        Pilihan Ganda
                    </a>
                </li>


            </ul>

        </div>

        <!--  -->

        <div class="col-md-12">

            <div class="tab-content mt-2 mb-3" id="pills-with-icon-tabContent">
                <div class="tab-pane fade show active" id="pills-home-icon" role="tabpanel" aria-labelledby="pills-home-tab-icon">

                    <div class="col-md-12">

                        <div class="row px-2 py-3 listmateri card mx-1 mt-3">
                        <form class="form" id="formkirim" method="POST" action="{{url('hapus-all')}}">
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
                                            <th style="width: 10%">No</th>
                                            <th>Label</th>
                                            <th style="width: 20%">Action</th>
                                            <th>Checklist</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>No</th>
                                            <th>Label Soal</th>
                                            <th>Action</th>
                                            <th>Checklist</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>

                                        <?php $no1 = 1 ?>
                                        @foreach($soal as $v)
                                        <tr>
                                            <td>{{$no1++}}</td>
                                            <td>{{$v->quest}}</td>
                                            <td>

                                                <a href="{{url('kelolasoal',$v->id)}}" class="btn btn-primary">
                                                    <i class="fe fe-edit"></i>
                                                </a>
                                                <a href="{{url('kelolasoaldelete',$v->id)}}" class="btn btn-danger" data-target="confirmation-modal">
                                                    <i class="fe fe-trash"></i>
                                                </a>
                                                <a href="{{url('viewsoal',$v->id)}}" class="btn btn-success text-white">
                                                    <i class="fe fe-eye"></i>
                                                </a>


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

<div class="page-inner containertambahmateri mt--5 d-none">

    <div class="row">
        <div class="col-md-12  mt-5">
            <div class="card">
                <div class="card-header bg-primary">
                    
                    <h6 class="text-white">Add<div class="float-right kembalimateri" style="cursor :pointer;">X</div>
                    
                    </h6>
                </div>
                <div class="card-body">
                    <form method="post" action="{{url('kelolasoal')}}" enctype="multipart/form-data" id="submitdata">
                        @csrf

                        <div class="col-md-9 p-0">
                            <input type="hidden" class="form-control input-full w-100" value="{{$sub_id}}" name="mapel_id" id="kelas_id" placeholder="Enter Input">
                        </div>

                        <div class="form-group">
                            <label class="badge badge-success text-white py-2 w-100" style="font-size: 15px;">Audio(Optional)</label>
                            <input type="file" class="form-control input-full w-100" required name="suara"  accept="audio/*">
                        </div>

                        <div class="form-group">
                            <label class="badge badge-success text-white py-2 w-100" style="font-size: 15px;">Image(Optional)</label>
                            <input type="file" class="form-control input-full w-100" required name="gambar"  accept="image/*">
                        </div>



                        <div class="form-group">
                            <label>Soal:</label>
                            <textarea class="form-control" name="soal" id="isi_materi"></textarea>
                        </div>

                        <div class="form-group">
                            <label class="badge badge-success text-white py-2 w-100" style="font-size: 15px;">Jawaban (Benar):</label>
                            <textarea class="form-control" required name="jawbenar" id="isi_jawab"></textarea>
                        </div>

                        <div class="list-jawaban">
                            <div class="form-group">
                                <label class="badge badge-primary text-white py-2 w-100" style="font-size: 15px;">Jawaban Lain:</label>
                                <textarea class="form-control" required name="jaw[]"></textarea>
                            </div>
                        </div>


                        <button class="btn btn-primary" onclick="tambahjawaban()" type="button">
                            <i class="fe fe-plus"></i>
                        </button>

                        <button class="btn btn-danger" onclick="hapusjawaban()" type="button">
                            <i class="fe fe-minus"></i>
                        </button>

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