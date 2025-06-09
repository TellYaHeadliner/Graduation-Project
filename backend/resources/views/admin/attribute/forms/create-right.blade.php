<div class="col-12 col-md-3">
    <div class="card mb-3">
        <div class="card-header">
            {{ __('Đăng') }}
        </div>
        <div class="card-body p-2">
            <x-button.submit :title="__('Thêm')" />
        </div>
    </div>
    <div class="card mb-3">
        <div class="card-header">
            <span><i class="ti ti-eye"></i>{{ __(' Hiển thị không') }}</span>
        </div>
        <div class="card-body p-2">
            <x-input-switch name="is_active" value="1" :label="__('Hiển thị không ?')" />
        </div>
    </div>

</div>
