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
                <h5>Data Customer</h5>
                <div class="card-header-right">
                    <div class="btn-group card-option">
                        <button type="button" class="btn dropdown-toggle btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="feather icon-more-horizontal"></i>
                        </button>
                        <ul class="list-unstyled card-option dropdown-menu dropdown-menu-right">
                            <li class="dropdown-item full-card"><a href="#!"><span><i class="feather icon-maximize"></i> maximize</span><span style="display:none"><i class="feather icon-minimize"></i> Restore</span></a></li>
                            <li class="dropdown-item minimize-card"><a href="#!"><span><i class="feather icon-minus"></i> collapse</span><span style="display:none"><i class="feather icon-plus"></i> expand</span></a></li>
                            <li class="dropdown-item reload-card"><a href="#!"><i class="feather icon-refresh-cw"></i> reload</a></li>
                            <li class="dropdown-item"><a data-toggle="modal" data-target="#formCustomer"><i class="feather icon-plus"></i> Tambah</a></li>
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
                                <th style="max-width: 100px;">Gambar</th>
                                <th style="max-width: 100px;">Nama Produk</th>
                                <th style="max-width: 100px;">Nama Customer</th>
                                <th>QTY</th>
                                <?php if (auth()->user()->level == "produksi") { ?>
                                    <th>Action</th>
                                <?php } else { ?>
                                    <th>Total Harga</th>
                                    <th>Status</th>
                                <?php } ?>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $row)
                            <tr>
                                <td><?= !empty($i) ? ++$i : $i = 1; ?></td>
                                <td><img style="max-height:65px" src="storage/produk-images/{{ $row->gambar }}"></td>
                                <td><?= $row->nama_produk; ?></td>
                                <td><?= $row->name; ?></td>
                                <td><?= $row->qty; ?></td>
                                <?php if (auth()->user()->level == "produksi") { ?>
                                    <td>
                                        <button type="button" class="btn  btn-icon btn-success"><i class="feather icon-check-circle"></i></button>
                                    </td>
                                <?php } else { ?>
                                    <td><?= $row->total_harga; ?></td>
                                    <td>
                                        @if($row->status == "Menunggu Pembayaran")
                                        <span class="badge bg-danger text-white p-2">{{ $row->status }}</span>
                                        @else
                                        <span class="badge bg-success text-white p-2">{{ $row->status }}</span>
                                        @endif
                                    </td>
                                <?php } ?>
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

@include('pages/admin/customer/form')
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

        $('#formCustomer').on('show.bs.modal', function(event) {

            var button = $(event.relatedTarget);
            var id = button.data('id');
            var mode = button.data('mode');
            var namacustomer = button.data('namacustomer');
            var email = button.data('email');
            var password = button.data('password');
            var modal = $(this);
            if (mode == 'edit') {

                modal.find('.modal-title').text('Edit Data Customer');
                modal.find('.modal-body #nama-customer').val(namacustomer);
                modal.find('.modal-body #email').val(email);
                modal.find('.modal-body #password').val(password);
                modal.find('.modal-body #method').html('{{ method_field("patch") }}<input type="hidden" name="id" value="' + id + '">');
            } else {

                modal.find('.modal-title').text('Tambah Data Customer');
                modal.find('.modal-body #nama-customer').val('');
                modal.find('.modal-body #email').val('');
                modal.find('.modal-body #password').val('');
                modal.find('.modal-body #method').html("");
            }
        });

        $('#deleteCustomer').on('show.bs.modal', function(event) {

            var button = $(event.relatedTarget);
            var id = button.data('id');
            var namacustomer = button.data('namacustomer');
            var modal = $(this);
            modal.find('.modal-body #idHapus').val(id);
            modal.find('.modal-body #dataHapus').text(namacustomer);
        });
    })
</script>
@endpush