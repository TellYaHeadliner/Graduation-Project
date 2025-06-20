<div class="col-12 col-md-9">
    <div class="card">
        <div class="card-header justify-content-center">
            <h2 class="mb-0">{{ __('Thông tin dịch vụ') }}</h2>
        </div>
        <div class="row card-body">

            <!-- name -->
            <div class="col-md-6 col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Tên loại phòng') }}:</label>
                    <x-input type="text" name="name" :value="old('name')" :required="true"
                        placeholder="{{ __('Tên loại phòng') }}" />
                </div>
            </div>
            <!-- room_code -->
            <div class="col-md-6 col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Mã loại phòng') }}:</label>
                    <x-input type="text" name="room_code" :value="old('room_code')" :required="true"
                        placeholder="{{ __('Mã loại phòng') }}" />
                </div>
            </div>

            {{-- room_quantity --}}
            <div class="col-md-6 col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Số lượng phòng') }}:</label>
                    <x-input type="number" name="room_quantity" id="room_quantity" min="1" step="1"
                        :value="old('room_quantity')" :required="true" :placeholder="__('Số lượng phòng')" />
                </div>
            </div>

            <div class="col-md-6 col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Tạo phòng nhanh') }}:</label>
                    <x-input-checkbox name="create_room" :value="1" :label="__('Tạo phòng nhanh với số lượng phòng ?')"
                        :checked="old('create_room',  [])"  />

                </div>
            </div>
           
            <!-- bed_type_id -->
            <div class="col-md-6 col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Loại giường') }}:</label>
                    <x-select name="bed_type_id" class="select2-bs5-ajax" :data-url="route('search.select.bed_type')"
                        id="bed_type_id">
                    </x-select>
                </div>
            </div>

            {{-- bed_quantity --}}
            <div class="col-md-6 col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Số lượng giường') }}:</label>
                    <x-input type="number" name="bed_quantity" id="bed_quantity" min="1" step="1"
                        :value="old('bed_quantity')" :required="true" :placeholder="__('Số lượng giường')" />
                </div>
            </div>
             {{-- area --}}
            <div class="col-md-6 col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Diện tích(m²)') }}:</label>
                    <x-input type="number" name="area" id="area" min="1" :value="old('area')"
                       :required="true" :placeholder="__('Diện tích(m²)')" />
                </div>
            </div>

            <div class="col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Mô tả ngắn') }}:</label>
                    <textarea name="description" class="ckeditor visually-hidden">{{ old('description') }}</textarea>
                </div>
            </div>
        </div>
    </div>
</div>