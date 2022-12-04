{{-- {{dd($product)}} --}}
<x-store-front-layout>
    <div class="test">
        <div class="container">
          <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 ">
                </div>
          </div>
        </div>
      </div>
      <div class="ps-product--detail pt-60">
        <div class="ps-container">
          <div class="row">
            <div class="col-lg-10 col-md-12 col-lg-offset-1">
              <div class="ps-product__thumbnail">
                <div class="ps-product__preview">
                  <div class="ps-product__variants">
                    <div class="item"><img src="{{$product->image_url}}" alt=""></div>
                    <div class="item"><img src="{{$product->image_url}}" alt=""></div>
                    <div class="item"><img src="{{$product->image_url}}" alt=""></div>
                    <div class="item"><img src="{{$product->image_url}}" alt=""></div>
                    <div class="item"><img src="{{$product->image_url}}" alt=""></div>
                  </div><a class="popup-youtube ps-product__video" href="http://www.youtube.com/watch?v=0O2aH4XLbto"><img src="images/shoe-detail/1.jpg" alt=""><i class="fa fa-play"></i></a>
                </div>
                <div class="ps-product__image">
                  <div class="item"><img class="zoom" src="{{$product->image_url}}" alt="" data-zoom-image="images/shoe-detail/1.jpg"></div>
                  <div class="item"><img class="zoom" src="images/shoe-detail/2.jpg" alt="" data-zoom-image="images/shoe-detail/2.jpg"></div>
                  <div class="item"><img class="zoom" src="images/shoe-detail/3.jpg" alt="" data-zoom-image="images/shoe-detail/3.jpg"></div>
                </div>
              </div>
              <div class="ps-product__thumbnail--mobile">
                <div class="ps-product__main-img"><img src="images/shoe-detail/1.jpg" alt=""></div>
                <div class="ps-product__preview owl-slider" data-owl-auto="true" data-owl-loop="true" data-owl-speed="5000" data-owl-gap="20" data-owl-nav="true" data-owl-dots="false" data-owl-item="3" data-owl-item-xs="3" data-owl-item-sm="3" data-owl-item-md="3" data-owl-item-lg="3" data-owl-duration="1000" data-owl-mousedrag="on"><img src="images/shoe-detail/1.jpg" alt=""><img src="images/shoe-detail/2.jpg" alt=""><img src="images/shoe-detail/3.jpg" alt=""></div>
              </div>
              <div class="ps-product__info">
                <div class="ps-product__rating">
                  <select class="ps-rating">
                    <option value="1">1</option>
                    <option value="1">2</option>
                    <option value="1">3</option>
                    <option value="1">4</option>
                    <option value="2">5</option>
                  </select><a href="#">(Read all 8 reviews)</a>
                </div>
                <h1>Air strong  training</h1>
                <p class="ps-product__category"><a href="#"> {{$product->category->name}}</a></p>
                <h3 class="ps-product__price">£ {{$product->price}} 
                  @if ($product->flag == 2)
                  <del>£ {{$product->price_after_discount}}</del>
                  @endif
                </h3>
                <div class="ps-product__block ps-product__quickview">
                  <h4>{{$product->name}}</h4>
                  <p>{{$product->description}}</p>
                </div>
                <div class="ps-product__block ps-product__size">
                  
                  <div class="form-group">
                  <form class="buy"  method="POST" >
                        <input class="form-control" name="quantity" type="number" value="1">
                      </div>
                    </div>
                    <div class="ps-product__shopping">
                        @csrf
                        {{-- <input type="text" hidden name="product_id"  value="{{$product->id}}"> --}}
                        <button id="add-to-cart" type="submit" class="ps-btn mb-10" href="cart.html">Add to cart<i class="ps-icon-next"></i></button>
                  </form>
                  {{-- <div class="ps-product__actions"><a class="mr-10" href="whishlist.html"><i class="ps-icon-heart"></i></a><a href="compare.html"><i class="ps-icon-share"></i></a></div> --}}
                </div>
              </div>
              <div class="clearfix"></div>
            </div>
          </div>
        </div>
      </div>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
      {{-- <script src={{asset('/public/assets/js/pages/widgets.js')}}></script> --}}
      <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
      <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

      <script src="{{ asset('/resources/js/http.js') }}"></script>
      <script src="{{ asset('/resources/js/sweetalert.min.js') }}"></script>
      <script src="{{ asset('/resources/js/global.js') }}"></script>
      <script>$id = {{$product->id}}</script>
      <script>

        $('#add-to-cart').click(function (e) { 
          e.preventDefault();
          var $this = $(this).closest('form');
          console.log('object');
          var buttonText = $this.find('button:submit').text();
          data = {
            _token: $("meta[name='csrf-token']").attr("content"),
            product_id: $id,
            quantity: $("input[name='quantity']").val(),
          }
          $this.find("button:submit").attr('disabled', true);
          $this.find("button:submit").html('<span class="fas fa-spinner" data-fa-transform="shrink-3"></span>');

          $.post($("meta[name='BASE_URL']").attr("content") + "/api/add_transaction", data,
          function (response, status) {
              http.success({ 'message': response.message });
              // window.location.reload();
          })
          .fail(function (response) {
              http.fail(response.responseJSON, true);
          })
          .always(function () {
              $this.find("button:submit").attr('disabled', false);
              $this.find("button:submit").html(buttonText);
          });
        });
      </script>
</x-store-front-layout>