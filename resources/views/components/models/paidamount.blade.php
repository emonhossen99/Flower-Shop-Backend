<!-- Modal -->
  <div class="modal fade" id="PaidAmountModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="PaidAmountModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="PaidAmountModalLabel">{{ __f("Paid Amount Modal Title") }}</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form id="paidamountsubmit" action="{{ route('admin.due.amount.payment') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-body">
                <input type="hidden" name="user_id" id="paidamountuserid">
                <div class="row">
                    <x-form.textbox labelName="{{ __f('Paid Amount Label Title') }}" parantClass="col-12 col-md-12" required="required" name="paidamount"
                         placeholder="{{ __f('Paid Amount Placeholder') }}" errorName="paidamount" class="py-2" type="number">
                    </x-form.textbox>

                    <x-form.textbox labelName="{{ __f('Due Paid Date Label Title') }}" parantClass="col-12 col-md-12" required="required" name="paiddate"
                        placeholder="{{ __f('Due Paid Date Placeholder') }}" errorName="paiddate" class="py-2" type="date"
                        value="{{ now()->format('Y-m-d') }}">
                    </x-form.textbox>
                </div>
                {{-- <div class="row mt-3 px-3">
                    <div class="form-check ">
                        <input class="form-check-input" name="genarateinvoice" type="checkbox" value="1" id="genarateinvoice">
                        <label class="form-check-label" for="genarateinvoice">
                           {{  __f("Genarate Invoice Title")  }} 
                        </label>
                      </div>
                </div> --}}
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __f("Close Title") }}</button>
              <button type="submit" class="btn btn-primary">
                <div class="spinner-border text-light d-none spinner-border-paid" role="status">
                    <span class="sr-only">Loading...</span>
                </div>{{ __f("Pay Due Buttn Title") }}</button>
            </div>
        </form>
      </div>
    </div>
  </div>
