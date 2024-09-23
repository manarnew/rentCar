              @foreach ($data as $item)
              <div class="col-lg-4 menu-item">
                <a href="#"><img
                        src="{{ asset('assets/admin/uploads') . '/' . $item->image }}"
                        class="glightbox" style=" box-shadow: 15px 3px 8px 1px #cbc8c8;border-radius:5%;"
                        alt=""></a>
                <h4 style="margin-top:10px ">
                    @if ($langCurent::isLocale('en'))
                    {{ $item->eng_name }}
                @else
                {{ $item->name }}
                @endif
                </h4>
                <p class="ingredients">
                    @if ($langCurent::isLocale('en'))
                    {{ $item->eng_details }}
                @else
                {{ $item->details }}
                @endif
                </p>
                <p class="price" style="direction: rtl;">
                    @if ($langCurent::isLocale('en'))
                    {{ $item->price }} riyal 
                @else
                {{ $item->price }} ريال 
                @endif
                </p>
            </div>
              @endforeach