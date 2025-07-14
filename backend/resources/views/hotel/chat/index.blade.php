@extends('layouts.master')

@push('libs-css')
	@vite(['resources/js/app.js'])
@endpush

@section('content')
	<div class="page-body">
		<div class="container-xl">
			<div class="card">
				<div class="card-header justify-content-between">
					<h2 class="mb-0">{{ __('Tư vấn khách hàng') }}</h2>
				</div>
				<div class="card-body">
					@if($conversations->count())
						<div class="row" style="height: 70vh;">
							<div class="col-md-3 border-end overflow-auto" id="conversation-list">
								<div class="list-group list-group-flush">
									@foreach($conversations as $item)
										@php $customer = $item->customer; @endphp
										<a href="javascript:void(0);"
											class="list-group-item list-group-item-action py-3 conversation-item"
											data-conversation-id="{{ $item->id }}" id="conversation-{{ $item->id }}">
											<div class="d-flex align-items-center gap-2">
												<img src="{{ asset($customer->avatar ?? 'images/default-avatar.png') }}"
													alt="{{ $customer->fullname }}" class="rounded-circle object-fit-cover" width="40"
													height="40">
												<div class="flex-grow-1">
													<div class="d-flex justify-content-between">
														<div class="fw-semibold text-truncate">
															{{ $customer->name }}
														</div>
														<small class="text-muted">
															{{ format_date($item->last_message_at, 'd-m-Y H:i') }}
														</small>
													</div>
													<div class="text-muted text-truncate small">
														{{ $item->last_message }}
													</div>
												</div>
											</div>
										</a>
									@endforeach
								</div>
							</div>

							{{-- KHU VỰC TIN NHẮN --}}
							<div class="col-md-9 d-flex flex-column" id="message-box">
								<div class="flex-grow-1 overflow-auto p-3 bg-light" id="message-list"
									style="scroll-behavior: smooth;">
								</div>

								<div class="border-top p-3 d-flex align-items-center gap-2 bg-white">
									<input id="chat-input" type="text" class="form-control" placeholder="Nhập tin nhắn...">
									<button onclick="sendMessage()" class="btn btn-primary">
										<i class="ti ti-send"></i> Gửi
									</button>
								</div>
							</div>
						</div>
					@else
						<div class="alert alert-info">Bạn không có cuộc trò chuyện nào.</div>
					@endif
				</div>
			</div>
		</div>
	</div>
@endsection

@push('libs-js')
@endpush

@push('custom-js')
	<script>
		const userId = {{ auth()->id() }};
		let currentConversationId = null;
		let currentChannel = null;

		function initConversationEvents() {
			document.querySelectorAll('.conversation-item').forEach(item => {
				item.addEventListener('click', function () {
					const conversationId = this.dataset.conversationId;
					loadConversation(conversationId);
				});
			});
		}

		function loadConversation(conversationId) {
			currentConversationId = conversationId;

			if (currentChannel) {
				window.Echo.leave(currentChannel);
			}

			currentChannel = 'conversation.' + conversationId;

			window.Echo.private(currentChannel)
				.listen('MessageSent', (e) => {
					if (e.conversation_id == currentConversationId) {
						loadConversation(currentConversationId);
					} else {
						const list = document.getElementById('conversation-list');
						const convoEl = document.getElementById('conversation-' + e.conversation_id);
						if (convoEl) {
							list.prepend(convoEl);
						}
					}
				});

			fetch(`/hotel/chat/message/${userId}/${conversationId}`)
				.then(res => res.json())
				.then(res => {
					const box = document.getElementById('message-list');
					box.innerHTML = '';

					res.messages.forEach(msg => {
						const div = document.createElement('div');
						div.className = 'mb-2';
						div.innerHTML = `
							<div class="${msg.sender_id === userId ? 'text-end' : 'text-start'}">
								<span class="d-inline-block px-3 py-2 rounded bg-${msg.sender_id === userId ? 'blue' : 'gray'}-200">
									${msg.message}
								</span>
							</div>`;
						box.appendChild(div);
					});

					box.scrollTop = box.scrollHeight;
				});
		}

		function sendMessage() {
			const input = document.getElementById('chat-input');
			const content = input.value.trim();
			if (!content || !currentConversationId) return;

			fetch(`/hotel/chat/send-message/${userId}`, {
				method: 'POST',
				headers: {
					'Content-Type': 'application/json',
					'X-CSRF-TOKEN': '{{ csrf_token() }}',
				},
				body: JSON.stringify({
					conversation_id: currentConversationId,
					content: content
				})
			}).then(res => res.json()).then(() => {
				input.value = '';
			});
		}

		document.addEventListener('DOMContentLoaded', function () {
			initConversationEvents();
		});
	</script>
@endpush