<div class="select-action-multiple" style="display: none;">
				<div class="input-group col-12 col-md-6 ml-auto p-0">
								<x-select name="action" :required="true" data-parsley-errors-container=".error-action">
												@foreach ($actionMultiple as $key => $value)
																<x-select-option :value="$key" :title="__($value)" />
												@endforeach
								</x-select>
								<div class="input-group-append">
												<x-button.submit :title="__('apply')" />
								</div>
				</div>
				<div class="error-action col-12 col-md-6 ml-auto p-0"></div>
</div>
