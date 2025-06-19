<div class="col-12 col-md-9">
    <div class="card">
        <div class="card-header justify-content-center">
            <h2 class="mb-0">{{ __('Thông tin dịch vụ') }}</h2>
        </div>
        <div class="row card-body">
            <!-- service_id -->
            <div class="col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Chọn dịch vụ') }}:</label>
                    <x-select name="service_id" class="select2-bs5-ajax" :data-url="route('search.select.service')"
                        id="service_id">
                        <x-select-option :option="$hotel_service->service->id" :value="$hotel_service->service->id"
								:title="$hotel_service->service->name.'/ '.$hotel_service->service->default_unit" />
                    </x-select>
                </div>
            </div>

            {{-- base_price --}}
            <div class="col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Giá gốc') }}:</label>
                    <x-input-price name="base_price" id="base_price" :value="$hotel_service->base_price"
                        :required="true" :placeholder="__('Giá gốc')" />
                </div>
            </div>
            {{-- promo_price --}}
            <div class="col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Giá giảm') }}:</label>
                    <x-input-price name="promo_price" id="promo_price" :value="$hotel_service->promo_price"
                        :placeholder="__('Giá giảm')" />
                </div>
            </div>

            <div class="col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Mô tả ngắn') }}:</label>
                    <textarea name="short_description"
                        class="ckeditor visually-hidden">{{ $hotel_service->short_description }}</textarea>
                </div>
            </div>
        </div>
    </div>
</div>