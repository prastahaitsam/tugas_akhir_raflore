<div id="hapusItem" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Modal Title</h5>
            </div>
            <div class="modal-body">
                <form action="/keranjang" method="post">
                    @csrf
                    {{ method_field('delete') }}
                    <input type="hidden" name="id_produk" id="idProduk">
                    <h6>Apakah anda ingin menghapus item ini ?</h6>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn  btn-light btn-sm" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn  btn-warning btn-sm">Hapus</button>
            </div>
            </form>
        </div>
    </div>
</div>