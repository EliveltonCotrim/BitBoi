<!-- Modal -->
<div class="modal fade" id="cancelarCompra{{ $compra->id }}" tabindex="-1" aria-labelledby="cancelarCompraLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('cancelar.compra', $compra->id) }}" method="get">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="cancelarCompraLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="overflow: hidden">
                    Cras mattis consectetur purus sit amet fermentum.
                    Cras justo odio, dapibus ac facilisis in, egestas eget quam. Morbi leo risus, porta ac consectetur
                    ac,
                    vestibulum at eros.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </form>
    </div>
</div>

