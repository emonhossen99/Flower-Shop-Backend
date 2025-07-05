
  <!-- Modal -->
  <div class="modal fade" id="statusChangeModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="statusChangeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="statusChangeModalLabel">{{ __f('Order Status Change Modal Title') }}</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="form-group">
                <label for="selectorderstatus" class="required">{{ __f('Order Status Title') }}</label><br>
                <select name="selectorderstatus" id="selectorderstatus" class="form-select">
                    <option value="1">{{ __f('Pending Title') }}</option>
                    <option value="2">{{ __f('Processing Title') }}</option>
                    <option value="3">{{ __f('On The Way Title') }}</option>
                    <option value="4">{{ __f('On Hold Title') }}</option>
                    <option value="5">{{ __f('Complate Title') }}</option>
                    <option value="6">{{ __f('Cancel Title') }}</option>
                </select>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __f('Close Title') }}</button>
          <button type="button" id="bluk-change-status-submit" class="btn btn-primary d-flex align-items-center">
            <div class="spinner-border text-light bluk-change-status-submit-loader d-none" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>{{ __f('Change Status Title') }}
            </button>
        </div>
      </div>
    </div>
  </div>
