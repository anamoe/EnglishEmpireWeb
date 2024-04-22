@extends('template.master')
@section('judul','Message')
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
                                            Message
                                        </span>
                                    </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>

                                <div class="modal-body">
                                    <form action="{{url('message')}}" method="post" id="addUsers" onsubmit="return validateForm()">
                                        @csrf

                                        <div class="row">
                                           
                                            <div class="col-sm-12">
                                                <div class="form-group form-group-default">
                                                    <label>Message</label>
                                                    <input id="message" type="text" name="message" required class="form-control" placeholder="">
                                                </div>
                                            </div>
                                         
                                            <div class="col-sm-12">
                                                <div class="form-group form-group-default">
                                                    <label>Type Message</label>
                                                    <input id="type_message" type="text" name="type_message" required class="form-control" placeholder="">
                                                </div>
                                            </div>
<!-- 
                                            <div class="col-sm-12">
                                                <div class="form-group form-group-default">
                                                    <label>Note</label>
                                                    <select name="status_account" class="form-control">
                                                <option value="Alpha">Alpha</option>
                                                <option value="Sick">Sick</option>
                                                <option value="Prsent">Present</option>
                                                <option value="None">None</option>
                                            </select>
                                                       
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
                    <!-- <div class="modal fade" id="editUsers" tabindex="-1" role="dialog" aria-labelledby="editTokenTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">Edit Message</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">`
                                    <form action="" id="updateuser" method="post" enctype="multipart/form-data">
                                        @csrf
                                    

                                        <div class="col-sm-12">
                                        <div class="form-group form-group-default">
                                            <label for="inlineinput" class="col-md col-form-label">Homework</label>
                                            <div class="form-group form-group-default">
                                                 
                                                    <input id="homework" type="text" name="homework" required class="form-control" placeholder="">
                                                </div>        
                                           

                                        </div>
                                        </div>

                                        <div class="col-sm-12">
                                        <div class="form-group form-group-default">
                                            <label for="inlineinput" class="col-md col-form-label">Note</label>

                                            <select name="note"  id="note_input"class="form-control">
                                                <option value="Alpha">Alpha</option>
                                                <option value="Sick">Sick</option>
                                                <option value="Present">Present</option>
                                                <option value="Permit">Permit</option>
                                                <option value="None">None</option>
                                            </select>
                                                                                
                                           

                                        </div>
                                        </div>
 
 
                                     

                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                    <button type="button" class="btn btn-primary" onclick="editUser()">
                                        Perbaharui</button>
                                </div>
                            </div>
                        </div>
                    </div> -->

                    <div class="tab-content mt-2 mb-3" id="pills-with-icon-tabContent">
                        <div class="tab-pane fade show active" id="pills-home-icon" role="tabpanel" aria-labelledby="pills-home-tab-icon">

                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="d-flex align-items-center">
                                         
                                            <button class="btn btn-primary btn-round ml-auto" data-toggle="modal" data-target="#addRowModal">
                                                <i class="fa fa-plus"></i>
                                          Add Message
                                            </button>
                                        </div>
                                    </div>
                                    <div class="card-body">


                                        <div class="table-responsive">
                                            <table id="add-row" class="display table table-striped table-hover">
                                                <thead>
                                                    <tr>
                                                        <th style="color:#000000;">Message</th>
                                                        <th style="color:#000000;">Type Message</th>
                                                    
                                                        <th style="width: 10% ;color:#000000;">Action</th>
                                                    </tr>
                                                </thead>

                                                <tbody>

                                                    @foreach ($m as $user)

                                                    <tr>
                                                        <td>{{$user->message}}</td>
                                                        <td>{{$user->type_message}}</td>
                                                
                                                        <td>
                                                            <!-- <div class="form-button-action">
                                                                <button type="button" class="btn btn-sm" onclick="edit({{$user->id}})" data-toggle="modal" data-target="#editUsers" title="" data-original-title="Edit User">
                                                                    <i class="fe fe-edit "></i>
                                                                </button>

                                                                <a href="{{url('schedule-student-delete'.'/'.$user->id)}}" data-toggle="modal" onClick="hapus(this)" data-target="#confirmation-modal" title="" data-original-title="Hapus User">
                                                                    <i class="fe fe-trash"></i>
                                                                </a>


                                                            </div> -->
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

                                    <h4 class="padding-top-30 mb-30 weight-500">Apakah Anda Ingin Menghapus ?</h4>
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
        axios.get("{{url('student-schedule')}}" + "/" + id)
            .then(function(response) {
                $("#note_input").val(response.data.note)
                $("#homework").val(response.data.homework)

          
                $("#updateuser").attr("action", "{{url('schedule-student-update')}}" + "/" + response.data.id)
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