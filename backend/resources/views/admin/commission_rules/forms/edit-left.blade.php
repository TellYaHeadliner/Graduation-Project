<div class="col-12 col-md-9">
    <div class="card">
        <div class="card-header justify-content-center">
            <h2 class="mb-0">{{ __('Thông tin Quy tắc') }}</h2>
        </div>
        <div class="row card-body">
            {{-- min_amount --}}
            <div class="col-md-6 col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Hóa đơn tối thiểu ') }}:</label>
                    <x-input-price name="min_amount" id="min_amount" :value="$commission_rule->min_amount"  :placeholder="__('Hóa đơn tối thiểu')" />
                </div>
            </div>
            {{-- max_amount --}}
            <div class="col-md-6 col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Hóa đơn tối đa') }}:</label>
                    <x-input-price name="max_amount" id="max_amount" :value="$commission_rule->max_amount" :required="true" :placeholder="__('Hóa đơn tối đa')" />
                </div>
            </div>
            {{-- commission_percent --}}
            <div class="col-md-6 col-12" >
                <div class="mb-3">
                    <label class="control-label">{{ __('Phần trăm hoa hồng(%)') }}:</label>
                    <x-input type="number" min:0 name="commission_percent" id="commission_percent" :value="$commission_rule->commission_percent" :required="true" :placeholder="__('Phần trăm hoa hồng(%)')" />
                </div>
            </div>
            <!-- note -->
            <div class="col-md-6 col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Ghi chú') }}:</label>
                    <x-input type="text" name="note" :value="$commission_rule->note" 
                        placeholder="{{ __('Ghi chú') }}" />
                </div>
            </div>
        </div>
    </div>
</div>