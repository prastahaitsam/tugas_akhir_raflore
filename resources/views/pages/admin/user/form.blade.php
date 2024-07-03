<div id="formUser" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Modal Title</h5>
            </div>
            <div class="modal-body">
                <form action="/data-user" method="post" enctype="multipart/form-data">
                    @csrf
                    <div id="method"></div>
                    <div class="form-group">
                        <label class="floating-label" for="nama-customer">Nama User</label>
                        <input type="text" class="form-control" name="name" id="nama-user" placeholder="Masukkan nama user" value="">
                    </div>
                    <div class="form-group mt-2">
                        <label class="floating-label" for="email">Email</label>
                        <input type="email" class="form-control" name="email" id="email" placeholder="Masukkan email" value="">
                    </div>
                    <div class="form-group mt-2">
                        <label class="floating-label" for="password">Password</label>
                        <input type="password" name="password" class="form-control" id="password" placeholder="Masukan password" value="">
                    </div>
                    <div class="form-group mt-2">
                        <label for="level">Level</label>
                        <select id="level" class="form-control" name="level">
                            <option value="admin">Admin</option>
                            <option value="produksi">Produksi</option>
                            <option value="owner">Owner</option>
                        </select>
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

<div id="deleteUser" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Modal Title</h5>
            </div>
            <div class="modal-body">
                <form action="/data-user" method="post">
                    @csrf
                    {{ method_field('delete') }}
                    <input type="hidden" name="id_hapus" id="idHapus">
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
