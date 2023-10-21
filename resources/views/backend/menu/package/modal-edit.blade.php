<div class="modal-warning mr-1 mb-1 d-inline-block">
    <div class="modal fade" id="modalUpdate{{ $dt->id }}" tabindex="-1" aria-labelledby="myModalLabel140" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header bg-warning white">
                    <h5 class="modal-title" id="myModalLabel140"> Form Edit Package</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{route('package.update', $dt->id)}}">
                        {{ csrf_field()}}
                        {{ method_field('put')}}
                        <div class="form-group">
                            <label for="">PACKAGE NAME</label>
                            <input type="text" class="form-control" name="package_name" value="{{  $dt->package_name }}" required>
                        </div>

                        <div class="form-group">
                            <label for="">PRICE</label>
                            <input type="number" class="form-control" name="price" value="{{  $dt->price }}" required>
                        </div>

                        <div class="form-group">
                            <label for="">TOTAL</label>
                            <input type="number" class="form-control" name="total" value="{{  $dt->total }}" required>
                        </div>

                        <div class="form-group">
                            <label for="">DESCRIPTION</label>
                            <textarea class="form-control" name="description">{{ $dt->description }}</textarea>
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