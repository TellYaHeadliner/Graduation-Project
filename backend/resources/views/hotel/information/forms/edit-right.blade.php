<div class="col-12 col-md-3">
    <div class="card mb-3">
        <div class="card-header">
            <i class="ti ti-playstation-circle"></i>
            <span class="ms-2">{{ __('Đăng') }}</span>
        </div>
        <div class="card-body d-flex justify-content-between p-2">
            <x-button.submit :title="__('Lưu')" />
        </div>
    </div>
     <div class="card mb-3">
        <div class="card-header">
            <i class="ti ti-star"></i>
            <span class="ms-2">@lang('Số sao khách sạn')</span>
        </div>
        <div class="card-body p-2" style="display:flex; flex-direction: column;">
            <label><input type="radio" name="star_rating" value="0" {{ (old('star_rating', $hotel->star_rating) == '0') ? 'checked' : '' }}> Không có</label>
            <label><input type="radio" name="star_rating" value="1" {{ (old('star_rating', $hotel->star_rating) == '1') ? 'checked' : '' }}> ⭐</label>
            <label><input type="radio" name="star_rating" value="2" {{ (old('star_rating', $hotel->star_rating) == '2') ? 'checked' : '' }}> ⭐⭐</label>
            <label><input type="radio" name="star_rating" value="3" {{ (old('star_rating', $hotel->star_rating) == '3') ? 'checked' : '' }}> ⭐⭐⭐</label>
            <label><input type="radio" name="star_rating" value="4" {{ (old('star_rating', $hotel->star_rating) == '4') ? 'checked' : '' }}> ⭐⭐⭐⭐</label>
            <label><input type="radio" name="star_rating" value="5" {{ (old('star_rating', $hotel->star_rating) == '5') ? 'checked' : '' }}> ⭐⭐⭐⭐⭐</label>
        </div>
    </div>
    <div class="card mb-3">
        <div class="card-header">
            <i class="ti ti-photo"></i>
            <span class="ms-2">@lang('Avatar')</span>
        </div>
        <div class="card-body p-2">
            <x-input-image-ckfinder name="avatar" showImage="featureImage" :value="$hotel->avatar" />
        </div>
    </div>

    <div class="card mb-3">
        <div class="card-header">
            <span><i class="ti ti-library-photo"></i>{{ __('Thư viện ảnh') }}</span>
        </div>
        <div class="card-body p-2">
            <x-input-gallery-ckfinder name="gallery" type="multiple" :value="$hotel->gallery" />
        </div>
    </div>
</div>