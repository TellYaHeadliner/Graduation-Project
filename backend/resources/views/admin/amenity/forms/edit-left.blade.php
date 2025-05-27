<div class="col-12 col-md-9">
	<div class="card">
		<div class="card-header justify-content-center">
			<h2 class="mb-0">{{ __('Thông tin tiện ích') }}</h2>
		</div>
		<div class="row card-body">
			<!-- name -->
			<div class="col-12">
				<div class="mb-3">
					<label class="control-label">{{ __('Tên tiện ích') }}:</label>
					<x-input type="text" name="name" :value="$amenity->name" :required="true"
						placeholder="{{ __('Tên tiện ích') }}" />
				</div>
			</div>

			<!-- parent_id -->
			<div class="col-12">
				<div class="mb-3">
					<label class="control-label">{{ __('Tiện ích cha') }}:</label>
					<x-select name="parent_id" class="select2-bs5-ajax"
						:data-url="route('admin.search.select.amenities')" id="parent_id">
						@if(!empty($amenity->parent_id))
							<x-select-option :option="$amenity->parent_id" :value="$amenity->parent_id"
								:title="$amenity->parent->name" />
						@endif
					</x-select>
					<p class="text-danger">* Để trống nếu không có tiện ích cha</p>
				</div>
			</div>
		</div>
	</div>
</div>