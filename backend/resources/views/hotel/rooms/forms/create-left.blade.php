<div class="col-12 col-md-9">
    <div class="card">
        <div class="card-header justify-content-center">
            <h2 class="mb-0">{{ __('Thông tin phòng') }}</h2>
        </div>
        <div class="row card-body">
            <!-- name -->
            <div class="col-md-6 col-12">
                <div class="mb-3">
                    <label
                        class="control-label">{{ 'Tên phòng = ' . $room_type_variant->roomType->room_code . __(' + Mã phòng ( Ví dụ: ') . $room_type_variant->roomType->room_code . '-1 )' }}:</label>
                    <x-input type="text" name="code" :value="old('code')" :required="true"
                        placeholder="{{ __(' Mã phòng') }}" />
                </div>
            </div>
        </div>
    </div>
</div>