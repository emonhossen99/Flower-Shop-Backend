
  <!-- Modal -->
  <div class="modal fade" id="fraudCheckerModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="fraudCheckerModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="fraudCheckerModalLabel">{{ __f('Courier Information Title') }}</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" id="fraudcheckerorder">
            <div class="row">
                <div class="col-md-6" id="responsedataadd">

                </div>
                <div class="col-md-6 d-none" id="responchartrander">
                    <div class="card">
                        <div class="card-title px-3 py-3 bg-info text-white fw-bold"> {{ __f('Courier Chart Title') }}</div>
                        <div class="card-body d-flex">
                            <div>
                                <button id="total_parcel_btn">{{  __f('Total Parcel Title') }} : <span id="total_parcel"></span></button>
                                <br>
                                <button id="success_parcel_btn">{{  __f('Success Parcel Title') }} : <span id="success_parcel"></span></button>
                                <br>
                                <button id="cancel_parcel_btn">{{  __f('Cancel Parcel Title') }}  : <span id="cancel_parcel"></span></button>
                            </div>
                            <div id="success-rate-chats"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
      </div>
    </div>
  </div>
