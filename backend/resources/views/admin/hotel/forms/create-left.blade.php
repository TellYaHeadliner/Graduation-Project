<div class="col-12 col-md-9">
    <!-- Thông tin cơ bản -->
    <div class="card mb-3">
        <div class="card-header justify-content-center">
            <h2 class="mb-0">{{ __('Thông tin cơ bản') }}</h2>
        </div>
        <div class="row card-body">
            {{-- name --}}
            <div class="col-md-6 col-12">
                <div class="mb-3">
                    <label class="control-label"><i class="ti ti-user-edit"></i> {{ __('Tên khách sạn') }}:</label>
                    <x-input name="name" :value="old('name')" placeholder="{{ __('Tên khách sạn') }}" />
                </div>
            </div>
            {{-- phone --}}
            <div class="col-md-6 col-12">
                <div class="mb-3">
                    <label class="control-label"><i class="ti ti-phone"></i> {{ __('Số điện thoại') }}:</label>
                    <x-input-phone name="phone" :value="old('phone')" placeholder="{{ __('Số điện thoại') }}" />
                </div>
            </div>
            {{-- email --}}
            <div class="col-md-6 col-12">
                <div class="mb-3">
                    <label class="control-label"><i class="ti ti-mail"></i> {{ __('Email') }}:</label>
                    <x-input-email id="emailInput" name="email" :value="old('email')" />
                </div>
            </div>
            {{-- mst --}}
            <div class="col-md-6 col-12">
                <div class="mb-3">
                    <label class="control-label"><i class="ti ti-numbers"></i> {{ __('Mã số thuế') }}:</label>
                    <x-input type="number" name="mst" :value="old('mst')" :required="true"
                        placeholder="{{ __('Mã số thuế') }}" />
                </div>
            </div>
            {{-- address --}}
            <div class="col-md-6 col-12">
                <div class="mb-3">
                    <label class="control-label"><i class="ti ti-map-pin"></i> {{ __('Địa chỉ') }}:</label>
                    <x-input name="address" :value="old('address')" placeholder="{{ __('Địa chỉ') }}" />
                </div>
            </div>
            <!-- user id -->
			<div class="col-md-6 col-12">
				<div class="mb-3">
					<label class="control-label"> <span class="text-danger">*</span> {{ __('Chủ sở hữu') }}:</label>
					<x-select name="id" class="select2-bs5-ajax" :data-url="route('admin.search.select.userCustomer')"
                        id="id" >
                    </x-select>
                    
                </div>
			</div>
            <!-- desc -->
			<div class="col-12">
				<div class="mb-3">
					<label class="control-label">{{ __('Mô tả') }}:</label>
					<textarea name="description" class="ckeditor visually-hidden">{{ old('description') }}</textarea>
				</div>
			</div>
        </div>
    </div>
    <!-- Thông tin ngân hàng -->
    <div class="card mb-3">
        <div class="card-header justify-content-center">
            <h2 class="mb-0 ">{{ __('Thông tin ngân hàng') }}</h2>
        </div>
        <div class="row card-body">
            {{-- bank_account_name --}}
            <div class="col-md-6 col-12">
                <div class="mb-3">
                    <label class="control-label"><i class="ti ti-user-edit"></i> {{ __('Tên tài khoản') }}:</label>
                    <x-input name="bank_account_name" :value="old('bank_account_name')"
                        placeholder="{{ __('Tên tài khoản') }}" />
                </div>
            </div>
            {{-- bank_account_number --}}
            <div class="col-md-6 col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Số tài khoản') }}:</label>
                    <x-input type="number"  name="bank_account_number" :value="old('bank_account_number')" :required="true"
                        placeholder="{{ __('Số tài khoản') }}" />
                </div>
            </div>
            <div class="col-md-6 col-12">
                <div class="mb-3">
                    <label class="control-label"><i class="ti ti-user-edit"></i> {{ __('Tên ngân hàng') }}:</label>
                    <x-input name="bank_name" :value="old('bank_name')"
                        placeholder="{{ __('Tên ngân hàng') }}" />
                </div>
            </div>
        </div>
    </div>
</div>