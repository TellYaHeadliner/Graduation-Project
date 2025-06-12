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
            <span><i class="ti ti-toggle"></i>{{ __(' Đang áp dụng') }}</span>
        </div>
        <div class="card-body p-2">
            <x-input-switch name="status" value="1" :label="__('Đang áp dụng ?')" />
        </div>
    </div>

</div>
