<div class="col-12 col-md-9">
    <div class="card">
        <div class="card-header justify-content-center">
            <h2 class="mb-0">{{ __('Thông tin Combo') }}</h2>
        </div>
        <div class="row card-body">
            <!-- hotel_service_id -->
            <div class="col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Chọn dịch vụ') }}:</label>
                    <x-select name="hotel_service_id" class="select2-bs5-ajax" :data-url="route('hotel.search.select.hotel_service',Auth()->user()->id)"
                        id="hotel_service_id">
                    </x-select>
                </div>
            </div>

            {{-- quantity --}}
            <div class="col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Số lượng') }}:</label>
                    <x-input type="number" name="quantity" id="quantity" min="1" step="1" :value="old('quantity')"
                        :required="true" :placeholder="__('Số lượng')" />
                </div>
            </div>

        </div>
    </div>
</div>

