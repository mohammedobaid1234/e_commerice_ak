<x-store-front-layout> 
  <div class="masonry-wrapper p-10 m-10" data-col-md="3" data-col-sm="2" data-col-xs="1" data-gap="30" data-radio="100%" style="margin: 20px !important">
    <div class="ps-masonry">
      <div class="grid-sizer"></div>
      @foreach ($products as $product)
      
          <div class="grid-item nike">
          <div class="grid-item__content-wrapper">
            <div class="ps-shoe mb-30">
              <div class="ps-shoe__thumbnail"><a class="ps-shoe__favorite" href="{{ asset('assets/front/#')}}"><i class="ps-icon-heart"></i></a><img style="width: 260px; height:170px" src="{{ $product->image_url}}" alt=""><a class="ps-shoe__overlay" href="{{ route('home.show', $product->id)}}"></a>
              </div>
              <div class="ps-shoe__content">
                  <div class="ps-shoe__variants">
                  <div class="ps-shoe__variant normal"><img src="{{ asset('assets/front/images/shoe/2.jpg')}}" alt=""><img src="{{ asset('assets/front/images/shoe/3.jpg')}}" alt=""><img src="{{ asset('assets/front/images/shoe/4.jpg')}}" alt=""><img src="{{ asset('assets/front/images/shoe/5.jpg')}}" alt=""></div>
                  <select class="ps-rating ps-shoe__rating">
                      <option value="1">1</option>
                      <option value="1">2</option>
                      <option value="1">3</option>
                      <option value="1">4</option>
                      <option value="2">5</option>
                  </select>
                  </div>
                  <div class="ps-shoe__detail"><a class="ps-shoe__name" href="{{ asset('assets/front/#')}}">{{$product->name}}</a>
                  <p class="ps-shoe__categories"><a href="{{ asset('assets/front/#')}}">Men shoes</a>,<a href="{{ asset('assets/front/#')}}"> Nike</a>,<a href="{{ asset('assets/front/#')}}"> Jordan</a></p><span class="ps-shoe__price"> £ {{$product->price}}</span>
                  </div>
              </div>
            </div>
            {{-- <x-product-item :product= '$product'  /> --}}
          </div>
          </div>
      @endforeach
     
    </div>
  </div> 

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</x-store-front-layout>