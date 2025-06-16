<div class="col-12 col-md-9">
    <div class="card mb-3">
        <div class="card-header justify-content-center">
            <h2 class="mb-0">{{ __('Quy tắc đặt chỗ') }}</h2>
        </div>
        <div class="row card-body">

            {{-- Thời gian nhận phòng --}}
            <div class="col-12">
                <div class="mb-3">
                    <label class="control-label"><i class="ti ti-clock"></i> {{ __('Thời gian nhận phòng') }}:</label>
                    <x-input type="time" name="check_in_time" :value="$hotel->check_in_time ?? null"
                        placeholder="{{ __('Thời gian nhận phòng') }}" />
                </div>
            </div>

            {{-- Thời gian trả phòng --}}
            <div class="col-12">
                <div class="mb-3">
                    <label class="control-label"><i class="ti ti-clock"></i> {{ __('Thời gian trả phòng') }}:</label>
                    <x-input type="time" name="check_out_time" :value="$hotel->check_out_time ?? null"
                        placeholder="{{ __('Thời gian trả phòng') }}" />
                </div>
            </div>

            {{-- Chính sách thú cưng --}}
            <div class="col-12">
                <div class="mb-3">
                    <label class="control-label"><i class="ti ti-paw"></i> {{ __('Chính sách mang thú cưng') }}</label>
                    <x-input-switch name="pet_policy" value="1" :label="__('Cho phép mang thú cưng')"
                        :checked="( isset($hotel->pet_policy) && $hotel->pet_policy->value == 1)" />
                </div>
            </div>

            {{-- Chính sách trẻ em --}}
            <div class="col-12 mb-3">
                <label class="control-label"><i class="ti ti-baby-carriage"></i>
                    {{ __('Chính sách hỗ trợ trẻ em') }}</label>
                <x-input-switch name="child_policy" id="child_policy" value="1" :label="__('Hỗ trợ trẻ em')"
                    :checked="( isset($hotel->child_policy) && $hotel->child_policy->value == 1)" />
            </div>

            {{-- Độ tuổi giới hạn trẻ em --}}
            <div class="col-12 mb-3" id="child_age_limit_box"
                style="{{ (isset($hotel->child_policy) && $hotel->child_policy->value == 1 ) ? '' : 'display:none;' }}">
                <label class="control-label"><i class="ti ti-user"></i> {{ __('Độ tuổi giới hạn trẻ em') }}:</label>
                <x-input type="number" name="child_age_limit" id="child_age_limit" :value="$hotel->child_age_limit ?? 0"
                    placeholder="{{ __('Độ tuổi tối đa') }}" />
            </div>

            {{-- Có giường phụ --}}
            <div class="col-12 mb-3">
                <label class="control-label"><i class="ti ti-bed"></i> {{ __('Có giường phụ không?') }}</label>
                <x-input-switch name="extra_bed_fee_check" id="extra_bed_fee_check" value="1" :label="__('Có giường phụ')" :checked="isset($hotel->extra_bed_fee) && $hotel->extra_bed_fee != -1 ? true : false" />
            </div>

            {{-- Phí giường phụ --}}
            <div class="col-12 mb-3" id="extra_bed_fee_box"
                style="{{ ( isset($hotel->extra_bed_fee) && $hotel->extra_bed_fee >= 0 ) ? '' : 'display:none;' }}">
                <label class="control-label"><i class="ti ti-currency-dollar"></i> {{ __('Phí giường phụ') }}:</label>
                <x-input-price name="extra_bed_fee" id="extra_bed_fee" :value="$hotel->extra_bed_fee ?? 0"
                    :placeholder="__('Phí giường phụ')" />
            </div>

        </div>
    </div>
</div>