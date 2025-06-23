@extends('layouts.master')

@push('libs-css')
@endpush

@section('content')
	<div class="page-body">
		<div class="container-xl">
			<div class="card">
				<div class="card-header justify-content-between">
					<h2 class="mb-0">{{ __('Danh sách biến thể') }}</h2>
					<x-link :href="route('hotel.room_type_variant.create', ['hotel_id' => Auth()->user()->id, 'room_type_id' => $room_type->id])" class="btn btn-primary"><i
							class="ti ti-plus"></i>{{ __('Thêm biến thể') }}</x-link>
				</div>
				<div class="card-body">
					<div class="table-responsive position-relative">
						<x-admin.partials.toggle-column-datatable />
						{{ $dataTable->table(['class' => 'table table-bordered', 'style' => 'min-width: 900px;'], true) }}
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection

@push('libs-js')
	<!-- button in datatable -->
	<script src="{{ asset('/vendor/datatables/buttons.server-side.js') }}"></script>
@endpush

@push('custom-js')
	{{ $dataTable->scripts() }}

	@include('hotel.room_types.room_type_variants.scripts.datatable')
@endpush