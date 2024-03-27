@extends('template.master')
@section('judul','Kelola User')
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
                                            Tambah</span>
                                        <span class="fw-light">
                                            User
                                        </span>
                                    </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{url('kelolauser')}}" method="post" id="addUsers">
                                        @csrf

                                        <div class="row">

                                            <div class="col-sm-12">
                                                <div class="form-group form-group-default">
                                                    <label>Role</label>
                                                    <select name="role" class="form-control">
                                                        <option value="siswa">Siswa</option>
                                                   
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-sm-12">
                                                <div class="form-group form-group-default">
                                                    <label>Full Name</label>
                                                    <input id="addName" type="text" name="nama" required class="form-control" placeholder="">
                                                </div>
                                            </div>

                                            <div class="col-sm-12">
                                                <div class="form-group form-group-default">
                                                    <label>Id Number</label>
                                                    <input id="addemail" type="email" name="email" required class="form-control" placeholder="">
                                                </div>
                                            </div>

                                            <div class="col-sm-12">
                                                <div class="form-group form-group-default">
                                                    <label>Password</label>
                                                    <input id="addpassword" type="password" name="password" required class="form-control" placeholder="">
                                                </div>
                                            </div>

                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer no-bd">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
                                    <button class="btn btn-primary" onclick="document.getElementById('addUsers').submit()">Tambah</button>
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
                                    <form action="" id="updateuser" method="post">
                                        @csrf
                                        <div class="form-group form-inline">
                                            <label for="inlineinput" class="col-md-3 col-form-label">Full Name</label>
                                            <div class="col-md-9 p-0">
                                                <input type="text" class="form-control input-full namainstansi" name="nama" id="namainput" placeholder="">
                                            </div>

                                        </div>
                                        <div class="form-group form-inline">
                                            <label for="inlineinput" class="col-md-3 col-form-label">ID Number</label>
                                            <div class="col-md-9 p-0">
                                                <input type="text" class="form-control input-full email" name="email" id="emailinput" placeholder="">
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
                    </div>

                    <div class="tab-content mt-2 mb-3" id="pills-with-icon-tabContent">
                        <div class="tab-pane fade show active" id="pills-home-icon" role="tabpanel" aria-labelledby="pills-home-tab-icon">

                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="d-flex align-items-center">
                                            <h4 class="card-title">Siswa</h4>
                                            <button class="btn btn-primary btn-round ml-auto" data-toggle="modal" data-target="#addRowModal">
                                                <i class="fa fa-plus"></i>
                                                Tambah User
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
                                                        <th style="width: 10% ;color:#000000;">Action</th>
                                                    </tr>
                                                </thead>

                                                <tbody>

                                                    @foreach ($users as $user)
                                     
                                                    <tr>
                                                        <td>{{$user->full_name}}</td>
                                                        <td>{{$user->id_number}}</td>
                                                        <td>
                                                        <div class="form-button-action">
                                                                <button type="button" class="btn btn-sm" onclick="edit({{$user->id}})" data-toggle="modal" data-target="#editUsers" title="" data-original-title="Edit User">
                                                                <i class="fe fe-edit "></i> 
                                                                </button>

                                                                <a href="{{url('hapususer'.'/'.$user->id)}}" data-toggle="modal" onClick="hapus(this)" data-target="#confirmation-modal" title="" data-original-title="Hapus User">
                                                                    <i class="fe fe-trash"></i>
                                                                </a>


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
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('js')
<script>
    $(document).ready(function() {

        @if(session()->has('message'))
   Swal.fire({
      icon: 'success',
      title: 'Berhasil',
      text: "{{session()->get('message')}}",
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
        axios.get("{{url('kelolauser')}}" + "/" + id)
            .then(function(response) {
                $("#emailinput").val(response.data.email)
                $("#namainput").val(response.data.name)
                $("#passwordinput").val(response.data.password)
                $("#updateuser").attr("action", "{{url('kelolauserup')}}" + "/" + response.data.id)
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