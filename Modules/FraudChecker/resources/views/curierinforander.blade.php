<div class="card">
    <div class="card-title px-3 py-3 bg-info text-white fw-bold">কুরিয়ার হিস্টোরি</div>
    <div class="card-body">
        <table class="table table-bordered border-secondary">
            <thead>
                <tr>
                    <th>কুরিয়ার</th>
                    <th id="totalbg-color">মোট</th>
                    <th id="success-color">সফল</th>
                    <th id="cancel-color">বাতিল</th>
                </tr>
            </thead>
            <tbody>
                @if (!empty($response['courierData']))
                    @foreach ($response['courierData'] as $courier => $data)
                        <tr>
                            <th><img id="courier_backend_image"
                                    src="{{ asset('backend/assets/img/curierimage/' . $courier . '-logo.png') }}"
                                    alt="মোট"></th>
                            <td id="totalbg-color">{{ $data['total_parcel'] }}</td>
                            <td id="success-color">{{ $data['success_parcel'] }}</td>
                            <td id="cancel-color">{{ $data['cancelled_parcel'] }}</td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="4">No courier data available.</td>
                    </tr>
                @endif
            </tbody>
        </table>
        <div>
            @if (!empty($response['courierData']))
                <button type="button" id="success-rate-btn">{{ $response['courierData']['summary']['success_ratio'] }}
                   % সফল</button>
            @else
            @endif
        </div>
    </div>
</div>
