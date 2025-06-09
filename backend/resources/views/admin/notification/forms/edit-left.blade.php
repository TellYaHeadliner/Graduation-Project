<div class="col-12 col-md-9">
    <div class="card">
        <div class="card-header justify-content-center">
            <h2 class="mb-0">{{ __('Thông tin tiện ích') }}</h2>
        </div>
        <div class="row card-body">
            <!-- title -->
            <div class="col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Tiêu đề') }}:</label>
                    <x-input type="text" name="title" :value="$notification->title" :required="true"
                        placeholder="{{ __('Tiêu đề') }}" />
                </div>
            </div>
            
            <div class="col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Nội dung') }}:</label>
                    <textarea name="content" class="ckeditor visually-hidden">{{ $notification->content }}</textarea>
                </div>
            </div>
        </div>
    </div>
</div>