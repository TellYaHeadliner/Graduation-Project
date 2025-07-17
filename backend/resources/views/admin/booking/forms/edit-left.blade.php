<div class="col-12 col-md-9">
	<div class="card">
		<div class="card-header justify-content-center">
			<h2 class="mb-0"> Chi tiết đơn đặt phòng - {{ $booking->booking_code }}</h2>
		</div>
		<div class="row card-body">

			{{-- Cột trái --}}
			<div class="col-md-6 mb-3">
				<label class="form-label">Khách sạn:</label>
				<div class="form-control-plaintext">{{ $booking->hotel->name ?? '-' }}</div>

				<label class="form-label">Khách hàng:</label>
				<div class="form-control-plaintext">{{ $booking->user->fullname ?? '-' }}</div>

				<label class="form-label">Trạng thái:</label>
				<div class="form-control-plaintext">
					<span @class([
						'badge',
						$booking->status->badge(),
					])>{{ $booking->status->description() }}</span>
				</div>

				<label class="form-label">Ngày đặt:</label>
				<div class="form-control-plaintext">{{ $booking->created_at->format('d/m/Y H:i') }}</div>
			</div>

			{{-- Cột phải --}}
			<div class="col-md-6 mb-3">
				<label class="form-label">Check-in:</label>
				<div class="form-control-plaintext">{{ $booking->checkin_date}}</div>

				<label class="form-label">Check-out:</label>
				<div class="form-control-plaintext">{{ $booking->checkout_date}}</div>

				<label class="form-label">Ghi chú:</label>
				<div class="form-control-plaintext">{{ $booking->note ?: 'Không có' }}</div>

				<label class="form-label">Tổng thanh toán:</label>
				<div class="form-control-plaintext fw-bold text-success">{{ number_format($booking->total_amount) }} đ
				</div>
			</div>

			{{-- Chi tiết phòng --}}
			<div class="col-12">
				<label class="form-label mt-4">Phòng đã đặt:</label>
				<div class="table-responsive">
					<table class="table table-bordered align-middle">
						<thead class="table-light">
							<tr>
								<th>Loại phòng</th>
								<th>Phòng</th>
								<th>Lựa chọn</th>
								<th>Giá/đêm</th>
								<th>Số đêm</th>
								<th>Tổng tiền</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($booking->bookingDetails as $detail)
								<tr>
									<td>{{ $detail->roomType->name }}</td>
									<td>{{ $detail->room->code }}</td>
									<td>
										@foreach ($detail->variant->attributes as $attr)
											@if($attr->type == 'guest' || $attr->type == 'children')
												<div>{{ $attr->name }}: {{ $attr->pivot->attribute_value }} Người</div>
											@elseif($attr->type == 'meal' || $attr->type == 'smoking')
												<div>{{ $attr->name }}: {{ $attr->pivot->attribute_value ? 'Có' : 'Không' }}</div>
											@elseif($attr->type == 'free_before and fee_after')
												<div>{{ $attr->name }}: {{ number_format($attr->pivot->attribute_value) }} đ</div>
											@elseif($attr->type == 'no_refund')
												<div>{{ $attr->name }}</div>
											@endif
										@endforeach
									</td>
									<td>{{ number_format($detail->price_per_room) }} đ</td>
									<td>{{ $booking->nights }} đêm</td>
									<td>{{ number_format($detail->price_per_room * $booking->nights) }} đ</td>
								</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>

			{{-- Dịch vụ thêm --}}
			@if ($booking->bookingServices->count())
				<div class="col-12 mt-4">
					<label class="form-label">Dịch vụ thêm:</label>
					<div class="table-responsive">
						<table class="table table-bordered">
							<thead class="table-light">
								<tr>
									<th>Dịch vụ</th>
									<th>Số lượng</th>
									<th>Giá</th>
									<th>Tổng tiền</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($booking->bookingServices as $service)
									<tr>
										<td>{{ $service->hotelService->service->name }}</td>
										<td>{{ $service->quantity }}</td>
										<td>{{ number_format($service->price) }} đ</td>
										<td>{{ number_format($service->total_price) }} đ</td>
									</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
			@endif

			{{-- Gói Combo --}}
			@if ($booking->bookingCombos->count())
				<div class="col-12 mt-4">
					<label class="form-label">Gói Combo:</label>
					<div class="table-responsive">
						<table class="table table-bordered">
							<thead class="table-light">
								<tr>
									<th>Tên combo</th>
									<th>Số lượng</th>
									<th>Giá</th>
									<th>Tổng tiền</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($booking->bookingCombos as $combo)
									<tr>
										<td>{{ $combo->combo->name }}</td>
										<td>{{ $combo->quantity }}</td>
										<td>{{ number_format($combo->price) }} đ</td>
										<td>{{ number_format($combo->total_price) }} đ</td>
									</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
			@endif

			@if ($booking->voucher)
				<div class="col-12">
					<label class="form-label mt-4">Voucher:</label>
					<div class="form-control-plaintext">
						<strong>Mã:</strong> {{ $booking->voucher->code }}<br>
						<strong>Giảm:</strong> {{ number_format($booking->voucher->discount_value) }} đ
					</div>
				</div>
			@endif

			<div class="col-12">
				<label class="form-label mt-4">Tổng kết đơn hàng:</label>
				<ul class="list-group">
					<li class="list-group-item d-flex justify-content-between">
						<span>Tổng tiền phòng</span>
						<span>{{ number_format($booking->room_total) }} đ</span>
					</li>
					<li class="list-group-item d-flex justify-content-between">
						<span>Dịch vụ thêm</span>
						<span>{{ number_format($booking->service_total) }} đ</span>
					</li>
					<li class="list-group-item d-flex justify-content-between">
						<span>Gói combo</span>
						<span>{{ number_format($booking->combo_total) }} đ</span>
					</li>
					<li class="list-group-item d-flex justify-content-between">
						<span>Giảm giá voucher</span>
						<span class="text-danger">-{{ number_format($booking->voucher->discount_value) }} đ</span>
					</li>
					<li class="list-group-item d-flex justify-content-between fw-bold">
						<span>Tổng thanh toán</span>
						<span>{{ number_format($booking->total_amount) }} đ</span>
					</li>
				</ul>
			</div>
		</div>
	</div>
</div>