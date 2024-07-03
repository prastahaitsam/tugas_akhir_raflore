@extends('templates/user/header')

@section('content')
<!-- end hero area -->

<!-- info section -->
<section class="shop_section">
    <div class="container mt-5 mb-4">
        <h4 class="mb-4">Pesanan</h4>
        <div class="row">
            @foreach($pesanan as $row)
            <div class="card mb-2">
                <div class="row g-0 w-100">
                    <div class="col-md-2">
                        <img id="gambar" src="storage/produk-images/{{ $row->gambar }}" class="img-fluid rounded-start rounded" style="margin: 10px;" alt="...">
                    </div>
                    <div class="col-md-10">
                        <div class="card-body">
                            <table border="0" class="w-100">
                                <tr>
                                    <td>
                                        <h3 class="card-title" id="namaProduk">{{ $row->nama_produk }} x {{ $row->qty }}</h3>
                                        <small>{{ $row->deskripsi }}</small>
                                        <h5 class="mt-4 text-warning">Rp{{ $row->total_harga }}</h5>
                                    </td>
                                    <td style="width: 170px;" class="text-center">
                                        @if($row->status == "Menunggu Pembayaran")
                                        <span class="badge bg-danger text-white p-2 mr-4">{{ $row->status }}</span>
                                        @elseif($row->status == "Sedang Diproses")
                                        <span class="badge bg-warning text-white p-2 mr-4">{{ $row->status }}</span>
                                        @else
                                        <span class="badge bg-success text-white p-2 mr-4">{{ $row->status }}</span>
                                        @endif
                                    </td>
                                    <td style="width: 170px;">
                                    @if($row->status == "Menunggu Pembayaran")
                                        <button type="button" class="btn btn-box text-light w-100 text-center btn-keranjang pay-button" data-token="{{ $row->snap_token }}" data-id="{{ $row->id }}"><b>Bayar Sekarang</b></button>
                                    @endif
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
<!-- end info section -->
@endsection

@push('script')
<script>
    $(document).ready(function() {
        // Add the 'highlight' class to the 'my-element' div
        $('#navpesanan').addClass('active');
        $('#navhome').removeClass('active');
        $('#navkeranjang').removeClass('active');
        $('#navproduk').removeClass('active');
        
        // Click handler for payment button
        $('.pay-button').click(function() {
            var token = $(this).data('token');
            var id = $(this).data('id');
            snap.pay(token, {
                onSuccess: function(result) {
                    // Handle success
                    document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);

                    if (result.status_code == 200) {
                        window.location.href = '/update-transaction-status/' + id;
                    }
                },
                onPending: function(result) {
                    // Handle pending
                    document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                },
                onError: function(result) {
                    // Handle error
                    document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                }
            });
        });
    });
</script>
@endpush
