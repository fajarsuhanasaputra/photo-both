<div class="modal-success mr-1 mb-1 d-inline-block">
    <div class="modal fade" id="modalTambah" tabindex="-1" aria-labelledby="myModalLabel110" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header bg-success white">
                    <h5 class="modal-title" id="myModalLabel110"> Form Tambah Data </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{route('permission.store')}}">
                        {{ csrf_field()}}
                        <div class="form-group">
                            <label for="">Nama</label>
                            <input type="text" class="form-control" name="name" required>
                        </div>
                        <button type="submit" class="btn btn-sm btn-success">
                            <i class="material-icons">save</i> Simpan
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>