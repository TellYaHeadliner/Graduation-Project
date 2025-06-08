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
                    <x-input type="text" name="name" :value="$season->name" :required="true"
                        placeholder="{{ __('Tên Mùa ưu đãi') }}" />
                </div>
            </div>

            <div class="col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Ngày bắt đầu') }}:</label>
                    <x-input type="date" name="start_date" :value=" format_date($season->start_date,'Y-m-d')" />
                </div>
            </div>

            <div class="col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Ngày kết thúc') }}:</label>
                    <x-input type="date" name="end_date" :value=" format_date($season->end_date,'Y-m-d')" />
                </div>
            </div>

            <div class="col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Mô tả') }}:</label>
                    <textarea name="description" class="ckeditor visually-hidden">{{ $season->description }}</textarea>
                </div>
            </div>
        </div>
    </div>
</div>