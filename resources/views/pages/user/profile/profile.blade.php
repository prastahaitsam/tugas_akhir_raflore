@extends('templates/user/header')

@push('style')
<style>
    .list-group-item {
        border: none;
    }
</style>
@endpush

@section('content')
<!-- end hero area -->

<!-- info section -->
<section class="shop_section">
    <div class="container mt-5 mb-4">
        <h4 class="mb-4">Profile | {{ Auth::guard('customer')->user()->name }}</h4>
        <div class="row">
            <div class="card w-100">
                <div class="card-header">
                    <ul class="nav nav-tabs card-header-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active text-dark" id="biodata-tab" data-bs-toggle="tab" href="#biodata" role="tab" aria-controls="biodata" aria-selected="true">Biodata Diri</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-dark" id="contact-tab" data-bs-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Kontak</a>
                        </li>
                    </ul>
                </div>
                <div class="card-body tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="biodata" role="tabpanel" aria-labelledby="biodata-tab">
                        <div class="container">
                            <div class="row justify-content-start">
                                <div class="col-4">
                                    <img src="assets/user/images/user-icon-2.png" class="img-thumbnail" alt="user-icon">
                                </div>
                                <div class="col-8">
                                    <b>Biodata Diri</b>
                                    <table class="mt-4 w-100" style="border-collapse: separate; border-spacing: 0 15px;">
                                        <tr>
                                            <td class="w-25">Nama</td>
                                            <td style="width: 20px;">:</td>
                                            <td>{{ $customer->name }}</td>
                                        </tr>
                                        <tr>
                                            <td class="w-25">Tanggal Lahir</td>
                                            <td style="width: 20px;">:</td>
                                            <td>{{ $customer->tanggal_lahir }}</td>
                                        </tr>
                                        <tr>
                                            <td class="w-25">Jenis Kelamin</td>
                                            <td style="width: 20px;">:</td>
                                            <td>{{ $customer->jenis_kelamin }}</td>
                                        </tr>
                                        <tr>
                                            <td class="w-25">Alamat</td>
                                            <td style="width: 20px;">:</td>
                                            <td>{{ $customer->alamat }}</td>
                                        </tr>
                                        <tr>
                                            <td class="w-25">
                                            <button type="submit" href="" class="btn btn-box text-light text-center btn-keranjang mt-4"><b>Edit Biodata Diri</b></button>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                        <div class="container">
                            <div class="row justify-content-start">
                                <div class="col-4">
                                    <img src="assets/user/images/user-icon-2.png" class="img-thumbnail" alt="user-icon">
                                </div>
                                <div class="col-8">
                                    <b>Kontak</b>
                                    <table class="mt-4 w-100" style="border-collapse: separate; border-spacing: 0 15px;">
                                        <tr>
                                            <td class="w-25">Nomor HP</td>
                                            <td style="width: 20px;">:</td>
                                            <td>{{ $customer->nomor_hp }}</td>
                                        </tr>
                                        <tr>
                                            <td class="w-25">Email</td>
                                            <td style="width: 20px;">:</td>
                                            <td>{{ $customer->email }}</td>
                                        </tr>
                                        <tr>
                                            <td class="w-25">
                                            <button type="submit" href="" class="btn btn-box text-light text-center btn-keranjang mt-4"><b>Edit Kontak</b></button>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
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
    $('#myTab a').on('click', function(e) {
        e.preventDefault();
        $(this).tab('show');
    });
</script>
@endpush
