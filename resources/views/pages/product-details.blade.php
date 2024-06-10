@extends('layouts.master')
@section('content')

    <link rel="stylesheet" href="{{asset('assets/css/details.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/main.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
            integrity="sha256-4+XzXVhsDmqanXGHaHvgh1gMQKX40OUvDEBTu8JcmNs=" crossorigin="anonymous"></script>
    <script src="{{ asset('js/share.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@2.8.2/dist/alpine.min.js"></script>
    <script src="{{asset('asset/js/main.js')}}"></script>
<meta property="og:title" content="{{$product->code}}">
<meta property="og:image" content="{{$product->getFirstMediaUrl('products')}}">

    @livewireStyles

    <main>


        @if(Session::has('message'))

            <div class="w-25" x-data="{show: true}" x-init="setTimeout(() => show = false, 1500)" x-show="show">
                <div class="alert alert-success">{{ Session::get('message') }}</div>
            </div>
        @endif


        <div class="card-wrapper  py-4">
            <div class="card">
                <!-- card left -->
                <div class="product-imgs">
                    <div class="img-display">
                        <div class="img-showcase">

                            @foreach($imgs as $img )
                                <img
                                    src="{{$imgs[$loop->index]->getUrl()}}"
                                    alt="shoe image">
                            @endforeach
                        </div>
                    </div>
                    <div class="img-select">
                        @foreach($imgs as $img)

                            <div class="img-item">
                                <a href="#" data-id="{{$loop->index+1}}">
                                    <img
                                        src="{{$imgs[$loop->index]->getUrl()}}"
                                        alt=" image">
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
                <!-- card right -->
                <div class="product-content">
                    <h2 class="product-title">{{getTrans($product,'name')}}</h2>

                    <div class="product-price">
                        <p>{{lang('code')}} <span class="new-price">{{$product->code}}</span></p>
                    </div>

                    <div class="product-price">
                        <a href="{{route('langs.products',[$product->department->category->id ?? 1,
                        $product->department->id??1])}}">
                            <p>{{lang('dep_name')}}:
                                <span class="new-price">{{$product->department->name??"
                        no"}}</span></p>
                        </a>
                    </div>

                    <div class="product-detail">
                        <h2>{{lang('details')}}</h2>
                        <p class="product-detail">{!! getTrans($product,'description')!!}</p>


                    </div>
                    <form action="{{route('langs.addToCart')}}" method="post">
                        @csrf
                        <div class="purchase-info ">
                            <input hidden value="{{$product->id}}" name="product">
                            <input type="number" min="0" value="1" name="num">
                            <button type="submit" class="btn">
                                {{lang('cart')}} <i class="fas fa-shopping-cart"></i>
                            </button>

                        </div>
                    </form>

                    <div class="social-links">
                        <p>{{lang('share')}}: </p>

                        {!! $social=Share::page(url('/details/'.$product->id),$product->getFirstMediaUrl('products'))->facebook()!!}
                        {!! $social=Share::page(url('/details/'.$product->id))->whatsapp()!!}
                        {!! $social=Share::page(url('/details/'.$product->id))->telegram()!!}
                        {!! $social=Share::page(url('/details/'.$product->id))->twitter()!!}
{{--                        <a href="https://www.facebook.com/sharer/sharer.php?u=http://127.0.0.1:8000/details/{{$id}}}">--}}
{{--                            <i class="fab fa-facebook-f"></i>--}}
{{--                        </a>--}}
{{--                        <a href="https://twitter.com/intent/tweet?text=Share+title&url=http://127.0.0.1:8000/details/{{$id}}">--}}
{{--                            <i class="fab fa-twitter"></i>--}}
{{--                        </a>--}}
{{--                        <a href="https://t.me/share/url?url=http://127.0.0.1:8000/details/{{$id}}">--}}
{{--                            <i class="fab fa-telegram"></i>--}}
{{--                        </a>--}}
{{--                        <a href="https://wa.me/?text=http://127.0.0.1:8000/details/{{$id}}">--}}
{{--                            <i class="fab fa-whatsapp"></i>--}}
{{--                        </a>--}}
                    </div>
                </div>
            </div>
        </div>

        {{--relative products--}}


        <div class="container-fluid">
            {{--            <div id="relative_products" class="owl-carousel tag-div " >--}}

            {{--                @foreach($allproducts as $product)--}}
            {{--                    <div class="product-item" >--}}

            {{--                        <a class="text-decoration-none" href="{{route('langs.product_details',[$product])}}">--}}
            {{--                            <div class="card cards-shadown cards-hover  d-flex flex-column w-75" data-aos="flip-left"--}}
            {{--                                 data-aos-duration="950" onmouseover="showsmall(this)" onmouseleave="hide2(this)">--}}
            {{--                                <div class="adding-hidden" id="add">--}}
            {{--                                    <form action="{{route('langs.addToCart')}}" method="post">--}}
            {{--                                        @csrf--}}


            {{--                                        <input hidden value="{{$product->id}}" name="product">--}}
            {{--                                        <input hidden type="number" min="0" value="1" name="num">--}}
            {{--                                        <button type="submit" class="btn">--}}
            {{--                                            <i class="fas fa-plus-circle icn"></i>--}}
            {{--                                        </button>--}}
            {{--                                    </form>--}}

            {{--                                </div>--}}

            {{--                                <div class="card-header"><img class="img-fluid rounded-img"--}}
            {{--                                                              src="{{$product->getFirstMediaUrl('products')}}">--}}
            {{--                                </div>--}}
            {{--                                <div class="card-body after">--}}
            {{--                                    <p class="card-text sub-text-color">{{getTrans($product,'name')}}</p>--}}
            {{--                                    <span class="card-text sub-text-color">{{$product->code}} </span>--}}
            {{--                                    @if(app()->getLocale()=="ar")--}}
            {{--                                        <p class="card-text sub-text-color">{{$product->department->name ??--}}
            {{--                                                ""}}</p>--}}

            {{--                                    @elseif(app()->getLocale()=="en")--}}
            {{--                                        <p class="card-text--}}
            {{--                                                    sub-text-color">{{$product->department->name_en ??--}}
            {{--                                                ""}}</p>--}}
            {{--                                    @elseif(app()->getLocale()=="tr")--}}
            {{--                                        <p class="card-text--}}
            {{--                                                    sub-text-color">{{$product->department->name_tr ??--}}
            {{--                                                ""}}</p>--}}
            {{--                                    @endif--}}
            {{--                                    --}}{{--                                            <p class="card-text cardbody-sub-text">{!!getTrans($product,'description')!!}</p>--}}
            {{--                                </div>--}}
            {{--                            </div>--}}
            {{--                        </a>--}}
            {{--                    </div>--}}
            {{--                @endforeach--}}

            {{--            </div>--}}


            <div id="relative_products" class="owl-carousel tag-div">

                @foreach($allproducts as $product)
                    <div class="tito product-item">


                        <a class="text-decoration-none"
                           href="{{route('langs.product_details',[$product])}}">
                            <div class="card cards-shadown cards-hover w-100 d-flex flex-column align-items-center"
                                 data-aos="flip-left"
                                 data-aos-duration="950">
                                <div class="card-header px-1 px-md-2 " onmouseover="show(this)" onmouseleave="hide
                                (this)">
                                    <div class="adding-hidden " id="add">
                                        <form action="{{route('langs.addToCart')}}" method="post">
                                            @csrf


                                            <input hidden value="{{$product->id}}" name="product">
                                            <input hidden type="number" min="0" value="1" name="num">
                                            <button type="submit" class="btn">
                                                <i class="fas fa-plus-circle icn"></i>
                                            </button>
                                        </form>

                                    </div>
                                    <img class="img-fluid rounded-img"
                                         src="{{$product->getFirstMediaUrl('products')}}">
                                </div>
                                <div class="card-body after">
                                    <p class="card-text sub-text-color">{{getTrans($product,'name')}}</p>
                                    <span class="card-text sub-text-color">{{$product->code}} </span>
                                    @if(app()->getLocale()=="ar")
                                        <p class="card-text sub-text-color">{{$product->department->name ??
                                                ""}}</p>

                                    @elseif(app()->getLocale()=="en")
                                        <p class="card-text
                                                    sub-text-color">{{$product->department->name_en ??
                                                ""}}</p>
                                    @elseif(app()->getLocale()=="tr")
                                        <p class="card-text
                                                    sub-text-color">{{$product->department->name_tr ??
                                                ""}}</p>
                                    @endif
                                    {{--                                            <p class="card-text cardbody-sub-text">{!!getTrans($product,'description')!!}</p>--}}
                                </div>
                            </div>
                        </a></div>
                @endforeach

            </div>


        </div>


        <div class=" mt-2 container">
            @foreach($tags as $tag)


                <a href="#" class="badge badge-dark tags-div py-2 px-2 mb-1">{{$tag->name}}</a>


            @endforeach
        </div>

    </main>
    <script>
        const imgs = document.querySelectorAll('.img-select a');
        const imgBtns = [...imgs];
        let imgId = 1;

        imgBtns.forEach((imgItem) => {
            imgItem.addEventListener('click', (event) => {
                event.preventDefault();
                imgId = imgItem.dataset.id;
                slideImage();
            });
        });

        function slideImage() {
            const displayWidth = document.querySelector('.img-showcase img:first-child').clientWidth;

            let x = 1;
            if (document.dir === 'ltr') {
                x = -1;
            }
            document.querySelector('.img-showcase').style.transform = `translateX(${x * (imgId - 1) * displayWidth}px)`;
        }

        window.addEventListener('resize', slideImage);
    </script>

    @livewireScripts
@endsection
