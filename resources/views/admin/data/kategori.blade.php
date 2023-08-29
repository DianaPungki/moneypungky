@extends('layouts.app')
@section('wrapper')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Data Kategori</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Data</a></li>
              <li class="breadcrumb-item active">Kategori</li>
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
                <h3 class="card-title">Data kategori</h3>
                <a href="#" class="btn btn-primary btn-sm" type="button" style="float: right;" data-toggle="modal" data-target="#ModalAdd">Add Category</a>

              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th style="width: 10px">No</th>
                      <th>Kategori</th>
                      <th>Deskripsi</th>
                      <th>Kantong</th>
                      <th>Action</th>
                      <th>Created-At</th>
                      <th>Updated-At</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($kategori as $no=>$k )
                    <tr>
                      <td>{{ $no+1 }}</td>
                      <td>{{ $k->nama_kat }}</td>
                      <td>{{ $k->des_kat }}</td>
                      <td>
                        @if ($k->kantong == 'Yes')
                     
                          <span class="badge badge-success">Yes</span>
                        @elseif($k->kantong == 'No')
                          <span class="badge badge-danger">No</span>
                        @endif
                      </td>
                      <td>
                        <div class="btn-group btn-group-sm">
                          <div class="btn btn-success">
                            <a href="#" class="text-success bg-success border-0 edit-btn" data-toggle="modal" title="Edit" data-id="{{ $k->id_kat }}"><i
                                class='fas fa-edit'></i></a>
                          </div>
                          <div class="btn btn-danger">
                            <a href="#" class="text-danger bg-danger border-0 delete-btn" data-toggle="modal" title="Hapus" data-id="{{ $k->id_kat }}"><i
                                class='fas fa-trash'></i></a>
                          </div>
                        </div>
                      </td>
                      <td>{{ $k->created_at }}</td>
                      <td>{{ $k->updated_at }}</td>
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
                      <h4 class="modal-title">Add Category</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <form id="addForm">
                    {{-- <form id="addForm"> --}}
                      @csrf
                      <div class="modal-body">
                        <div class="mb-3 row">
                            <label for="nama_kat" class="col-sm-2 col-form-label">Category</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="nama_kat"
                                placeholder="Nama Category" >
                                <span class="text-danger">
                                    <strong id="nama_kat-error"></strong>
                                </span>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="des_kat" class="col-sm-2 col-form-label">Describe</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" name="des_kat" cols="30" rows="10" placeholder="Describe Category"></textarea>
                                <span class="text-danger">
                                    <strong id="des_kat-error"></strong>
                                </span>
                            </div>
                        </div>
                        <div class="mb-3 row">
                          <label for="kantong" class="col-sm-2 col-form-label">Kantong</label>
                          <div class="col-sm-10">
                              <select name="kantong" class="form-control" required>
                                  <option value="">Pilih</option>
                                  <option value="Yes">Yes</option>
                                  <option value="No">No</option>
                              </select>
                              <span class="text-danger">
                                  <strong id="kantong-error"></strong>
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
                      <h4 class="modal-title">Edit Category</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <form id="editForm">
                      @csrf
                      <input type="hidden" class="form-control" name="id_kat" id="id_kat">
                      <div class="modal-body">
                        <div class="mb-3 row">
                            <label for="nama_kat" class="col-sm-2 col-form-label">Category</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="nama_kat" id="nama_kat" placeholder="Nama BANK" >
                                <span class="text-danger">
                                    <strong id="nama_kat-erroru"></strong>
                                </span>
                            </div>
                        </div>
                        <div class="mb-3 row">
                          <label for="des_kat" class="col-sm-2 col-form-label">Describe</label>
                          <div class="col-sm-10">
                              <textarea class="form-control" name="des_kat" id="des_kat" cols="30" rows="10" placeholder="Describe Category"></textarea>
                              <span class="text-danger">
                                  <strong id="des_kat-erroru"></strong>
                              </span>
                          </div>
                      </div>
                      <div class="mb-3 row">
                        <label for="kantong" class="col-sm-2 col-form-label">Kantong</label>
                        <div class="col-sm-10">
                            <select name="kantong" id="kantong" class="form-control" required>
                                <option value="">Pilih</option>
                                <option value="Yes">Yes</option>
                                <option value="No">No</option>
                            </select>
                            <span class="text-danger">
                                <strong id="kantong-erroru"></strong>
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
              url : "{{url('admin/data/kategori/add')}}",
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
              data: {'id_kat':$(this).data('id'), '_token': "{{csrf_token()}}"},
              type: 'POST',
              url : "{{url('admin/data/kategori/edit')}}",
              success : function(data){
                  $('#id_kat').val(data[0].id_kat);
                  $('#nama_kat').val(data[0].nama_kat);
                  $('#des_kat').val(data[0].des_kat);
                  $('#kantong').val(data[0].kantong);

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
            url : "{{url('admin/data/kategori')}}",
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
      var confirmed = confirm('Delete Category ?');

      if(confirmed) {
          $.ajax({
              data: {'id_kat':$(this).data('id'), '_token': "{{csrf_token()}}"},
              type: 'DELETE',
              url : "{{url('admin/data/kategori')}}",
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

