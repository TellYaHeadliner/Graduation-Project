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
					<x-input type="text" name="name" :value="$bedType->name" :required="true"
						placeholder="{{ __('Tên tiện ích') }}" />
				</div>
			</div>

		</div>
	</div>
</div>