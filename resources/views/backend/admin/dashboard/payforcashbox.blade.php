<style>
    #uppercash-header {
        padding: 30px 0px 0px 0px;
        text-align: center;
    }

    #uppercash-header h3 {
        color: #dc3545;
    }

    .main-div-uppercash {
        background: #F6F6F6;
        padding: 20px;
        border-radius: 4px;
        color: #4A4A4B;
    }

    .main-div-uppercash h5 {
        font-size: 15px;
    }

    .cash-title {
        font-size: 15px;
        margin-top: 14px;
        font-weight: 500;
    }

    .uppercash_footer_btn {
        text-align: end;
        padding: 0px 15px 15px 0px;
    }

    .uppercash_close_btn,
    .uppercash_submit_btn {
        background: transparent !important;
        border: none !important;
        color: #6f6f6f !important;
    }

    .uppercash_submit_btn.active {
        color: #dc3545 !important;
    }

    input[type="number"]::-webkit-inner-spin-button,
    input[type="number"]::-webkit-outer-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    input[type="number"] {
        -moz-appearance: textfield;
    }

    .form-control:focus {
        border-radius: 0px 4px 4px 0px !important;
        border-right: 1px solid #dc3545 !important;
        border-top: 1px solid #dc3545 !important;
        border-bottom: 1px solid #dc3545 !important;
    }

    .input-group:has(.form-control:focus) #basic-addon1 {
        border-left: 1px solid #dc3545 !important;
        border-top: 1px solid #dc3545 !important;
        border-bottom: 1px solid #dc3545 !important;
    }

    .input-group> :not(:first-child):not(.dropdown-menu):not(.valid-tooltip):not(.valid-feedback):not(.invalid-tooltip):not(.invalid-feedback) {
        border-left: none !important;
    }
</style>
<!-- Modal -->
<div class="modal fade" id="upperCashModals" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="upperCashModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div id="uppercash-header">
                <h1 class="modal-title fs-5" id="upperCashModalLabel">ক্যাশ ঘাটতি</h1>
                <h3 id="cash-due-amount"></h3>
            </div>
            <div class="modal-body">
                <div class="main-div-uppercash">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5>দিলাম</h5>
                        <h5 id="total-pay-amount-uppercash"></h5>
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <h5>বর্তমান ক্যাশ</h5>
                        <h5 id="avaiavle-amount-uppercash"></h5>
                    </div>
                </div>
                <div>
                    <h5 class="cash-title">ঘাটটি পূরণের জন্য ক্যাশ পাবার এন্ট্রি দিন।</h5>
                </div>
                <form id="upperCashModalForm" action="{{ route('admin.dashboard.pay.bill.store') }}"
                    method="POST">
                    @csrf
                    <div class="row mt-3">
                        <div class="col-6 col-md-6">
                            <div class="input-group mb-3">
                                <span class="input-group-text px-2 py-1" id="basic-addon1"><span class="fs-4"
                                        style="color: #666;">৳</span></span>
                                <input type="number" id="uppercash_sell" name="uppercash_sell"
                                    class="form-control px-0" placeholder="ক্যাশ বেচা" aria-describedby="basic-addon1"
                                    autocomplete="off">
                            </div>
                        </div>
                        <div class="col-6 col-md-6">
                            <div class="input-group mb-3">
                                <span class="input-group-text px-2 py-1" id="basic-addon1"><span class="fs-4"
                                        style="color: #666;">৳</span></span>
                                <input type="number" id="uppercash_owner_give" name="uppercash_owner_give"
                                    class="form-control px-0" placeholder="মালিক দিল" aria-describedby="basic-addon1"
                                    autocomplete="off">
                            </div>
                        </div>
                    </div>

                    <div class="uppercash_footer_btn">
                        <button type="button" class="btn btn-secondary uppercash_close_btn"
                            data-bs-dismiss="modal">বাতিল</button>
                        <button type="submit" class="btn btn-primary uppercash_submit_btn" disabled>
                          <div class="spinner-border text-danger me-2 d-none spinner-border-uppercash" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>নিশ্চিত</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
