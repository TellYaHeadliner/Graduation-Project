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
                    <x-input type="text" name="code" :value="old('code')" :required="true"
                        placeholder="{{ __('Mã voucher') }}" />
                </div>
            </div>

            <!-- hotel -->
            <div class="col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Áp dụng cho Khách sạn') }}:</label>
                    <x-select name="hotel_id[]" class="select2-bs5-ajax" :data-url="route('admin.search.select.hotel')"
                        id="hotel_id" multiple>
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
                    </x-select>
                    <span class="text-danger">* Để trống nếu chọn tất cả</span>
                </div>
            </div>
            {{-- start_date --}}
            <div class="col-md-6 col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Ngày bắt đầu') }}:</label>
                    <x-input type="date" name="start_date" :value="old('start_date')" />
                </div>
            </div>
            {{-- end_date --}}
            <div class="col-md-6 col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Ngày kết thúc') }}:</label>
                    <x-input type="date" name="end_date" :value="old('end_date')" />
                </div>
            </div>
            {{-- discount_type --}}
            <div class="col-md-6 col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Kiểu giảm giá') }}:</label>
                    <x-select name="discount_type" id="discount_type">
                        <option value="0"> Số tiền cố định</option>
                        <option value="1"> Giảm giá theo phần trăm</option>
                    </x-select>
                </div>
            </div>
            {{-- discount_value --}}
            <div class="col-md-6 col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Giá trị giảm ') }}:</label>
                    <x-input-price name="discount_value_price" id="discount_value_price" :value="old('discount_value_price',0)"  :placeholder="__('Giá trị giảm')" />
                    <x-input style="display: none;" name="discount_value_percent" id="discount_value_percent" :value="old('discount_value_percent',0)" :placeholder="__('%')" />
                </div>
            </div>
            {{-- min_order_value --}}
            <div class="col-md-6 col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Hóa đơn tối thiểu') }}:</label>
                    <x-input-price name="min_order_value" id="min_order_value" :value="old('min_order_value')" :required="true" :placeholder="__('Hóa đơn tối thiểu')" />
                </div>
            </div>
            {{-- max_discount_value --}}
            <div class="col-md-6 col-12" id="max_discount_value_group" style="display: none;">
                <div class="mb-3">
                    <label class="control-label">{{ __('Giảm giá tối đa') }}:</label>
                    <x-input-price name="max_discount_value" id="max_discount_value" :value="old('max_discount_value',0)" :required="true" :placeholder="__('Giảm giá tối đa')" />
                </div>
            </div>

        </div>
    </div>
</div>