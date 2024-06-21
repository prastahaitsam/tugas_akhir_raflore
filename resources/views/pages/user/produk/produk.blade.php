@extends('templates/user/header')

@section('content')
</div>
<!-- end hero area -->

<!-- shop section -->
<section class="shop_section">
    <div class="container">
        <div class="row mb-4">
            @foreach($data as $row)
            <div class="col-sm-6 col-md-4 col-lg-3">
                <div class="box" style="border-radius: 3%;">
                    <a type="button" class="viewproduk" data-id="{{ $row->id_produk }}" data-gambar="{{ $row->gambar }}" data-namaproduk="{{ $row->nama_produk }}" data-harga="{{ $row->harga }}" data-deskripsi="{{ $row->deskripsi }}">
                        <div class="img-box">
                            <img src="storage/produk-images/{{ $row->gambar }}" alt="">
                        </div>
                        <div class="detail-box mt-4">
                            <h6>{{ $row->nama_produk }}</h6>
                            <h6>
                                <span>Rp.{{ $row->harga }}</span>
                            </h6>
                        </div>
                        <div class="detail-box">
                            <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                            <div class="float-right">
                                <i class="fa fa-star text-warning" aria-hidden="true"></i>
                                <i class="fa fa-star text-warning" aria-hidden="true"></i>
                                <i class="fa fa-star text-warning" aria-hidden="true"></i>
                                <i class="fa fa-star text-warning" aria-hidden="true"></i>
                                <i class="fa fa-star text-warning" aria-hidden="true"></i>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- end shop section -->

<!-- info section -->

<section class="info_section  layout_padding2-top">
    <div class="info_container ">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-lg-3">
                    <h6>
                        ABOUT US
                    </h6>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed doLorem ipsum dolor sit amet, consectetur adipiscing elit, sed doLorem ipsum dolor sit amet,
                    </p>
                </div>
                <div class="social_container col-md-6 col-lg-6">
                    <h6 class="d-flex justify-content-center">Follow Us</h6>
                    <div class="social_box mt-5">
                        <a href="">
                            <i class="fa fa-facebook" aria-hidden="true"></i>
                        </a>
                        <a href="">
                            <i class="fa fa-twitter" aria-hidden="true"></i>
                        </a>
                        <a href="">
                            <i class="fa fa-instagram" aria-hidden="true"></i>
                        </a>
                        <a href="">
                            <i class="fa fa-youtube" aria-hidden="true"></i>
                        </a>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <h6>
                        CONTACT US
                    </h6>
                    <div class="info_link-box">
                        <a href="">
                            <i class="fa fa-map-marker" aria-hidden="true"></i>
                            <span> Gb road 123 london Uk </span>
                        </a>
                        <a href="">
                            <i class="fa fa-phone" aria-hidden="true"></i>
                            <span>+01 12345678901</span>
                        </a>
                        <a href="">
                            <i class="fa fa-envelope" aria-hidden="true"></i>
                            <span> demo@gmail.com</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- footer section -->
    <footer class=" footer_section">
        <div class="container">
            <p>
                &copy; <span id="displayYear"></span> RAFLORE
            </p>
        </div>
    </footer>
    <!-- footer section -->

</section>

<!-- end info section -->

@endsection
@push('script')
<script>
    $(document).ready(function() {
        // Add the 'highlight' class to the 'my-element' div
        $('#navproduk').addClass('active');
        $('#navhome').removeClass('active');
        $('#navkeranjang').removeClass('active');
        $('#navpesanan').removeClass('active');

        $(document).on('click', '.viewproduk', function() {
            var button = $(this);
            var id = button.data('id');
            var gambar = button.data('gambar');
            var namaproduk = button.data('namaproduk');
            var harga = button.data('harga');
            var deskripsi = button.data('deskripsi');

            //console.log(namaproduk);
            localStorage.setItem('idProduk', id);
            localStorage.setItem('gambar', gambar);
            localStorage.setItem('namaproduk', namaproduk);
            localStorage.setItem('harga', harga);
            localStorage.setItem('deskripsi', deskripsi);

            window.location.href = '/viewproduk';
        });
    });
</script>
@endpush