<div id="formProduk" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Modal Title</h5>
            </div>
            <div class="modal-body">
                <form action="/data-produk" method="post" enctype="multipart/form-data">
                    @csrf
                    <div id="method"></div>
                    <input type="hidden" name="gambarLama" value="" id="gambarLama">
                    <div class="form-group">
                        <label class="floating-label" for="nama-produk">Nama Produk</label>
                        <input type="text" class="form-control" name="nama_produk" id="nama-produk" placeholder="" value="">
                    </div>
                    <div class="input-group mb-3">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="gambar" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01" onchange="displayFileName()">
                            <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                        </div>
                    </div>
                    <div class="form-group mt-2">
                        <label class="floating-label" for="harga">Harga</label>
                        <input type="number" name="harga" class="form-control" id="harga" placeholder="">
                    </div>
                    <div class="form-group">
                        <label class="floating-label" for="deskripsi">Deskripsi Produk</label>
                        <input type="text" class="form-control" name="deskripsi" id="deskripsi" placeholder="">
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn  btn-secondary" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn  btn-primary">Simpan</button>
            </div>
            </form>
        </div>
    </div>
</div>

<div id="deleteProduk" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Modal Title</h5>
            </div>
            <div class="modal-body">
                <form action="/data-produk" method="post">
                    @csrf
                    {{ method_field('delete') }}
                    <input type="hidden" name="id_hapus" id="idHapus">
                    <input type="hidden" name="gambarLama" value="" id="gambarLama">
                    Apakah anda ingin menghapus data <b id="dataHapus"></b> ?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn  btn-secondary" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn  btn-primary">Hapus</button>
            </div>
            </form>
        </div>
    </div>
</div>

@push('script')
<script>
    function displayFileName() {
        var input = document.getElementById('inputGroupFile01');
        var label = input.nextElementSibling;
        var fileName = input.files[0].name;
        label.innerHTML = fileName;
    }
</script>
@endpush