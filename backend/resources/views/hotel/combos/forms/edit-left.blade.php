<div class="col-12 col-md-9">
    <div class="card">
        <div class="card-header justify-content-center">
            <h2 class="mb-0">{{ __('Thông tin Combo') }}</h2>
        </div>
        <div class="row card-body">
            {{-- name --}}
            <div class="col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Tên combo') }}:</label>
                    <x-input type="text" name="name" :value="$combo->name" :required="true" placeholder="{{ __('Tên combo') }}" />
                </div>
            </div>

            {{-- combo_price --}}
            <div class="col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Giá combo') }}:</label>
                    <x-input-price name="combo_price" id="combo_price" :value="$combo->combo_price"
                        :required="true" :placeholder="__('Giá combo')" />
                </div>
            </div>

            <div class="col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Mô tả ngắn') }}:</label>
                    <textarea name="short_description"
                        class="ckeditor visually-hidden">{{ $combo->short_description }}</textarea>
                </div>
            </div>
        </div>
    </div>
</div>