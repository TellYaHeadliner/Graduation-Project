{{-- {{ $parent['name'] ?? 'Không có' }} --}}
@if(!empty($parent['name']))
    <x-link 
        :href="route('admin.amenity.edit', $parent['id'])" 
        :title="$parent['name']" 
    />
@else
    {{ 'Không có' }}
@endif  
