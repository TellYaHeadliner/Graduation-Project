<div class="col-12 col-md-9">
    <div class="card">
        <div class="card-header justify-content-center">
            <h2 class="mb-0">{{ __('Thông tin Mùa ưu đãi') }}</h2>
        </div>
        <div class="row card-body">
            <!-- name -->
            <div class="col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Tên Mùa ưu đãi') }}:</label>
                    <x-input type="text" name="name" :value="old('name')" :required="true"
                        placeholder="{{ __('Tên Mùa ưu đãi') }}" />
                </div>
            </div>

            <div class="col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Ngày bắt đầu') }}:</label>
                    <x-input type="date" name="start_date" :value="old('start_date')" />
                </div>
            </div>

            <div class="col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Ngày kết thúc') }}:</label>
                    <x-input type="date" name="end_date" :value="old('end_date')" />
                </div>
            </div>

            <div class="col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Mô tả') }}:</label>
                    <textarea name="description" class="ckeditor visually-hidden">{{ old('description') }}</textarea>
                </div>
            </div>
        </div>
    </div>
</div>