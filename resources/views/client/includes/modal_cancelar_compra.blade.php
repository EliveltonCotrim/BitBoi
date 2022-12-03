<!-- Modal -->
<div class="modal fade" id="cancelarCompra{{ $compra->id }}" tabindex="-1" aria-labelledby="cancelarCompraLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('cancelar.compra', $compra->id) }}" method="get">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="cancelarCompraLabel">Confirmar</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="overflow: hidden">
                    <p>Multa <strong> @money2($multa_cancelamento)</strong></p>
                </div>
                <div class="modal-footer">
                    {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> --}}
                    <button type="submit" class="btn btn-primary">Caneclar</button>
                </div>
            </div>
        </form>
    </div>
</div>
