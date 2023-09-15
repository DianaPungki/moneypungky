@extends('layouts.app')
@section('wrapper')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Data Bank</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Data</a></li>
              <li class="breadcrumb-item active">Bank</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Data Tabungan</h3>
                <a href="#" class="btn btn-primary btn-sm" type="button" style="float: right;" data-toggle="modal" data-target="#ModalAdd">Add Bank</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th style="width: 10px">No</th>
                      <th>Nama</th>
                      <th class="none">Created-At</th>
                      <th class="none">Updated-At</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($bank as $no=>$b )
                      <tr>
                        <td>{{ $no+1 }}</td>
                        <td>{{ $b->nama_bank }}</td>
                        <td>{{ $b->created_at }}</td>
                        <td>{{ $b->updated_at }}</td>
                        <td>
                          <div class="btn-group btn-group-sm">
                            <div class="btn btn-success">
                              <a href="#" class="text-success bg-success border-0 edit-btn" data-toggle="modal" title="Edit" data-id="{{ $b->id_bank }}"><i
                                  class='fas fa-edit'></i></a>
                            </div>
                            <div class="btn btn-danger">
                              <a href="#" class="text-danger bg-danger border-0 delete-btn" data-toggle="modal" title="Hapus" data-id="{{ $b->id_bank }}"><i
                                  class='fas fa-trash'></i></a>
                            </div>
                          </div>
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->

              {{-- Modal Add --}}
              <div class="modal fade" id="ModalAdd">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title">Add Bank</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <form id="addForm">
                    {{-- <form id="addForm"> --}}
                      @csrf
                      <div class="modal-body">
                        <div class="mb-3 row">
                            <label for="nama_bank" class="col-sm-2 col-form-label">Bank</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="nama_bank"
                                placeholder="Nama BANK" >
                                <span class="text-danger">
                                    <strong id="nama_bank-error"></strong>
                                </span>
                            </div>
                        </div>
                      </div>
                      <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">
                          <span class="spinner-border spinner-border-sm spinner" role="status" aria-hidden="true"></span>Save
                        </button>
                      </div>
                    </form>
                  </div>
                  <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
              </div>

              {{-- Modal Edit --}}
              <div class="modal fade" id="ModalEdit">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title">Edit Bank</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <form id="editForm">
                      @csrf
                      <input type="hidden" class="form-control" name="id_bank" id="id_bank">
                      <div class="modal-body">
                        <div class="mb-3 row">
                            <label for="nama_bank" class="col-sm-2 col-form-label">Bank</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="nama_bank" id="nama_bank" placeholder="Nama BANK" >
                                <span class="text-danger">
                                    <strong id="nama_bank-erroru"></strong>
                                </span>
                            </div>
                        </div>
                      </div>
                      <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">
                          <span class="spinner-border spinner-border-sm spinner" role="status" aria-hidden="true"></span>Save
                        </button>
                      </div>
                    </form>
                  </div>
                  <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
              </div>

            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>

<!-- jQuery -->
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>

<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, 
      "lengthChange": false, 
      "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    
  });

  $(document).ready(function () {
      $('.spinner').hide();

      $('[data-toggle="tooltip"]').tooltip();
      
      $('#addForm').submit(function(e){
          e.preventDefault();

          $.ajax({
              url : "{{url('admin/data/bank/add')}}",
              type: "POST",
              data: $(this).serialize(),
              beforeSend: function(){
                  $('.spinner').show();
              },
              complete: function(){
                  $('.spinner').hide();
              },
              success: function(data){
                  swal.fire("Done !", data.pesan, "success");
                  setTimeout(function(){
                      location.reload();
                  },2000);
              },
              error: function(err){
                  var errors = err.responseJSON.errors;
                  $.each(errors, function(key, value) {
                      $( '#' + key + '-error').text(value[0]);
                  });
              }
          })
      });

      // Tampilkan Modal Edit ketika tombol Edit ditekan
      $('.edit-btn').click(function(e) {
          e.preventDefault();
          $.ajax({
              data: {'id_bank':$(this).data('id'), '_token': "{{csrf_token()}}"},
              type: 'POST',
              url : "{{url('admin/data/bank/edit')}}",
              success : function(data){
                  $('#id_bank').val(data[0].id_bank);
                  $('#nama_bank').val(data[0].nama_bank);

                  $('#ModalEdit').modal('show');
              },
              error : function(err){
                  alert(err);
                  console.log(err);
              }
          });
      });

      // Kirim data update ke server
      $('#editForm').submit(function (e) {
          e.preventDefault();
          $.ajax({
            url : "{{url('admin/data/bank')}}",
          type: "PUT",
          data: $(this).serialize(),
          beforeSend: function(){
              $('.spinner').show();
          },
          complete: function(){
              $('.spinner').hide();
          },
          success: function(data){
              swal.fire("Done !", data.pesan, "success");
              setTimeout(function(){
                  location.reload();
              },2000);
          },
          error: function(err){
              var errors = err.responseJSON.errors;
              $.each(errors, function(key, value) {
                  $( '#' + key + '-erroru').text(value[0]);
              });
          }
      })
      });

      // Kirim data delete ke server
      $('.delete-btn').click(function(e){
      e.preventDefault();
      var confirmed = confirm('Hapus Data BANK Ini ?');

      if(confirmed) {
          $.ajax({
              data: {'id_bank':$(this).data('id'), '_token': "{{csrf_token()}}"},
              type: 'DELETE',
              url : "{{url('admin/data/bank')}}",
              success: function(data){
                  swal.fire("Done !", data.pesan, "success");
                  setTimeout(function(){
                      location.reload();
                  },2000);
              },
              error : function(err){
                  alert(err);
                  console.log(err);
              }
          });
      }
      });

      
    });
</script>
@endsection

