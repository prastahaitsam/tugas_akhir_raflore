@extends('templates/user/header')

@section('content')
<!-- end hero area -->

<!-- info section -->
<section class="shop_section">
    <div class="container mt-5">
        <h4 class="mb-4">Keranjang</h4>
        <div class="row">
            <div style="width: 75%;">
                @foreach($products as $row)
                <div class="card mb-2">
                    <div class="form-check ml-2 mt-2">
                        <input class="form-check-input product-checkbox" type="checkbox" id="checkbox{{ $row->id_produk }}" value="{{ $row->harga }}" aria-label="..." onchange="updateTotal()">
                        <label for="checkbox{{ $row->id_produk }}">Pilih</label>
                    </div>
                    <div class=" row g-0">
                        <div class="col-md-2">
                            <img id="gambar" src="storage/produk-images/{{ $row->gambar }}" class="img-fluid rounded-start rounded" style="margin: 10px;" alt="...">
                        </div>
                        <div class="col">
                            <div class="card-body">
                                <table border="0" class="w-100">
                                    <tr>
                                        <td class="w-50">
                                            <h3 class="card-title" id="namaProduk">{{ $row->nama_produk }}</h3>
                                            <small>{{ $row->deskripsi }}</small>
                                            <h5 class="mt-4 text-warning">Rp{{ $row->harga }}</h5>
                                        </td>
                                        <th class="w-25">
                                            <div class="input-group quantity-selector">
                                                <button type="button" class="btn btn-icon btn-light mr-2 text-light update-quantity-btn" style="background-color: #F7B935;" data-id="{{ $row->id_produk }}" data-step="-1">
                                                    <span class="visually-hidden"><b>-</b></span>
                                                </button>
                                                <input type="number" id="inputQuantitySelector{{ $row->id_produk }}" class="form-control rounded text-center product-quantity" aria-live="polite" name="quantity" title="quantity" value="{{ $row->qty }}" min="1" max="100" step="1" data-id="{{ $row->id_produk }}" aria-label="Quantity selector" onchange="updateTotal()">
                                                <button type="button" class="btn btn-icon btn-light ml-2 text-light update-quantity-btn" style="background-color: #F7B935;" data-id="{{ $row->id_produk }}" data-step="1">
                                                    <span class="visually-hidden"><b>+</b></span>
                                                </button>
                                            </div>
                                            <button type="button" class="btn btn-icon ml-2 text-light mt-4 float-right" data-toggle="modal" data-target="#hapusItem" data-idproduk="{{ $row->id_produk }}" data-namaproduk="{{ $row->nama_produk }}">
                                                <span class="visually-hidden text-danger"><i class="fa-regular fa-trash-can"></i></span>
                                            </button>
                                        </th>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div style="width: 22%;" class="ml-4">
                <div class="card mb-3">
                    <div class="row g-0">
                        <div class="col">
                            <div class="card-header">
                                <b>Ringkasan belanja</b>
                            </div>
                            <div class="card-body">
                                <div class="row ml-2 mr-2">
                                    <table border="0" class="w-100">
                                        <tr>
                                            <th>
                                                <small class="mt-5">Total :</small>
                                            </th>
                                            <th>
                                                <h4 id="totalPrice" class="float-right text-warning mt-2">Rp0</h4>
                                            </th>
                                        </tr>
                                    </table>
                                    <button type="button" href="" class="btn btn-box text-light w-100 text-center btn-keranjang mt-4" onclick="window.location.href = '/keranjang';"><b>Checkout</b></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    /* Remove arrows in Chrome, Safari, Edge, and Opera */
    input[type="number"]::-webkit-outer-spin-button,
    input[type="number"]::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }
</style>
<!-- end info section -->
@include('pages/user/keranjang/form')
@endsection
@push('script')
<script>
    $(document).ready(function() {
        // Add the 'highlight' class to the 'my-element' div
        $('#navwishlist').addClass('active');
        $('#navhome').removeClass('active');
    });

    $('#hapusItem').on('show.bs.modal', function(event) {

        var button = $(event.relatedTarget);
        var idproduk = button.data('idproduk');
        var namaproduk = button.data('namaproduk');
        var modal = $(this);
        modal.find('.modal-body #idProduk').val(idproduk);
        modal.find('.modal-body #dataHapus').text(namaproduk);
    });

    document.addEventListener('DOMContentLoaded', function() {
        const updateQuantityButtons = document.querySelectorAll('.update-quantity-btn');

        updateQuantityButtons.forEach(button => {
            button.addEventListener('click', function() {
                const productId = this.getAttribute('data-id');
                const step = parseInt(this.getAttribute('data-step'));
                const input = document.querySelector(`#inputQuantitySelector${productId}`);
                let newValue = parseInt(input.value) + step;
                if (newValue < 1) newValue = 1;
                input.value = newValue;
                updateTotal();
            });
        });
    });

    function updateTotal() {
        let total = 0;
        const checkboxes = document.querySelectorAll('.product-checkbox');
        checkboxes.forEach((checkbox, index) => {
            if (checkbox.checked) {
                const quantity = document.querySelectorAll('.product-quantity')[index].value;
                total += parseFloat(checkbox.value) * parseInt(quantity);
            }
        });
        document.getElementById('totalPrice').innerText = `Rp${total}`;
    }
</script>
@endpush