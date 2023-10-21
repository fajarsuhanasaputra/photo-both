<div class="modal-success mr-1 mb-1 d-inline-block">
    <div class="modal fade" id="modalTambah" tabindex="-1" aria-labelledby="myModalLabel110" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header bg-success white">
                    <h5 class="modal-title" id="myModalLabel110"> Form Tambah Voucher </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{route('voucher.store')}}">
                        {{ csrf_field()}}
                        <div class="form-group">
                            <label for="">Type</label>
                            <input disabled type="text" name="type" class="form-control" required placeholder="Percent">
                        </div>

                        <div class="form-group">
                            <label for="">Code</label>
                            <input type="text" class="form-control" name="code" required>
                        </div>

                        <div class="form-group">
                            <label for="">Value (%)</label>
                            <input type="number" class="form-control" name="value" placeholder="10%" required>
                        </div>

                        <div class="form-group">
                            <label for="">Start</label>
                            <input type="date" class="form-control" name="start" required>
                        </div>

                        <div class="form-group">
                            <label for="">Expired</label>
                            <input type="date" class="form-control" name="expired" required>
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