<div class="col-12 col-md-9">
    <div class="card mb-3">
        <div class="card-header justify-content-center">
            <h2 class="mb-0">{{ __('Thông tin loại phòng') }}</h2>
        </div>
        <div class="row card-body">
            <!-- name -->
            <div class="col-md-6 col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Tên loại phòng') }}:</label>
                    <x-input type="text" name="name" :value="$room_type->name" :required="true"
                        placeholder="{{ __('Tên loại phòng') }}" />
                </div>
            </div>
            <!-- room_code -->
            <div class="col-md-6 col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Mã loại phòng') }}:</label>
                    <x-input type="text" name="room_code" :value="$room_type->room_code" :required="true"
                        placeholder="{{ __('Mã loại phòng') }}" />
                </div>
            </div>

            <!-- bed_type_id -->
            <div class="col-md-6 col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Loại giường') }}:</label>
                    <x-select name="bed_type_id" class="select2-bs5-ajax" :data-url="route('search.select.bed_type')"
                        id="bed_type_id">
                        <x-select-option :option="$room_type->bed_type_id" :value="$room_type->bed_type_id"
                            :title="$room_type->bedType->name" />
                    </x-select>
                </div>
            </div>

            {{-- bed_quantity --}}
            <div class="col-md-6 col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Số lượng giường') }}:</label>
                    <x-input type="number" name="bed_quantity" id="bed_quantity" min="1" step="1"
                        :value="$room_type->bed_quantity ?? 0" :placeholder="__('Số lượng giường')" />
                </div>
            </div>
            {{-- area --}}
            <div class="col-md-6 col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Diện tích(m²)') }}:</label>
                    <x-input type="number" name="area" id="area" min="1" :value="$room_type->area ?? 0"
                        :placeholder="__('Diện tích(m²)')" />
                </div>
            </div>

            <div class="col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Mô tả ngắn') }}:</label>
                    <textarea name="description"
                        class="ckeditor visually-hidden">{{ $room_type->description ?? '' }}</textarea>
                </div>
            </div>
        </div>
    </div>
    <div class="card mb-3">
        <div class="card-header justify-content-center">
            <h2 class="mb-0">{{ __('Danh sách tiện nghi') }}</h2>
        </div>
        <div class="row card-body">
            <div class="accordion accordion-flush" id="accordionFlushExample">
                @foreach ($amenitiesTree as $key => $parent)
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="{{ 'heading-' . $key }}">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="{{'#' . $key }}" aria-expanded="false" aria-controls="{{ $key }}">
                                {{ $parent['name'] }}
                            </button>
                        </h2>
                        <div id="{{ $key }}" class="accordion-collapse collapse" aria-labelledby="{{ 'heading-' . $key }}"
                            data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body">
                                <div class="d-flex flex-wrap">
                                    @foreach($parent['children'] as $key => $value)
                                        <div class="form-check m-2">
                                            <input class="form-check-input" type="checkbox" id="{{ $key }}" value="{{ $key }}"
                                                name="amenities[]" {{ in_array($key, $roomTypeAmenities) == 1 ? 'checked' : ''}}>
                                            <label class="form-check-label" for="{{ $key }}">{{ $value }}</label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>