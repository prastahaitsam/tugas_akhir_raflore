@extends('templates/user/header')

@section('content')
<!-- end hero area -->

<!-- info section -->
<section class="shop_section">
    <div class="container mt-5">
        <h4 class="mb-4">Pesanan</h4>
        <div class="row">
            <div style="width: 75%;">
                
            </div>
            <div style="width: 22%;" class="ml-4">
                <div class="card mb-3">
                    <div class="row g-0">
                        <div class="col">
                            <div class="card-header">
                                <b>Ringkasan belanja</b>
                            </div>
                            <div class="card-body">
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
    });
</script>
@endpush
