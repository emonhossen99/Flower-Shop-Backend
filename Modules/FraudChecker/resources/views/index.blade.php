@extends('layouts.app')
@section('title', $title)
@section('content')
    <div class="row mt-3" id="fraudchecker">
        <div class="col-md-12">
            <div class="card px-3 py-3">
                <div class="bg-white border-bottom-0 pb-4 d-flex justify-content-between align-items-center flex-row">
                    <h2 class="backend-title">{{ $title }}</h2>
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-title px-3 py-3 bg-info text-white fw-bold">{{ __f('Courier Info Check Title') }}</div>
                            <div class="card-body">
                                <div class="card-text">{{ __f('Courier Info Warning Text') }} </div>
                                <form id="fraudCheckerFrom" action="{{ route('admin.fraud.check') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div>
                                        <div class="input-group my-3">
                                            <input type="text" class="form-control"
                                                placeholder="{{ __f('Courier Search Placeholder') }}" name="phone"
                                                aria-label="{{ __f('Courier Search Placeholder') }}" aria-describedby="basic-addon2">
                                            <span class="input-group-text p-0" id="basic-addon2">
                                                <button type="submit" id="fraudcheckbutton">
                                                    <div class="spinner-border text-light d-none fraudcheckbutton_spinner"
                                                        role="status">
                                                        <span class="sr-only">Loading...</span>
                                                    </div>{{ __f('Courier Info Submit Title') }}
                                                </button></span>
                                        </div>
                                        <span class="text-danger error-text phone-error"></span>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6" id="responsedataadd">

                        </div>
                        <div class="col-md-6 d-none" id="responchartrander">

                            <div class="card">
                                <div class="card-title px-3 py-3 bg-info text-white fw-bold">{{ __f('Courier Chart Title') }}</div>
                                <div class="card-body d-flex">
                                    <div>
                                        <button id="total_parcel_btn">{{  __f('Total Parcel Title') }} : <span id="total_parcel"></span></button>
                                        <br>
                                        <button id="success_parcel_btn">{{  __f('Success Parcel Title') }} : <span id="success_parcel"></span></button>
                                        <br>
                                        <button id="cancel_parcel_btn">{{  __f('Cancel Parcel Title') }} : <span id="cancel_parcel"></span></button>
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
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            $('#fraudCheckerFrom').on('submit', function(e) {
                e.preventDefault();
                $('.fraudcheckbutton_spinner').removeClass('d-none');
                $('.error-text').text('');
                let formData = new FormData(this);
                $.ajax({
                    url: $(this).attr('action'),
                    method: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(res) {
                        if (res.status == 'success') {
                            $('.fraudcheckbutton_spinner').addClass('d-none');
                            $('#responsedataadd').html('');
                            $('#responsedataadd').html(res.data);
                            $('#responchartrander').removeClass('d-none');
                            $('#total_parcel').html(res.rowdata.courierData['summary']
                                .total_parcel);
                            $('#success_parcel').html(res.rowdata.courierData['summary']
                                .success_parcel);
                            $('#cancel_parcel').html(res.rowdata.courierData['summary']
                                .cancelled_parcel);

                            var successRate = res.rowdata.courierData['summary'].success_ratio;
                            var cancelRate = 100 - res.rowdata.courierData['summary']
                                .success_ratio;
                            var convertCancelRate = parseFloat(cancelRate.toFixed(2));

                            if (typeof successRateChart !== "undefined") {
                                successRateChart.updateSeries([successRate, convertCancelRate]);
                            } else {
                                var options = {
                                    series: [successRate, convertCancelRate],
                                    chart: {
                                        width: '450',
                                        height: '450',
                                        type: 'pie',
                                    },
                                    labels: ['{{ __f("Success Title") }}', '{{ __f("Cancel Title") }}'],
                                    colors: ['#28a745', '#dc3545'],
                                    dataLabels: {
                                        enabled: false,
                                    },
                                    plotOptions: {
                                        pie: {
                                            expandOnClick: true,
                                            donut: {
                                                labels: {
                                                    show: false
                                                }
                                            }
                                        }
                                    },
                                    grid: {
                                        padding: {
                                            top: 0,
                                            bottom: 0,
                                            left: 0,
                                            right: 0,
                                        },
                                    },
                                };
                                successRateChart = new ApexCharts(document.querySelector(
                                    "#success-rate-chats"), options);
                                successRateChart.render();
                            }
                        }
                    },
                    error: function(xhr) {
                        if (xhr.status === 422) {
                            $('.fraudcheckbutton_spinner').addClass('d-none');
                            let errors = xhr.responseJSON.errors;
                            $.each(errors, function(key, value) {
                                $('.' + key + '-error').text(value[0]);
                            });
                        } else {
                            $('.fraudcheckbutton_spinner').addClass('d-none');
                            console.log('Something went wrong. Please try again.');
                        }
                    }
                });
            });
        });
    </script>
@endpush
