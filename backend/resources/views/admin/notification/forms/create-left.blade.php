<div class="col-12 col-md-9">
    <div class="card">
        <div class="card-header justify-content-center">
            <h2 class="mb-0">{{ __('Thông tin thông báo') }}</h2>
        </div>
        <div class="row card-body">
            <!-- title -->
            <div class="col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Tiêu đề') }}:</label>
                    <x-input type="text" name="title" :value="old('title')" :required="true"
                        placeholder="{{ __('Tiêu đề') }}" />
                </div>
            </div>

            <!-- user_id -->
            <div class="col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Người nhận') }}:</label>
                    <x-select name="user_id[]" class="select2-bs5-ajax" :data-url="route('search.select.user')"
                        id="user_id" multiple>
                    </x-select>
                    <span class="text-danger">* Để trống nếu chọn tất cả</span>
                </div>
            </div>
            
            <div class="col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Nội dung') }}:</label>
                    <textarea name="content" class="ckeditor visually-hidden">{{ old('content') }}</textarea>
                </div>
            </div>
        </div>
    </div>
</div>