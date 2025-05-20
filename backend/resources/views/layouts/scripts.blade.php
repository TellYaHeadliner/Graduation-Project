<script src="{{ asset('libs/tabler/dist/js/tabler.min.js') }}" defer></script>
<script src="{{ asset('libs/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('libs/jquery-toast-plugin/jquery.toast.min.js') }}"></script>
<script src="{{ asset('libs/Parsley.js-2.9.2/parsley.min.js') }}"></script>
<!-- datatables -->
<script src="{{ asset('libs/datatables/jquery.dataTables.min.js') }}"></script>

<script src="{{ asset('libs/datatables/plugins/bs5/js/dataTables.bootstrap5.min.js') }}"></script>

<script src="{{ asset('libs/datatables/plugins/buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('libs/datatables/plugins/buttons/js/buttons.bootstrap5.min.js') }}"></script>

<script src="{{ asset('libs/datatables/plugins/responsive/js/responsive.dataTables.min.js') }}"></script>
<script src="{{ asset('libs/datatables/plugins/responsive/js/responsive.bootstrap5.min.js') }}"></script>

<script src="{{ asset('sweetalert2/script.js') }}"></script>
<script src="//cdn.rawgit.com/google/code-prettify/master/loader/run_prettify.js" type="text/javascript"></script>

@stack('libs-js')
<script type="module" src="{{ asset('public/admin/assets/js/i18n.js') }}"></script>
<script src="{{ asset('admin/assets/js/setup.js') }}"></script>
<script src="{{ asset('libs/firebase/firebase.js') }}"></script>

<script src="{{ asset('libs/ckeditor/ckeditor.js') }}"></script>
<script src="{{ asset('libs/ckeditor/adapters/jquery.js') }}"></script>


<script type="text/javascript"
				src="https://maps.googleapis.com/maps/api/js?key={{ config('services.google_maps.api_key') }}&libraries=places&language=vi&callback=initMaps"
				async defer></script>
<script>
				function initMaps() {
								try {
												if (typeof initMap === 'function') {
																initMap();
												}
												if (typeof initEndMap === 'function') {
																initEndMap();
												}

								} catch (error) {
												handleAjaxError();
												window.location.reload();
								}
				}

				function disableSubmitButton(button) {
								button.disabled = true;
								button.innerHTML = 'Đang xử lý...';
								button.style.color = '#ffffff';
								button.closest('form').submit();
				}
</script>
@stack('custom-js')
