<div class="col-12 col-md-9">
    <div class="card">
        <div class="card-header justify-content-center">
            <h2 class="mb-0">{{ __('Thông tin Combo') }}</h2>
        </div>
        <div class="row card-body">
            <!-- hotel_service_id -->
            <div class="col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Dịch vụ') }}:</label>
                    <x-select name="hotel_service_id" class="select2-bs5-ajax" id="hotel_service_id"
                        :value="$combo_service->hotel_service_id">
                        <x-select-option :option="$combo_service->hotel_service_id"
                            :value="$combo_service->hotel_service_id" :title="$combo_service->service->name . ' | Giá: ' . format_price($combo_service->hotelService->base_price) . '/' . $combo_service->service->default_unit" />
                    </x-select>
                </div>
            </div>

            {{-- quantity --}}
            <div class="col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Số lượng') }}:</label>
                    <x-input type="number" name="quantity" id="quantity" min="1" step="1" :value="$combo_service->quantity"
                        :required="true" :placeholder="__('Số lượng')" />
                </div>
            </div>

        </div>
    </div>
</div>