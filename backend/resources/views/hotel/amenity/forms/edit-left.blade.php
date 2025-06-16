<div class="col-12 col-md-9">
    <div class="card mb-3">
        <div class="card-header justify-content-center">
            <h2 class="mb-0">{{ __('Danh sách tiện nghi') }}</h2>
        </div>
        <div class="row card-body">
            <div class="accordion accordion-flush" id="accordionFlushExample">
                @foreach ($amenitiesTree as $key => $parent)
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="{{ 'heading-'.$key }}">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="{{'#'. $key }}" aria-expanded="false" aria-controls="{{ $key }}">
                                {{ $parent['name'] }}
                            </button>
                        </h2>
                        <div id="{{ $key }}" class="accordion-collapse collapse" aria-labelledby="{{ 'heading-'.$key }}"
                            data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body">
                                {{ $parent['children'] }}
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>

        </div>
    </div>
</div>