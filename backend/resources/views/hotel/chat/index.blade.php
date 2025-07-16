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
								@include('hotel.chat.partials.conversation_list', ['conversations' => $conversations])
							</div>
							<div class="col-md-9 d-flex flex-column h-100" id="message-box">
								<div id="message-list" class="p-3 bg-light"
									style="height: 100%; overflow-y: auto; scroll-behavior: smooth;">
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
																		<br>
																		<small class=" px-3 py-2 text-muted">${format_date(msg.sent_at)}</small>
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

		function format_date(datetimeString) {
			const date = new Date(datetimeString);
			return date.toLocaleString('vi-VN', {
				hour: '2-digit',
				minute: '2-digit',
				day: '2-digit',
				month: '2-digit',
				year: 'numeric'
			});
		}
		document.addEventListener('DOMContentLoaded', function () {
			initConversationEvents();
			window.Echo.private(`App.Models.User.${userId}`)
				.listen('MessageSent', (e) => {
					fetch(`/hotel/chat/message-list/${userId}`)
						.then(res => res.text())
						.then(html => {
							const list = document.getElementById('conversation-list');
							list.innerHTML = html;
							initConversationEvents();
						});
					if (e.conversation_id == currentConversationId) {
						loadConversation(currentConversationId);
					}
				});
		});
	</script>
@endpush