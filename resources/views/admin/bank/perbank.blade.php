@extends('layouts.app')
@section('wrapper')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Data BANK</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">BANK</a></li>
                        <li class="breadcrumb-item active">{{ $bank->nama_bank }}</li>
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
                            <h3 class="card-title">Data BANK {{ $bank->nama_bank }}</h3>
                            <div class="btn-group" style="float: right;">
                                <a href="#" class="btn btn-primary btn-sm" type="button" data-toggle="modal"
                                    data-target="#ModalMasuk">Masuk Bank {{ $bank->nama_bank }}</a>
                                <a href="#" class="btn btn-secondary btn-sm" type="button" data-toggle="modal"
                                    data-target="#ModalKeluar">keluar Bank {{ $bank->nama_bank }}</a>
                            </div>

                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th style="width: 10px">No</th>
                                        <th>Masuk</th>
                                        <th>Keluar</th>
                                        <th class="none">Nama</th>
                                        <th class="none">Bank</th>
                                        <th class="none">Kategori</th>
                                        <th class="none">Tanggal</th>
                                        <th class="none">Created-At</th>
                                        <th class="none">Updated-At</th>
                                        {{-- <th>Action</th> --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($perbank as $no=>$p )
                                    <tr>
                                        <td>{{ $no+1 }}</td>
                                        <td> Rp. {{ number_format (floatval($p->jumlah_masuk),0,',','.')  }}</td>
                                        <td> Rp. {{ number_format (floatval($p->jumlah_keluar),0,',','.')  }}</td>
                                        <td>{{ $p->nama_trans }}</td>
                                        <td>{{ $p->nama_bank }}</td>
                                        <td>{{ $p->nama_kat }}</td>
                                        <td>{{ $p->tanggal_trans }}</td>
                                        <td>{{ $p->created_at }}</td>
                                        <td>{{ $p->updated_at }}</td>
                                        {{-- <td>
                                              <div class="btn-group btn-group-sm">
                                                <div class="btn btn-success">
                                                  <a href="#" class="text-success bg-success border-0 edit-btn" data-toggle="modal" title="Edit" data-id="{{ $p->id_bank }}"><i
                                            class='fas fa-edit'></i></a>
                                  </div>
                                  <div class="btn btn-danger">
                                      <a href="#" class="text-danger bg-danger border-0 delete-btn" data-toggle="modal"
                                          title="Hapus" data-id="{{ $p->id_bank }}"><i class='fas fa-trash'></i></a>
                                  </div>
                              </div>
                              </td> --}}
                              </tr>
                              @endforeach
                              </tbody>
                              <tfoot>
                                  <tr>
                                      <th>Total</th>
                                      <th>Rp. {{ number_format (floatval($perbank->sum('jumlah_masuk')),0,',','.')  }}</th>
                                      <th>Rp. {{ number_format (floatval($perbank->sum('jumlah_keluar')),0,',','.')  }}</th>
                                      <th></th>
                                      <th></th>
                                      <th></th>
                                      <th></th>
                                      <th></th>
                                      <th></th>
                                  </tr>
                              </tfoot>
                            </table>

                    {{-- total semua --}}
                    <h3>Total Rp.
                        {{ number_format ($perbank->sum('jumlah_masuk')-$perbank->sum('jumlah_keluar'),0,',','.')  }}
                    </h3>

                    {{-- table perkantong --}}
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Kantong</th>
                                <th>Jumlah</th>
                            </tr>
                            @foreach ($kantong as $k)
                            <tr>
                                <th>{{ $k->nama_kat }}</th>
                                <td> Rp. {{ number_format ($k->saldo ,0,',','.')  }}</td>
                            </tr>
                            @endforeach
                        </thead>
                    </table>
                </div>
                <!-- /.card-body -->

                {{-- Modal Add --}}
                <div class="modal fade" id="ModalAdd">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Add Transaksi Bank {{ $bank->nama_bank }}</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form id="addForm">
                                {{-- <form id="addForm"> --}}
                                @csrf
                                <div class="modal-body">
                                    <div class="mb-3 row">
                                        <label for="jumlah_masuk" class="col-sm-2 col-form-label">Jumlah</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="jumlah_masuk"
                                                onkeyup="formatRupiah(this)" placeholder="Jumlah Tabung">
                                            <span class="text-danger">
                                                <strong id="jumlah_masuk-error"></strong>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="nama_trans" class="col-sm-2 col-form-label">Nama</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="nama_trans"
                                                placeholder="Nama Tabung">
                                            <span class="text-danger">
                                                <strong id="nama_trans-error"></strong>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="id_bank" class="col-sm-2 col-form-label">BANK</label>
                                        <div class="col-sm-10">
                                            <input type="hidden" class="form-control" name="id_bank"
                                                value="{{ $bank->id_bank }}" readonly>
                                            <input type="text" class="form-control" name="nama_bank"
                                                value="{{ $bank->nama_bank }}" readonly>
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
                                    <div class="mb-3 row">
                                        <label for="tanggal_trans" class="col-sm-2 col-form-label">Tanggal</label>
                                        <div class="col-sm-10">
                                            <input type="date" class="form-control" name="tanggal_trans">
                                            <span class="text-danger">
                                                <strong id="tanggal_trans-error"></strong>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer justify-content-between">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">
                                        <span class="spinner-border spinner-border-sm spinner" role="status"
                                            aria-hidden="true"></span>Save
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
                                            <input type="text" class="form-control" name="nama_bank" id="nama_bank"
                                                placeholder="Nama BANK">
                                            <span class="text-danger">
                                                <strong id="nama_bank-erroru"></strong>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer justify-content-between">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">
                                        <span class="spinner-border spinner-border-sm spinner" role="status"
                                            aria-hidden="true"></span>Save
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
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
            "order": [
                [3, 'asc']
            ]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

    });

    $(document).ready(function () {
        $('.spinner').hide();

        $('[data-toggle="tooltip"]').tooltip();

        $('#addForm').submit(function (e) {
            e.preventDefault();

            $.ajax({
                url: "{{url('admin/transaksi/masuk/add')}}",
                type: "POST",
                data: $(this).serialize(),
                beforeSend: function () {
                    $('.spinner').show();
                },
                complete: function () {
                    $('.spinner').hide();
                },
                success: function (data) {
                    swal.fire("Done !", data.pesan, "success");
                    setTimeout(function () {
                        location.reload();
                    }, 2000);
                },
                error: function (err) {
                    var errors = err.responseJSON.errors;
                    $.each(errors, function (key, value) {
                        $('#' + key + '-error').text(value[0]);
                    });
                }
            })
        });

        // Tampilkan Modal Edit ketika tombol Edit ditekan
        $('.edit-btn').click(function (e) {
            e.preventDefault();
            $.ajax({
                data: {
                    'id_trans': $(this).data('id'),
                    '_token': "{{csrf_token()}}"
                },
                type: 'POST',
                url: "{{url('admin/transaksi/masuk/edit')}}",
                success: function (data) {
                    $('#id_trans').val(data[0].id_trans);
                    $('#nama_trans').val(data[0].nama_trans);
                    $('#jumlah_masuk').val(data[0].jumlah_masuk);
                    $('#id_bank').val(data[0].id_bank);
                    $('#id_kat').val(data[0].id_kat);
                    $('#tanggal_trans').val(data[0].tanggal_trans);

                    $('#ModalEdit').modal('show');
                },
                error: function (err) {
                    alert(err);
                    console.log(err);
                }
            });
        });

        // Kirim data update ke server
        $('#editForm').submit(function (e) {
            e.preventDefault();
            $.ajax({
                url: "{{url('admin/transaksi/masuk')}}",
                type: "PUT",
                data: $(this).serialize(),
                beforeSend: function () {
                    $('.spinner').show();
                },
                complete: function () {
                    $('.spinner').hide();
                },
                success: function (data) {
                    swal.fire("Done !", data.pesan, "success");
                    setTimeout(function () {
                        location.reload();
                    }, 2000);
                },
                error: function (err) {
                    var errors = err.responseJSON.errors;
                    $.each(errors, function (key, value) {
                        $('#' + key + '-erroru').text(value[0]);
                    });
                }
            })
        });

        // Kirim data delete ke server
        $('.delete-btn').click(function (e) {
            e.preventDefault();
            var confirmed = confirm('Delete Transaksi Masuk ?');

            if (confirmed) {
                $.ajax({
                    data: {
                        'id_trans': $(this).data('id'),
                        '_token': "{{csrf_token()}}"
                    },
                    type: 'DELETE',
                    url: "{{url('admin/transaksi/masuk')}}",
                    success: function (data) {
                        swal.fire("Done !", data.pesan, "success");
                        setTimeout(function () {
                            location.reload();
                        }, 2000);
                    },
                    error: function (err) {
                        alert(err);
                        console.log(err);
                    }
                });
            }
        });
    });

    // format rupiah
    function formatRupiah(input) {
        var angka = input.value.replace(/\D/g, '');

        angka = angka.replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.');

        input.value = angka;

        if (angka.length === 0) {
            input.value = '';
        }
    }

</script>
@endsection
