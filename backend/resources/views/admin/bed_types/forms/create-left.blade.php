<div class="col-12 col-md-9">
    <div class="card">
        <div class="card-header justify-content-center">
            <h2 class="mb-0">{{ __('Thông tin loại giường') }}</h2>
        </div>
        <div class="row card-body">
			<!-- name -->
            <div class="col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Tên loại giường') }}:</label>
                    <x-input type="text" name="name" :value="old('name')" :required="true" placeholder="{{ __('Tên loại giường') }}" />
                </div>
            </div>

        </div>
    </div>
</div>