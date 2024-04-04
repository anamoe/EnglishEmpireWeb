@extends('template.master')
@section('judul','Account Student')
@section('css')


<style>
    .modal-dialog {
        max-width: 1000px;
    }

    .note-group-select-from-files {
        display: none;
    }




    .imagemedia img {
        cursor: pointer;
    }
</style>

@endsection
@section('content')

<div class="page-inner">


    <div class="row">
        <div class="col-md-12">
            <div class="card">

                <div class="card-body">


                    <!-- Modal -->
                    <div class="modal fade" id="addRowModal" role="dialog" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header no-bd">
                                    <h5 class="modal-title">
                                        <span class="fw-mediumbold">
                                            Add</span>
                                        <span class="fw-light">
                                            Student
                                        </span>
                                    </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>

                                <div class="modal-body">
                                    <form action="{{url('user')}}" method="post" id="addUsers" onsubmit="return validateForm()">
                                        @csrf

                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group form-group-default">
                                                    <label>Full Name</label>
                                                    <input id="addName" type="text" name="full_name" required class="form-control" placeholder="">
                                                </div>
                                            </div>

                                            <div class="col-sm-12">
                                                <div class="form-group form-group-default">
                                                    <label>Nick Name</label>
                                                    <input id="addNick" type="text" name="nick_name" required class="form-control" placeholder="">
                                                </div>
                                            </div>

                                            <div class="col-sm-12">
                                                <div class="form-group form-group-default">
                                                    <label>Id Number</label>
                                                    <input id="addid" type="text" name="id_number" required class="form-control" placeholder="">
                                                </div>
                                            </div>

                                            <div class="col-sm-12">
                                                <div class="form-group form-group-default">
                                                    <label>Password</label>
                                                    <input id="addpassword" type="password" name="password" required class="form-control" placeholder="">
                                                </div>
                                            </div>

                                            <div class="col-sm-12">
                                                <div class="form-group form-group-default">
                                                    <label>School</label>
                                                    <input id="addschool" type="text" name="school" required class="form-control" placeholder="">
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="form-group form-group-default">
                                                    <label>Date Birth</label>
                                                    <input id="addbirth" type="date" name="date_birth" required class="form-control" placeholder="">
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="form-group form-group-default">
                                                    <label>No. Telp</label>
                                                    <input id="addtelp" type="text" name="no_hp" required class="form-control" placeholder="">
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="form-group form-group-default">
                                                    <label>Activate Date</label>
                                                    <input id="activate_date" type="date" name="activate_date" required class="form-control" placeholder="">
                                                </div>
                                            </div>

                                            <div class="col-sm-12">
                                                <div class="form-group form-group-default">
                                                    <label>Status Account</label>
                                                    <select name="status_account" class="form-control">
                                                <option value="active">Active</option>
                                                <option value="inactive">Inactive</option>
                                            </select>
                                                       
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

                                            
                                            <!-- <div class="col-sm-12">
                                                <div class="form-group form-group-default">
                                                    <label class="badge badge-success text-white py-2 w-100" style="font-size: 15px;">Image</label>
                                                    <input type="file" class="form-control input-full w-100" required name="gambar" id="isi_jawab"></textarea>
                                                </div>
                                            </div> -->

                                        </div>
                                        <div class="modal-footer no-bd">
                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
                                            <button class="btn btn-primary">Tambah</button>
                                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>

                    <!-- Modal -->
                    <div class="modal fade" id="editUsers" tabindex="-1" role="dialog" aria-labelledby="editTokenTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">Edit User</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">`
                                    <form action="" id="updateuser" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="col-sm-12">
                                        <div class="form-group form-group-default">
                                            <label for="inlineinput" class="col-md col-form-label">Full Name</label>
                                           
                                                <input type="text" class="form-control input-full namainstansi" name="full_name" id="namainput" placeholder="">
                                        </div>

                                        </div>
                                        <div class="col-sm-12">
                                        <div class="form-group form-group-default">
                                            <label for="inlineinput" class="col-md col-form-label">Nick Name</label>
                                            
                                                <input type="text" class="form-control input-full email" name="nick_name" id="nickinput" placeholder="">                                         
                                        </div>
                                        </div>

                                        <div class="col-sm-12">
                                        <div class="form-group form-group-default">
                                            <label for="inlineinput" class="col-md col-form-label">ID Number</label>
                                            
                                                <input type="text" class="form-control input-full id_number" name="id_number" id="idinput" placeholder="">
                                            
                                        </div>
                                        </div>

                                        <div class="col-sm-12">
                                        <div class="form-group form-group-default">
                                            <label for="inlineinput" class="col-md col-form-label">Password</label>
                                            
                                                <input type="text" class="form-control input-full password" name="password" id="passinput" placeholder="">
                                                
                                            
                                        </div>
                                        </div>

                        
                                        <div class="col-sm-12">
                                        <div class="form-group form-group-default">
                                            <label for="inlineinput" class="col-md col-form-label">School</label>
                                           
                                                <input type="text" class="form-control input-full email" name="school" id="schoolinput" placeholder="">
                                        </div>
                                        </div>

                                        <div class="col-sm-12">
                                        <div class="form-group form-group-default">
                                            <label for="inlineinput" class="col-md col-form-label">Number Phone</label>
                                            
                                                <input type="text" class="form-control" name="no_hp" id="noinput" placeholder="">
                                        </div>
                                        </div>

                                        <div class="col-sm-12">
                                        <div class="form-group form-group-default">
                                            <label for="inlineinput" class="col-md col-form-label">Date Birth</label>
                                          
                                                <input type="date" class="form-control " name="date_birth" id="birthinput" placeholder="">
                                           

                                        </div>
                                        </div>

                                        <div class="col-sm-12">
                                        <div class="form-group form-group-default">
                                            <label for="inlineinput" class="col-md col-form-label">Activate Date</label>
                                          
                                                <input type="date" class="form-control " name="activate_date" id="active_input" placeholder="">
                                           

                                        </div>
                                        </div>

                                        <div class="col-sm-12">
                                        <div class="form-group form-group-default">
                                            <label for="inlineinput" class="col-md col-form-label">Status Account</label>

                                            <select name="status_account"  id="status_account_input"class="form-control">
                                                <option value="active">Active</option>
                                                <option value="inactive">Inactive</option>
                                            </select>
                                                                                
                                           

                                        </div>
                                        </div>
 
                                        <div class="col-sm-12">
                                                <div class="form-group form-group-default"> 
                                                   <label class="badge badge-success text-white py-2 w-100" style="font-size: 15px;">Image</label>
                                                    <input type="file" class="form-control input-full w-100" required name="gambar" id="isi_jawab2"></textarea>
                                                </div>
                                            </div>

                                            <div  iv class="text-center">
                                                        <img class="img" id="loadfotoadd" src="" alt="Foto Thumbnail"
                                                            style=" height:30%; width:30%;">                            
                                            </div>


                                        <!-- <div class="col-sm-12">
                                                    <div class="form-group form-group-default">
                                                        <label for="inlineinput" class="col-md col-form-label">Program Course</label>
                                                        <select id="coursePrograms" name="course_program_id" required class="form-control" onchange="getClasses_edit()">
                                                            <option value="" disabled>Choose</option>
                                                      
                                                            @foreach($coursePrograms as $course)
                                                                <option value="{{ $course->id }}">{{ $course->program }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                          
                                            <div class="col-sm-12">
                                                <div class="form-group form-group-default">
                                                    <label>Class</label>
                                                    <select id="class_edit" name="class_id" required class="form-control">
                                                        <option value="">Choose</option>
                                                    </select>
                                                </div>
                                            </div> -->

                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                    <button type="button" class="btn btn-primary" onclick="editUser()">
                                        Perbaharui</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-content mt-2 mb-3" id="pills-with-icon-tabContent">
                        <div class="tab-pane fade show active" id="pills-home-icon" role="tabpanel" aria-labelledby="pills-home-tab-icon">

                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="d-flex align-items-center">
                                            <h4 class="card-title"></h4>
                                            <button class="btn btn-primary btn-round ml-auto" data-toggle="modal" data-target="#addRowModal">
                                                <i class="fa fa-plus"></i>
                                               Add
                                            </button>
                                        </div>
                                    </div>
                                    <div class="card-body">


                                        <div class="table-responsive">
                                            <table id="add-row" class="display table table-striped table-hover">
                                                <thead>
                                                    <tr>
                                                        <th style="color:#000000;">Name</th>
                                                        <th style="color:#000000;">ID Number</th>
                                                        <th style="color:#000000;">Program</th>
                                                        <th style="color:#000000;">Class</th>
                                                        <th style="width: 10% ;color:#000000;">Action</th>
                                                    </tr>
                                                </thead>

                                                <tbody>

                                                    @foreach ($users as $user)

                                                    <tr>
                                                        <td>{{$user->full_name}}</td>
                                                        <td>{{$user->id_number}}</td>
                                                        <td>{{$user->program}}</td>
                                                        <td>{{$user->class}}</td>
                                                        <td>
                                                            <div style="display: flex; justify-content: space-between;">
                                                            <a href="{{url('student-schedules',$user->id)}}"><button class="btn btn-primary" style="font-size: 12px; width: fit-content;">Student Schedule</button></a>
                                                            
                                                                <div class="form-button-action" style="margin-left: 8px;">
                                                                    <button type="button" class="btn btn-sm" onclick="edit({{$user->id}})" data-toggle="modal" data-target="#editUsers" title="Edit User">
                                                                        <i class="fe fe-edit"></i>
                                                                    </button>
                                                                    <a href="{{url('hapususer'.'/'.$user->id)}}" data-toggle="modal" onClick="hapus(this)" data-target="#confirmation-modal" title="Hapus User">
                                                                        <i class="fe fe-trash"></i>
                                                                    </a>
                                                                </div>
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
                    <div class="modal fade" id="confirmation-modal" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-body text-center font-18">

                                    <h4 class="padding-top-30 mb-30 weight-500">Apakah Anda Ingin Menghapus User?</h4>
                                    <div class="padding-bottom-30 row" style="max-width: 170px; margin: 0 auto;">
                                        <div class="col-6">
                                            <button type="button" class="btn btn-warning border-radius-100 btn-block confirmation-btn" data-dismiss="modal"><i class="fe fe-info"></i></button>
                                            Tidak
                                        </div>
                                        <div class="col-6">
                                            <a href="#" id="linkhapus" class="btn btn-danger border-radius-100 btn-block confirmation-btn"><i class="fe fe-check"></i></a>
                                            Ya
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('js')

<script>

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



    function getClasses_edit() {
        var programId = document.getElementById("coursePrograms").value;
      
        var classSelect = document.getElementById("class_edit");
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
    $(document).ready(function() {
      



        function validateForm() {
            var inputs = document.getElementById("addUsers").getElementsByTagName("input");
            for (var i = 0; i < inputs.length; i++) {
                if (inputs[i].hasAttribute("required") && inputs[i].value.trim() === "") {
                    alert("Please fill in all required fields.");
                    return false;
                }
            }
            return true;
        }

        @if(session()->has('message'))
        Swal.fire({
            icon: 'success',
            title: 'Berhasil',
            text: "{{session()->get('message')}}",
        })
        @elseif(session()->has('error'))
        Swal.fire({
            icon: 'error',
            title: 'Gagal',
            text: "{{session()->get('error')}}",
        })
        @endif


        $('#basic-datatables').DataTable({});

        $('#multi-filter-select').DataTable({
            "pageLength": 5,
            initComplete: function() {
                this.api().columns().every(function() {
                    var column = this;
                    var select = $('<select class="form-control"><option value=""></option></select>')
                        .appendTo($(column.footer()).empty())
                        .on('change', function() {
                            var val = $.fn.dataTable.util.escapeRegex(
                                $(this).val()
                            );

                            column
                                .search(val ? '^' + val + '$' : '', true, false)
                                .draw();
                        });

                    column.data().unique().sort().each(function(d, j) {
                        select.append('<option value="' + d + '">' + d + '</option>')
                    });
                });
            }
        });

        // Add Row
        $('#add-row').DataTable({
            "pageLength": 5,
        });

        var action = '<td> <div class="form-button-action"> <button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg" data-original-title="Edit Task"> <i class="fa fa-edit"></i> </button> <button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-danger" data-original-title="Remove"> <i class="fa fa-times"></i> </button> </div> </td>';

        $('#addRowButton').click(function() {
            $('#add-row').dataTable().fnAddData([
                $("#addName").val(),
                $("#addPosition").val(),
                $("#addOffice").val(),
                action
            ]);
            $('#addRowModal').modal('hide');

        });
    });

    function edit(id) {
        $('.input-full').removeClass('is-invalid')
        $('.invalidtoken').removeClass('d-block').removeClass('d-none').addClass('d-none')
        axios.get("{{url('user')}}" + "/" + id)
            .then(function(response) {
                $("#namainput").val(response.data.full_name)
                $("#idinput").val(response.data.id_number)
                $("#schoolinput").val(response.data.school)
                $("#noinput").val(response.data.no_hp)
                $("#birthinput").val(response.data.date_birth)
                $("#nickinput").val(response.data.nick_name)
                $("#coursePrograms").val(response.data.course_program_id);
                $("#active_input").val(response.data.activate_date);
                $("#status_account_input").val(response.data.status_account);
                $("#loadfotoadd").attr("src", response.data.foto_profil);
                // $("#classs").val(response.data.class_id);
               
                var classId = response.data.class_id;
                console.log(classId)
                console.log(response.data.foto_profil)
           
                $("#class_edit").val(classId);
          
                $("#updateuser").attr("action", "{{url('userupdate')}}" + "/" + response.data.id)
            })
    }

    function editUser() {
        if ($('.namas').val() == "" || $('.emails').val() == "") {
            $('.namas').removeClass('is-invalid').addClass('is-invalid')
            $('.emails').removeClass('is-invalid').addClass('is-invalid')
        } else {
            $("#updateuser").submit()

        }
    }

    function hapus(url) {

        var link_hapus = url.href
        $('#linkhapus').attr('href', link_hapus)
    }
</script>
@endsection