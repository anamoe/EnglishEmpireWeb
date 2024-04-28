@extends('template.master')
@section('judul','Exam ')

@section('content')

<div class="page-inner mt--5">

    <div class="row">
        <div class="col-md-12">
        
            <div class="px-3">
                <div class="card-header row" style="border: 1px solid black !important;">

                    <div class="form-group form-inline col-md-4">
                        <label for="carimapel" class="col-md-3 col-sm-4 col-form-label">Cari</label>
                        <div class="col-md-9 col-sm-8 p-0">
                            <input type="text" class="searchbox-input form-control input-full" name="" id="carimapel">
                        </div>
                    </div>

                    <div class="col-md-8">
                        <button class="btn btn-sm btn-primary float-right" data-toggle="modal" data-target="#exampleModalCenter">Tambah Exam</button>
                    </div>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">Add</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{url('exam')}}" id="buatmapel" method="post">
                                        @csrf
                                        <div class="form-group form-inline">
                                            <label for="namamapel" class="col-md-3 col-form-label">Title</label>
                                            <div class="col-md-9 p-0">
                                                <input type="text" class="form-control input-full w-100" name="title" id="namamapel" placeholder="Enter Input">
                                            </div>
                                        </div>
                                        <div class="form-group form-inline">
                                            <label for="namamapel" class="col-md-3 col-form-label">Waktu Pengerjaan</label>
                                            <div class="col-md-9 p-0">
                                                <input type="text" class="form-control input-full w-100" name="waktu_pengerjaan" id="namamapel" placeholder="Enter Input">
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                                    <div class="form-group form-group-default">
                                                        <label>Program Course</label>
                                                        <select id="courseProgram" name="course_program_id" required class="form-control" onchange="getClasses()">
                                                            <option value="" disabled>Choose</option>
                                                            <!-- Loop through your list of course programs and generate options -->
                                                            @foreach($coursePrograms as $course)
                                                                <option value="{{ $course->id }}">{{ $course->program }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                            <div class="col-sm-12">
                                                <div class="form-group form-group-default">
                                                    <label>Class</label>
                                                    <select id="class" name="class_id" required class="form-control">
                                                        <option value="">Choose</option>
                                                    </select>
                                                </div>
                                            </div>



                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                    <button type="button" class="btn btn-primary" onclick="tambahMapel()">
                                        Buat</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal -->
                    <div class="modal fade" id="editMapel" role="dialog" aria-labelledby="editMapel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">Edit</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="" id="updatemapel" method="post">
                                        @method("patch")
                                        @csrf
                                        <div class="form-group form-inline">
                                            <label for="namamapel" class="col-md-3 col-form-label">Title</label>
                                            <div class="col-md-9 p-0">
                                                <input type="text" class="form-control input-full" name="title" id="editnamamapel" placeholder="Enter Input">
                                            </div>
                                        </div>
                                        <div class="form-group form-inline">
                                            <label for="namamapel" class="col-md-3 col-form-label">Waktu Pengerjaan</label>
                                            <div class="col-md-9 p-0">
                                                <input type="text" class="form-control input-full" name="waktu_pengerjaan" id="editwaktu" placeholder="Enter Input">
                                            </div>
                                        </div>




                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                    <button type="button" class="btn btn-primary" onclick="document.getElementById('updatemapel').submit()">Simpan</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal Hapus-->
                    <div class="modal fade" id="hapusmapel" role="dialog" aria-labelledby="editMapel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">Hapus</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="" id="deletemapel" method="post">
                                        @method("delete")
                                        @csrf
                                    </form>
                                    <span>Apakah Anda Mau menghapus  <span class="map"></span> ?</span>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                    <button type="button" class="btn btn-danger" onclick="document.getElementById('deletemapel').submit()">Hapus</button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
            <div>

                <div class="row listmapel mt-3">

                @foreach($e as $v)


                    <div class="mapel card-stats card-round col-sm-12 col-md-4">
                        <div class="card card-body">
                            <div class="float-right py-2 mt--2">
                                <i onclick="hapus('{{$v->id}}','{{$v->title}}','{{$v->waktu}}')" class="fe fe-trash float-right text-danger"></i>
                                <i onclick="edit('{{$v->id}}','{{$v->title}}')" class="fe fe-edit float-right text-primary"></i>

                            </div>
                            <a href="{{url('soal_exam_list',$v->id)}}"  class="row align-items-center">
                                <div class="col-icon">
                                    <div class="icon-big text-center icon-info bubble-shadow-large">
                                    <i class="fa-solid fa-gamepad-modern"></i>
                                    </div>
                                </div>
                                <div class="col col-stats ml-3 ml-sm-0">
                                    <div class="numbers">
                                        <p class="card-category">{{$v->title}}</p>
                                        <p class="card-category">{{$v->program}}</p>
                                        <p class="card-category">{{$v->class}}</p>
                                        <p class="card-category">{{$v->waktu_pengerjaan}} Menit</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>

@endforeach






                </div>

            </div>
        </div>
    </div>

</div>
@endsection

@section('js')





<script type="text/javascript">
    @if(session()->has('message'))
    Swal.fire({
        icon: 'success',
        title: 'Berhasil',
        text: "{{session()->get('message')}}",
    })
    @endif

    
function getClasses() {
        var programId = document.getElementById("courseProgram").value;
      
        var classSelect = document.getElementById("class");
        classSelect.innerHTML = '<option value="">Loading...</option>';

        // Make an AJAX request to fetch classes associated with the selected program
        fetch(`http://localhost/EnglishEmpire/class/${programId}`)
            .then(response => response.json())
            .then(data => {
                classSelect.innerHTML = '<option  disabled value="">Choose</option>';
                data.forEach(classData => {
                    var option = document.createElement("option");
                    option.value = classData.id;
                    option.text = classData.class;
                    classSelect.appendChild(option);
                });
            })
            .catch(error => {
                console.error('Error fetching classes:', error);
                classSelect.innerHTML = '<option value="">Failed to load classes</option>';
            });
    }

    function tambahMapel() {
        $('#buatmapel .input-full').removeClass('is-invalid')
        if ($('#buatmapel .input-full').val() == "") {
            $('#buatmapel .input-full').addClass('is-invalid')
        } else {
            $("#buatmapel").submit()
        }
    }

    function edit(id, mapel,waktu) {
        $("#updatemapel #editnamamapel").val(mapel)
        $("#updatemapel #editwaktu").val(waktu)
        $("#updatemapel").attr("action", "{{url('exam')}}" + "/" + id)
        $("#editMapel").modal("show")
    }

    function hapus(id, mapel) {
        $("#hapusmapel .map").html(mapel)
        $("#deletemapel").attr("action", "{{url('exam')}}" + "/" + id)
        $("#hapusmapel").modal("show")
    }

    $('.searchbox-input').keyup(function() {
        $('.mapel').removeClass('d-none');
        var filter = $(this).val(); // get the value of the input, which we filter on
        $('.listmapel').find('.mapel .card-body .row .col-stats .numbers:not(:contains("' + filter + '"))').parent().parent().parent().parent().addClass('d-none');
    })
    $.expr[":"].contains = $.expr.createPseudo(function(arg) {
        return function(elem) {
            return $(elem).text().toUpperCase().indexOf(arg.toUpperCase()) >= 0;
        };
    });
</script>



@endsection