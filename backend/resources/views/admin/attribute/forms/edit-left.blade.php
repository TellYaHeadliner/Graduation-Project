<div class="col-12 col-md-9">
    <div class="card">
        <div class="card-header justify-content-center">
            <h2 class="mb-0">{{ __('Thông tin thuộc tính') }}</h2>
        </div>
        <div class="row card-body">
            <!-- name -->
            <div class="col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Tên thuộc tính') }}:</label>
                    <x-input type="text" name="name" :value="$attribute->name" :required="true"
                        placeholder="{{ __('Tên thuộc tính') }}" />
                </div>
            </div>

            <div class="col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Kiểu dữ liệu') }}:</label>
                    <select name="type" class="form-select">
                        <option value="text" {{ old('type',$attribute->type ?? '') == 'text' ? 'selected' : '' }}>Text</option>
                        <option value="number" {{ old('type',$attribute->type ?? '') == 'number' ? 'selected' : '' }}>Number</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
</div>