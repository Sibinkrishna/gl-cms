@extends('ecommerce::vendor.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0">Notification Settings</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <form method="POST" action="{{ route('vendor.settings.notifications.update') }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <h5 class="mb-3">Email Notifications</h5>
                            <div class="form-check form-switch mb-3">
                                <input class="form-check-input" type="checkbox" name="email_notifications" value="1"
                                       id="email_notifications" {{ old('email_notifications', $vendor->email_notifications) ? 'checked' : '' }}>
                                <label class="form-check-label" for="email_notifications">
                                    Receive email notifications
                                </label>
                            </div>
                        </div>

                        <div class="mb-4">
                            <h5 class="mb-3">SMS Notifications</h5>
                            <div class="form-check form-switch mb-3">
                                <input class="form-check-input" type="checkbox" name="sms_notifications" value="1"
                                       id="sms_notifications" {{ old('sms_notifications', $vendor->sms_notifications) ? 'checked' : '' }}>
                                <label class="form-check-label" for="sms_notifications">
                                    Receive SMS notifications
                                </label>
                            </div>
                        </div>

                        <div class="mb-4">
                            <h5 class="mb-3">Order Notifications</h5>
                            <div class="form-check form-switch mb-3">
                                <input class="form-check-input" type="checkbox" name="order_notifications" value="1"
                                       id="order_notifications" {{ old('order_notifications', $vendor->order_notifications) ? 'checked' : '' }}>
                                <label class="form-check-label" for="order_notifications">
                                    Notify when new orders are placed
                                </label>
                            </div>
                        </div>

                        <div class="mb-4">
                            <h5 class="mb-3">Inventory Notifications</h5>
                            <div class="form-check form-switch mb-3">
                                <input class="form-check-input" type="checkbox" name="inventory_notifications" value="1"
                                       id="inventory_notifications" {{ old('inventory_notifications', $vendor->inventory_notifications) ? 'checked' : '' }}>
                                <label class="form-check-label" for="inventory_notifications">
                                    Notify when inventory is low
                                </label>
                            </div>
                        </div>

                        <div class="mb-4">
                            <h5 class="mb-3">Payout Notifications</h5>
                            <div class="form-check form-switch mb-3">
                                <input class="form-check-input" type="checkbox" name="payout_notifications" value="1"
                                       id="payout_notifications" {{ old('payout_notifications', $vendor->payout_notifications) ? 'checked' : '' }}>
                                <label class="form-check-label" for="payout_notifications">
                                    Notify when payouts are processed
                                </label>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Save Notification Preferences</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
