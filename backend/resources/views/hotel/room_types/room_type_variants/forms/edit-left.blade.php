<div class="col-12 col-md-9">
    <div class="card mb-3">
        <div class="card-header justify-content-center">
            <h2 class="mb-0">{{ __('Thông tin cơ bản') }}</h2>
        </div>
        <div class="row card-body">
            {{-- base_price --}}
            <div class="col-md-6 col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Giá gốc') }}:</label>
                    <x-input-price name="base_price" id="base_price" :value="$room_type_variant->base_price ?? old('base_price')"
                        :required="true" :placeholder="__('Giá gốc')" />
                </div>
            </div>
            {{-- discount_price --}}
            <div class="col-md-6 col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Giá giảm') }}:</label>
                    <x-input-price name="discount_price" id="discount_price" :value="$room_type_variant->discount_price ?? old('discount_price')"
                        :required="true" :placeholder="__('Giá giảm')" />
                </div>
            </div>           
        </div>
    </div>
    <div class="card mb-3">
        <div class="card-header justify-content-center">
            <h2 class="mb-0">{{ __('Ưu đãi sự kiện') }}</h2>
        </div>
        <div class="row card-body">
            <!-- season_id -->
            <div class="col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Sự kiện') }}:</label>
                    <x-select name="season_id" class="select2-bs5-ajax" :data-url="route('search.select.season')"
                        id="season_id">
                        @if(isset($room_type_variant->seasons[0]) && $room_type_variant->seasons[0]->id)
                            <x-select-option :option="$room_type_variant->seasons[0]->id" :value="$room_type_variant->seasons[0]->id"
                                :title="$room_type_variant->seasons[0]->name . '( ' . format_date($room_type_variant->seasons[0]->start_date,'d-m-Y') . ' - ' . format_date($room_type_variant->seasons[0]->end_date,'d-m-Y').' )' " />
                        @endif
                    </x-select>
                </div>
            </div>   
            <div class="col-md-6 col-12" id="discount_type_group">
                <div class="mb-3">
                    <label class="control-label">{{ __('Loại phí') }}:</label>
                    <x-select name="discount_type" id="discount_type_select">
                        <option value="0" {{ ( isset($room_type_variant->seasons[0]) && $room_type_variant->seasons[0]->pivot['discount_type'] == 0 ) ? 'selected' : '' }}>Số tiền cố định</option>
                        <option value="1" {{ ( isset($room_type_variant->seasons[0]) && $room_type_variant->seasons[0]->pivot['discount_type'] == 1 ) ? 'selected' : '' }}>Giảm giá theo phần trăm</option>
                    </x-select>
                </div>
            </div>

            <div class="col-md-6 col-12" id="discount_value_group">
                <div class="mb-3">
                    <label class="control-label">{{ __('Giá trị giảm') }}:</label>

                    <div id="discount_price_group">
                        <x-input-price name="discount_value_price" id="discount_value_price"
                            :value="( isset($room_type_variant->seasons[0]) && $room_type_variant->seasons[0]->pivot['discount_type'] == 0 ) ? $room_type_variant->seasons[0]->pivot['discount_value'] : old('discount_value_price')" :placeholder="__('Số tiền')" />
                    </div>

                    <div id="discount_percent_group" style="display: none;">
                        <x-input name="discount_value_percent" id="discount_value_percent"
                            :value="( isset($room_type_variant->seasons[0]) && $room_type_variant->seasons[0]->pivot['discount_type'] == 1 ) ? $room_type_variant->seasons[0]->pivot['discount_value'] : old('discount_value_percent')" :placeholder="__('%')" />
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card mb-3">
        <div class="card-header justify-content-center">
            <h2 class="mb-0">{{ __('Thông tin thuộc tính') }}</h2>
        </div>
        <div class="row card-body">
                <div class="col-md-6 col-12">
                    <div class="mb-3">
                        <label class="control-label">{{ __('Người lớn') }}:</label>
                        <x-input type="number" name="attribute[guest]" id="attribute['guest']" min="1" step="1"
                        :value="optional($attributes['guest'] ?? null)['pivot']['attribute_value'] ?? 1"
                        :placeholder="__('Người lớn')" />
                    </div>
                </div>
                {{-- children --}}
                <div class="col-md-6 col-12">
                    <div class="mb-3">
                    <label class="control-label">{{ __('Trẻ em') }}:</label>
                    <x-input type="number"
                            name="attribute[children]"
                            id="attribute['children']"
                            min="1"
                            step="1"
                            :value="optional($attributes['children'] ?? null)['pivot']['attribute_value'] ?? 0"
                            :placeholder="__('Trẻ em')" />
                    </div>
                </div>
                {{-- meal --}}
                <div class="col-12">
                    <div class="mb-3">
                        <label class="control-label">{{ __('Bao gồm bữa sáng') }}?</label>
                        <x-input-checkbox name="attribute[meal]" :value="1" :label="__('Có bao gồm bữa sáng không?')"
                        :checked="(optional($attributes['meal'] ?? null)['pivot']['attribute_value'] ?? 0) == 1 ? ['1'] : []" />
                    </div>
                </div>
                {{-- smoking --}}
                <div class="col-12">
                    <div class="mb-3">
                        <label class="control-label">{{ __('Không hút thuốc') }}?</label>
                        <x-input-checkbox name="attribute[smoking]" :value="1" :label="__('Không hút thuốc ?')"
                        :checked="(optional($attributes['smoking'] ?? null)['pivot']['attribute_value'] ?? 0) == 1 ? ['1'] : []" />
                    </div>
                </div>
            {{-- Chính sách hủy --}}
                <div class="col-12">
                    <div class="mb-3">
                        <label class="control-label">{{ __('Chính sách hủy') }}:</label>
                        <select name="attribute[cancel]" class="form-select" id="cancel_policy_select">
                            <option value="free_before and fee_after" {{ isset($attributes['free_before and fee_after']) ? 'selected' : '' }}>Miễn phí hủy trước 24h và thu phí sau đó</option>
                            <option value="no_refund" {{ isset($attributes['no_refund']) ? 'selected' : '' }}>Không hoàn tiền</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6 col-12" id="fee_type_group">
                    <div class="mb-3">
                        <label class="control-label">{{ __('Loại phí') }}:</label>
                        <x-select name="fee_type" id="fee_type_select">
                            <option value="0" {{ (!empty($room_type_variant->fee_type) && $room_type_variant->fee_type) == 0 ? 'selected' : '' }}>Số tiền cố định</option>
                            <option value="1" {{ (!empty($room_type_variant->fee_type) && $room_type_variant->fee_type) == 1 ? 'selected' : '' }}>Giảm giá theo phần trăm</option>
                        </x-select>
                    </div>
                </div>
                <div class="col-md-6 col-12" id="fee_amount_group">
                    <div class="mb-3">
                        <label class="control-label">{{ __('Mức phí huỷ') }}:</label>
                        @if(isset($attributes['free_before and fee_after']))
                            <x-input-price name="fee_amount_price" id="fee_amount_price" :value="$room_type_variant->fee_type == 0 ? $attributes['free_before and fee_after']['pivot']['attribute_value'] : old('fee_amount_price')" :placeholder="__('Mức phí huỷ')" />
                            <x-input style="display: none;" name="fee_amount_percent" id="fee_amount_percent" :value="$room_type_variant->fee_type == 1 ? $attributes['free_before and fee_after']['pivot']['attribute_value'] : old('fee_amount_percent')" :placeholder="__('%')" />
                        @else
                            <x-input-price name="fee_amount_price" id="fee_amount_price" :value="old('fee_amount')" :placeholder="__('Mức phí huỷ')" />
                            <x-input style="display: none;" name="fee_amount_percent" id="fee_amount_percent" :value="old('fee_amount_percent')" :placeholder="__('%')" />
                        @endif
                    </div>
                </div>
        </div>
    </div>
</div>