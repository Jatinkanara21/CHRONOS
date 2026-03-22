@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card bg-dark border-secondary">
                <div class="card-header border-secondary bg-transparent py-4">
                    <h4 class="text-gold mb-0 serif-font">Notification Preferences</h4>
                    <p class="text-muted small mb-0 mt-1">Configure how you receive alerts and updates</p>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('notifications.update') }}" method="POST">
                        @csrf

                        <div class="d-flex justify-content-between align-items-center mb-4 pb-3 border-bottom border-secondary border-opacity-25">
                            <div>
                                <h6 class="text-white mb-1">New Arrivals</h6>
                                <small class="text-muted d-block">Be the first to know when luxury timepieces are added to the collection</small>
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input bg-secondary border-0" type="checkbox" name="email_new_product" value="1" id="switchNewProduct" {{ $settings->email_new_product ? 'checked' : '' }}>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mb-4 pb-3 border-bottom border-secondary border-opacity-25">
                            <div>
                                <h6 class="text-white mb-1">Price Adjustments</h6>
                                <small class="text-muted d-block">Get emails if items in your wishlist have a price drop or offer</small>
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input bg-secondary border-0" type="checkbox" name="email_price_drop" value="1" id="switchPriceDrop" {{ $settings->email_price_drop ? 'checked' : '' }}>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mb-4pb-3">
                            <div>
                                <h6 class="text-white mb-1">Back in Stock</h6>
                                <small class="text-muted d-block">Receive email alerts when watches on your wishlist are replenished</small>
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input bg-secondary border-0" type="checkbox" name="email_back_in_stock" value="1" id="switchBackInStock" {{ $settings->email_back_in_stock ? 'checked' : '' }}>
                            </div>
                        </div>

                        <div class="mt-4 pt-3">
                            <button class="btn btn-gold w-100">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
