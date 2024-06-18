<?php

use Illuminate\Contracts\Session\Session;
?>
@extends('templates/admin/header')

@section('content')
<div class="row">
    <!-- [ sample-page ] start -->
    <div class="col-sm-12">
        <div class="card">

            <div class="card-header">
                <h5>Data Produk</h5>
                <div class="card-header-right">
                    <div class="btn-group card-option">
                        <button type="button" class="btn dropdown-toggle btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="feather icon-more-horizontal"></i>
                        </button>
                        <ul class="list-unstyled card-option dropdown-menu dropdown-menu-right">
                            <li class="dropdown-item full-card"><a href="#!"><span><i class="feather icon-maximize"></i> maximize</span><span style="display:none"><i class="feather icon-minimize"></i> Restore</span></a></li>
                            <li class="dropdown-item minimize-card"><a href="#!"><span><i class="feather icon-minus"></i> collapse</span><span style="display:none"><i class="feather icon-plus"></i> expand</span></a></li>
                            <li class="dropdown-item reload-card"><a href="#!"><i class="feather icon-refresh-cw"></i> reload</a></li>
                            <li class="dropdown-item"><a data-toggle="modal" data-target="#formProduk"><i class="feather icon-plus"></i> Tambah</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="pagination" class="table table-hover display">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th style="max-width: 100px;">Nama Produk</th>
                                <th>Gambar</th>
                                <th>Harga</th>
                                <th>Deskripsi</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $row)
                            <tr>
                                <td><?= !empty($i) ? ++$i : $i = 1; ?></td>
                                <td><?= $row->nama_produk; ?></td>
                                <td><img style="max-height:65px" src="storage/produk-images/{{ $row->gambar }}"></td>
                                <td><?= $row->harga; ?></td>
                                <td><?= $row->deskripsi; ?></td>
                                <td>
                                    <button type="button" class="btn  btn-icon btn-sm btn-primary" data-toggle="modal" data-target="#formProduk" data-mode="edit" data-id="{{ $row->id_produk }}" data-namaproduk="{{ $row->nama_produk }}" data-harga="{{ $row->harga }}" data-deskripsi="{{ $row->deskripsi }}"><i class="feather icon-edit"></i></button>
                                    <button type="button" class="btn  btn-icon btn-sm btn-danger" data-toggle="modal" data-target="#deleteProduk" data-id="{{ $row->id_produk }}" data-gambar="{{ $row->gambar }}" data-namaproduk="{{ $row->nama_produk }}"><i class="feather icon-trash"></i></button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- [ sample-page ] end -->
</div>

@include('pages/admin/produk/form')
@endsection

@push('script')

@if($message = Session('success'))
<script>
    Swal.fire({
        title: 'Sukses !',
        text: '<?= $message; ?>',
        icon: 'success',
        confirmButtonText: 'Ok',
        customClass: {
            confirmButton: 'btn btn-primary'
        }
    });
</script>
@elseif($message = Session('failed'))
<script>
    Swal.fire({
        title: 'Gagal !',
        text: '<?= $message; ?>',
        icon: 'error',
        confirmButtonText: 'Ok',
        customClass: {
            confirmButton: 'btn btn-primary'
        }
    });
</script>
@endif

<script>
    $(function() {
        $('#pagination').DataTable({
            paging: true,
            pageLength: 5,
            language: {
                paginate: {
                    previous: '<i class="fas fa-chevron-left"></i>', // Icon untuk tombol sebelumnya
                    next: '<i class="fas fa-chevron-right"></i>' // Icon untuk tombol berikutnya
                }
            }
        });

        $('#formProduk').on('show.bs.modal', function(event) {

            var button = $(event.relatedTarget);
            var id = button.data('id');
            var mode = button.data('mode');
            var namaproduk = button.data('namaproduk');
            var harga = button.data('harga');
            var deskripsi = button.data('deskripsi');
            var modal = $(this);
            if (mode == 'edit') {

                modal.find('.modal-title').text('Edit Data Produk');
                modal.find('.modal-body #nama-produk').val(namaproduk);
                modal.find('.modal-body #harga').val(harga);
                modal.find('.modal-body #deskripsi').val(deskripsi);
                modal.find('.modal-body #method').html('{{ method_field("patch") }}<input type="hidden" name="id" value="' + id + '">');
            } else {

                modal.find('.modal-title').text('Tambah Data Produk');
                modal.find('.modal-body #nama-produk').val('');
                modal.find('.modal-body #harga').val('');
                modal.find('.modal-body #deskripsi').val('');
                modal.find('.modal-body #method').html("");
            }
        });

        $('#deleteProduk').on('show.bs.modal', function(event) {

            var button = $(event.relatedTarget);
            var id = button.data('id');
            var gambar = button.data('gambar');
            var namaproduk = button.data('namaproduk');
            var modal = $(this);
            modal.find('.modal-body #idHapus').val(id);
            modal.find('.modal-body #gambarLama').val(gambar);
            modal.find('.modal-body #dataHapus').text(namaproduk);
        });
    })
</script>
@endpush