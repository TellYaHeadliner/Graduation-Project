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
                        class="control-label">{{ 'Tên phòng ' }}:</label>
                    <x-input type="text" name="code" :value="$room->code" :required="true"
                        placeholder="{{ __(' Mã phòng') }}" />
                </div>
            </div>
        </div>
    </div>
</div>