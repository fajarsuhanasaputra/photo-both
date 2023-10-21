<div class="modal-warning mr-1 mb-1 d-inline-block">
    <div class="modal fade" id="modalUpdate{{ $dt->id }}" tabindex="-1" aria-labelledby="myModalLabel140" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header bg-warning white">
                    <h5 class="modal-title" id="myModalLabel140"> Form Edit Data Voucher</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!--FORM UPDATE BARANG-->
                    <form method="post" action="{{route('voucher.update', $dt->id)}}">
                        {{ csrf_field()}}
                        {{ method_field('put')}}
                        <div class="form-group">
                            <label for="">Type</label>
                            <input type="text" class="form-control" disabled name="type" value="percent" placeholder="Percent">
                        </div>

                        <div class="form-group">
                            <label for="">Code</label>
                            <input type="text" class="form-control" required name="code" value="{{ $dt->code}}">
                        </div>

                        <div class="form-group">
                            <label for="">Value (%)</label>
                            <input type="number" class="form-control" required name="value" value="{{ $dt->value}}" placeholder="10%">
                        </div>

                        <div class="form-group">
                            <label for="">Start</label>
                            <input type="date" class="form-control" required name="start" value="{{ $dt->start}}">
                        </div>

                        <div class="form-group">
                            <label for="">Expired</label>
                            <input type="date" class="form-control" required name="expired" value="{{ $dt->expired}}">
                        </div>

                        <button type="submit" class="btn btn-sm btn-success">
                            <i class="material-icons">save</i> Simpan
                        </button>
                    </form>
                    <!--END FORM UPDATE BARANG-->
                </div>
            </div>
        </div>
    </div>
</div>