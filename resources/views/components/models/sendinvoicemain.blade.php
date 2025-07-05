 <!-- Email Modal -->
 <div class="modal fade" id="emailModal" tabindex="-1" aria-labelledby="emailModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="emailModalLabel">Send Email</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="sendInvoiceMail" action="{{ route('admin.send.email') }}" method="POST">
                    @csrf
                    <input type="hidden" name="invoice_id" value="{{ $invoice->id }}">
                    <div class="mb-3">
                        <label for="email" class="form-label required">Customer Email : </label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Enter email">
                        <input type="text" class="form-control d-none" id="name" name="name" value="{{ $invoice->customer_name }}">
                        <span class="text-danger error-text email-error"></span>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary">
                            <div class="spinner-border text-light d-none" role="status">
                                <span class="sr-only">Loading...</span>
                            </div> Send Email
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>