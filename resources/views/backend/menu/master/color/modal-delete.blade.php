<div class="modal fade text-center" id="modalDelete{{ $row->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel120" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger white">
                <h5 class="modal-title" id="myModalLabel120">Form Hapus Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Apakah Anda Yakin Menghapus Data ini ?
            </div>

            <div class="modal-footer">
                <form action="{{ route('color.destroy', $row->id) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">
                        <i class="material-icons">delete</i> Hapus Data {{ $row->name }}</button>
                </form>
                &nbsp; &nbsp;
                <button type="button" class="btn btn-outline-dark btn-sm ml-9" data-dismiss="modal">
                    <i class="material-icons">undo</i> Batalkan
                </button>
            </div>
        </div>
    </div>
</div>
