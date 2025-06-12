<div class="col-12 col-md-9">
    <div class="card">
        <div class="card-header justify-content-center">
            <h2 class="mb-0">{{ __('Thông tin Voucher') }}</h2>
        </div>
        <div class="row card-body">
            <!-- code -->
            <div class="col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Mã vouher') }}:</label>
                    <x-input type="text" name="code" :value="$voucher->code" :required="true"
                        placeholder="{{ __('Mã voucher') }}" />
                </div>
            </div>

            <!-- hotel -->
            <div class="col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Áp dụng cho Khách sạn') }}:</label>
                    <x-select name="hotel_id[]" class="select2-bs5-ajax" :data-url="route('admin.search.select.hotel')"
                        id="hotel_id" multiple>
                        @if (!empty($voucher->hotels) && $voucher->hotel_scope == \App\Enums\Voucher\VoucherHotelScope::SpecificHotels->value)
                            @foreach ($voucher->hotels as $hotel)
                                <x-select-option :option="$hotel->id" :value="$hotel->id"
                                    :title="$hotel->name . '|' . $hotel->email" />
                            @endforeach
                        @endif
                    </x-select>
                    <span class="text-danger">* Để trống nếu chọn tất cả</span>
                </div>
            </div>

            <!-- user -->
            <div class=" col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Người nhận') }}:</label>
                    <x-select name="user_id[]" class="select2-bs5-ajax" :data-url="route('search.select.user')"
                        id="user_id" multiple>
                        @if (!empty($voucher->users) && $voucher->customer_scope == \App\Enums\Voucher\VoucherCustomerScope::SpecificCustomers->value)
                            @foreach ($voucher->users as $user)
                                <x-select-option :option="$user->id" :value="$user->id"
                                    :title="$user->fullname . '|' . $user->phone .'|'.$user->email " />
                            @endforeach
                        @endif
                    </x-select>
                    <span class="text-danger">* Để trống nếu chọn tất cả</span>
                </div>
            </div>
            {{-- start_date --}}
            <div class="col-md-6 col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Ngày bắt đầu') }}:</label>
                    <x-input type="date" name="start_date" :value=" format_date($voucher->start_date , 'Y-m-d')" />
                </div>
            </div>
            {{-- end_date --}}
            <div class="col-md-6 col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Ngày kết thúc') }}:</label>
                    <x-input type="date" name="end_date" :value=" format_date($voucher->end_date,'Y-m-d')" />
                </div>
            </div>
            {{-- discount_type --}}
            <div class="col-md-6 col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Kiểu giảm giá') }}:</label>
                    <x-select name="discount_type" id="discount_type" >
                        <option value="0" {{ $voucher->discount_type->value == 0 ? 'selected' : '' }}> Số tiền cố định</option>
                        <option value="1" {{ $voucher->discount_type->value == 1 ? 'selected' : '' }}> Giảm giá theo phần trăm</option>
                    </x-select>
                </div>
            </div>
            {{-- discount_value --}}
            <div class="col-md-6 col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Giá trị giảm ') }}:</label>
                    <x-input-price name="discount_value_price" id="discount_value_price" :value="($voucher->discount_type->value == 0) ? $voucher->discount_value : 0"  :placeholder="__('Giá trị giảm')" />
                    <x-input style="display: none;" name="discount_value_percent" id="discount_value_percent" :value="($voucher->discount_type->value == 1) ? $voucher->discount_value: 0 " :placeholder="__('%')" />
                </div>
            </div>
            {{-- min_order_value --}}
            <div class="col-md-6 col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Hóa đơn tối thiểu') }}:</label>
                    <x-input-price name="min_order_value" id="min_order_value" :value="$voucher->min_order_value" :required="true" :placeholder="__('Hóa đơn tối thiểu')" />
                </div>
            </div>
            {{-- max_discount_value --}}
            <div class="col-md-6 col-12" id="max_discount_value_group" style="display: none;">
                <div class="mb-3">
                    <label class="control-label">{{ __('Giảm giá tối đa') }}:</label>
                    <x-input-price name="max_discount_value" id="max_discount_value" :value="$voucher->max_discount_value" :required="true" :placeholder="__('Giảm giá tối đa')" />
                </div>
            </div>

        </div>
    </div>
</div>