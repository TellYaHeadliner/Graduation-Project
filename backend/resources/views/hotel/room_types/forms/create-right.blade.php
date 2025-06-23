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
            <span><i class="ti ti-check"></i>{{ __(' Đang hoạt động') }}</span>
        </div>
        <div class="card-body p-2">
            <x-input-switch name="status" value="1" :label="__('Đang hoạt động?')" />
        </div>
    </div>
    <div class="card mb-3">
        <div class="card-header">
            <span><i class="ti ti-library-photo"></i>{{ __('Thư viện ảnh') }}</span>
        </div>
        <div class="card-body p-2">
            <x-input-gallery-ckfinder name="gallery" type="multiple" />
        </div>
    </div>


</div>