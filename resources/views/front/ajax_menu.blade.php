@foreach ($data as $item)
<div class="col-lg-6 menu-item isotope-item filter-starters">
  <img src="{{ asset('assets/admin/uploads') . '/' . $item->image }}" class="menu-img" alt="" 
  style="min-width: 170px;max-width: 170px;min-height: 170px;max-height: 170px">
  <div class="menu-content">

      <span>
          @if ($langCurent::isLocale('en'))
              {{ $item->eng_name }}
          @else
          {{ $item->name }}
          @endif
      </span><span style="direction: rtl">
        @if ($langCurent::isLocale('en'))
        {{ $item->price }} riyal 
    @else
    {{ $item->price }} ريال 
    @endif
         
        </span>
  </div>
  <div class="menu-ingredients">
    @if ($langCurent::isLocale('en'))
    {{ $item->eng_details }}
@else
{{ $item->details }}
@endif
  </div>
</div><!-- Menu Item -->
@endforeach