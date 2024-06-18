@extends('templates/user/header')

@section('content')

<!-- shop section -->
<section class="shop_section">
    <div class="container mt-5">
        <div class="row">
            <div style="width: 75%;">
                <div class="card mb-3">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img style="margin: 1rem" id="gambar" src="" class="img-fluid rounded-start rounded" alt="...">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <table border="0" class="w-100">
                                    <tr>
                                        <td class="w-75">
                                            <h3 class="card-title" id="namaProduk">Card title</h3>
                                            <small>Terjual :</small>
                                            <h3 class="float-right text-warning mt-3"><span id="harga"></span></h3>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p class="card-text" id="deskripsi"></p>
                                            <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div style="width: 22%;" class="ml-4">
                <div class="card mb-3">
                    <div class="row g-0">
                        <div class="col">
                            <div class="card-header">
                                <b>Atur jumlah</b>
                            </div>
                            <div class="card-body">
                                <form action="keranjang" method="post">
                                    @csrf
                                    <div class="row">
                                        <div class="col mt-4">
                                            <div class="input-group quantity-selector">
                                                <button type="button" class="btn btn-icon btn-light mr-2 text-light" style="background-color: #F7B935;" aria-describedby="inputQuantitySelector" data-bs-step="down">
                                                    <span class="visually-hidden"><b>-</b></span>
                                                </button>
                                                <input type="number" id="inputQuantitySelector" name="qty" class="form-control rounded text-center" aria-live="polite" data-bs-step="counter" name="quantity" title="quantity" value="1" min="1" max="100" step="1" data-bs-round="0" aria-label="Quantity selector">
                                                <button type="button" class="btn btn-icon btn-light ml-2 text-light" style="background-color: #F7B935;" aria-describedby="inputQuantitySelector" data-bs-step="up">
                                                    <span class="visually-hidden"><b>+</b></span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-5 ml-1 mr-1">
                                        <table border="0" class="w-100">
                                            <tr>
                                                <th>
                                                    <small class="mt-5">Subtotal :</small>
                                                </th>
                                                <th>
                                                    <h4 id="subtotal" class="float-right text-warning mt-2"></h4>
                                                </th>
                                            </tr>
                                        </table>
                                        @if ( Str::length(Auth::guard('customer')->user()) > 0 )
                                        <input type="hidden" name="id_customer" value="{{ Auth::guard('customer')->user()->id }}">
                                        @else
                                        <input type="hidden" name="id_customer" value="">
                                        @endif
                                        <input id="idProduk" type="hidden" name="id_produk">
                                        <input id="subTotal" type="hidden" name="sub_total">
                                        <!-- <input id="qty" type="number" name="qty" value="1"> -->
                                        <div class="btn-box w-100">
                                            <button type="submit" href="" class="btn text-light w-100 text-center btn-keranjang"><b>+ Keranjang</b></button>
                                            <button type="button" href="" class="btn w-100 text-center mt-2 btn-beli"><b>Beli Langsung</b></button>
                                        </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <div class="btn-box">
        <a href="">
            View All Products
        </a>
    </div>
    </div>
</section>

<!-- end shop section -->
<style>
    /* Remove arrows in Chrome, Safari, Edge, and Opera */
    input[type="number"]::-webkit-outer-spin-button,
    input[type="number"]::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }
</style>
@push('script')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        var idProduk = localStorage.getItem('idProduk');
        var gambar = localStorage.getItem('gambar');
        var namaProduk = localStorage.getItem('namaproduk');
        var deskripsi = localStorage.getItem('deskripsi');
        var harga = localStorage.getItem('harga');

        $('#gambar').attr('src', 'storage/produk-images/' + gambar);
        $('#namaProduk').text(namaProduk);
        $('#deskripsi').text(deskripsi);
        $('#harga').text('Rp.' + harga);
        $('#idProduk').val(idProduk);

        localStorage.removeItem('dataToSend');
    });

    document.addEventListener('DOMContentLoaded', function() {
        var harga = localStorage.getItem('harga');

        const inputQuantitySelector = document.getElementById('inputQuantitySelector');
        const btnDecrease = document.querySelector('button[data-bs-step="down"]');
        const btnIncrease = document.querySelector('button[data-bs-step="up"]');
        const subtotalElement = document.getElementById('subtotal');
        const unitPrice = harga;

        // Function to update the quantity and subtotal
        function updateQuantity(step) {
            let currentValue = parseInt(inputQuantitySelector.value);
            let newValue = currentValue + step;

            if (newValue >= parseInt(inputQuantitySelector.min) && newValue <= parseInt(inputQuantitySelector.max)) {
                inputQuantitySelector.value = newValue;
                updateSubtotal(newValue);
            }
        }

        // Function to update the subtotal
        function updateSubtotal(quantity) {
            let subtotal = unitPrice * quantity;
            subtotalElement.textContent = 'Rp.' + subtotal;
            $('#subTotal').val(subtotal);
        }

        // Event listeners for buttons
        btnDecrease.addEventListener('click', function() {
            updateQuantity(-parseInt(inputQuantitySelector.step));
        });

        btnIncrease.addEventListener('click', function() {
            updateQuantity(parseInt(inputQuantitySelector.step));
        });

        // Initialize subtotal on page load
        updateSubtotal(parseInt(inputQuantitySelector.value));
    });
</script>
@endpush
@endsection