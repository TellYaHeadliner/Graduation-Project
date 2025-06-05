<div class="col-12 col-md-9">
    <div class="card">
        <div class="card-header justify-content-center">
            <h2 class="mb-0">{{ __('Thông tin dịch vụ') }}</h2>
        </div>
        <div class="row card-body">
			<!-- name -->
            <div class="col-12">
                <div class="mb-3">
                    <label class="control-label"><i class="ti ti-server"></i>{{ __('Tên dịch vụ') }}:</label>
                    <x-input type="text" name="name" :value="old('name')" :required="true" placeholder="{{ __('Tên dịch vụ') }}" />
                </div>
            </div>
			<!-- default_unit -->
            <div class="col-12">
                <div class="mb-3">
                    <label class="control-label"><i class="ti ti-percentage"></i>{{ __('Đơn vị tính') }}:</label>
                    <x-input type="text" name="default_unit" :value="old('default_unit')" :required="true" placeholder="{{ __('Đơn vị tính') }}" />
                </div>
            </div>
        </div>
    </div>
</div>