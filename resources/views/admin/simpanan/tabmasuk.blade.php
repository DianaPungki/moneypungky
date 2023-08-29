@extends('layouts.app')
@section('wrapper')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Data Transaksi</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Simpanan</a></li>
              <li class="breadcrumb-item active">Transaksi</li>
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
                <h3 class="card-title">Data Transaksi Masuk</h3>
                <a href="#" class="btn btn-primary btn-sm" type="button" style="float: right;" data-toggle="modal" data-target="#ModalAdd">Add Masuk</a>

              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th style="width: 10px">No</th>
                      <th>Jumlah</th>
                      <th>Nama</th>
                      <th>Bank</th>
                      <th>Kategori</th>
                      <th>Action</th>
                      <th>Created-At</th>
                      <th>Updated-At</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($tabmasuk as $no=>$t )
                      <tr>
                        <td>{{ $no+1 }}</td>
                        <td> Rp. {{ number_format ($t->jumlah_masuk,0,',','.')  }}</td>
                        <td>{{ $t->nama_masuk }}</td>
                        <td>{{ $t->nama_bank }}</td>
                        <td>{{ $t->nama_kat }}</td>
                        <td>
                          <div class="btn-group btn-group-sm">
                            <div class="btn btn-success">
                              <a href="#" class="text-success bg-success border-0 edit-btn" data-toggle="modal" title="Edit" data-id="{{ $t->id_masuk }}"><i
                                  class='fas fa-edit'></i></a>
                            </div>
                            <div class="btn btn-danger">
                              <a href="#" class="text-danger bg-danger border-0 delete-btn" data-toggle="modal" title="Hapus" data-id="{{ $t->id_masuk }}"><i
                                  class='fas fa-trash'></i></a>
                            </div>
                          </div>
                        </td>
                        <td>{{ $t->created_at }}</td>
                        <td>{{ $t->updated_at }}</td>
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
                      <h4 class="modal-title">Add Transaksi Masuk</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <form id="addForm">
                      @csrf
                      <div class="modal-body">
                        <div class="mb-3 row">
                            <label for="jumlah_masuk" class="col-sm-2 col-form-label">Jumlah</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" name="jumlah_masuk"
                                placeholder="Jumlah Tabung" >
                                <span class="text-danger">
                                    <strong id="jumlah_masuk-error"></strong>
                                </span>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="nama_masuk" class="col-sm-2 col-form-label">Nama</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="nama_masuk"
                                placeholder="Nama Tabung" >
                                <span class="text-danger">
                                    <strong id="nama_masuk-error"></strong>
                                </span>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="id_bank" class="col-sm-2 col-form-label">BANK</label>
                            <div class="col-sm-10">
                                <select class="form-control" name="id_bank" required>
                                  <option value="">Pilih</option>
                                  @foreach ($bank as $b)
                                  <option value="{{ $b->id_bank }}">{{ $b->nama_bank }}</option>
                                  @endforeach
                                </select>
                                <span class="text-danger">
                                    <strong id="id_bank-error"></strong>
                                </span>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="id_kat" class="col-sm-2 col-form-label">Category</label>
                            <div class="col-sm-10">
                                <select class="form-control" name="id_kat" required>
                                  <option value="">Pilih</option>
                                  @foreach ($kategori as $k)
                                  <option value="{{ $k->id_kat }}">{{ $k->nama_kat }}</option>
                                  @endforeach
                                </select>
                                <span class="text-danger">
                                    <strong id="id_kat-error"></strong>
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
                      <h4 class="modal-title">Edit Transaksi Masuk</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <form id="editForm">
                      @csrf
                      <input type="hidden" class="form-control" name="id_masuk" id="id_masuk">
                      <div class="modal-body">
                        <div class="mb-3 row">
                            <label for="jumlah_masuk" class="col-sm-2 col-form-label">Jumlah</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" name="jumlah_masuk" id="jumlah_masuk"
                                placeholder="Jumlah Tabung" >
                                <span class="text-danger">
                                    <strong id="jumlah_masuk-erroru"></strong>
                                </span>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="nama_masuk" class="col-sm-2 col-form-label">Nama</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="nama_masuk" id="nama_masuk"
                                placeholder="Nama Tabung" >
                                <span class="text-danger">
                                    <strong id="nama_masuk-erroru"></strong>
                                </span>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="id_bank" class="col-sm-2 col-form-label">BANK</label>
                            <div class="col-sm-10">
                                <select class="form-control" name="id_bank" id="id_bank" required>
                                  <option value="">Pilih</option>
                                  @foreach ($bank as $b)
                                  <option value="{{ $b->id_bank }}">{{ $b->nama_bank }}</option>
                                  @endforeach
                                </select>
                                <span class="text-danger">
                                    <strong id="id_bank-erroru"></strong>
                                </span>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="id_kat" class="col-sm-2 col-form-label">Category</label>
                            <div class="col-sm-10">
                                <select class="form-control" name="id_kat" id="id_kat" required>
                                  <option value="">Pilih</option>
                                  @foreach ($kategori as $k)
                                  <option value="{{ $k->id_kat }}">{{ $k->nama_kat }}</option>
                                  @endforeach
                                </select>
                                <span class="text-danger">
                                    <strong id="id_kat-erroru"></strong>
                                </span>
                            </div>
                        </div>
                      </div>
                      <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">
                          <span class="spinner-border spinner-border-sm spinner" role="status" aria-hidden="true"></span>Update
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
              url : "{{url('admin/transaksi/masuk/add')}}",
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
              data: {'id_masuk':$(this).data('id'), '_token': "{{csrf_token()}}"},
              type: 'POST',
              url : "{{url('admin/transaksi/masuk/edit')}}",
              success : function(data){
                  $('#id_masuk').val(data[0].id_masuk);
                  $('#nama_masuk').val(data[0].nama_masuk);
                  $('#jumlah_masuk').val(data[0].jumlah_masuk);
                  $('#id_bank').val(data[0].id_bank);
                  $('#id_kat').val(data[0].id_kat);

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
            url : "{{url('admin/transaksi/masuk')}}",
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
      var confirmed = confirm('Delete Transaksi Masuk ?');

      if(confirmed) {
          $.ajax({
              data: {'id_masuk':$(this).data('id'), '_token': "{{csrf_token()}}"},
              type: 'DELETE',
              url : "{{url('admin/transaksi/masuk')}}",
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
