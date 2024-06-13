@extends('layouts.master')
@section('content')
    <header >

    </header>
        <div class="container-fluid" >
            <i class="fas fa-folder-plus open-cats d-lg-none mt-2 " id="open-cats">
                <span class="words-cat">{{lang('zones').' + '.lang('sections')}}</span>
            </i>
            <div class="row ">
                <div class="col-12 col-lg-2 show-cats" id="cats-div">
                    <div class="row">
                        <div class="col-12 m-0">
                            <div
                                class="d-flex flex-row justify-content-start align-items-center align-content-center pt-3">
                                <div class="div-hr"></div>
                                <h5 class="text-dark mx-2">{{lang('search_zones')}}</h5>
                            </div>
                            <div class="row padMar">
                                <div class="col padMar">
                                    <form action="{{route('langs.search')}}">
                                        @csrf
                                        <div class="input-group ">
                                            <div class="input-group-prepend"></div>
                                            <input class="form-control autocomplete" type="text"
                                                   placeholder="{{lang('search_zones')}}">
                                            <div class="input-group-append">
                                                <button class="btn btn-sm search-btn btn-outline-dark"
                                                        type="submit"><i
                                                        class="fa fa-search"></i></button>

                                            </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row pt-5 ">

                    <div class="row pt-5">

                        <div class="col">

                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-10">
                <div class="row p-3">
                    <div class="col p-0">
                        <div class="d-flex flex-row justify-content-end align-items-center bg-gray">
                            <div class="px-3">
                                {{--                                       x--}}
                            </div>
                            <div class="div-left"></div>
                        </div>
                    </div>
                </div>
                <div class="row" >


                    @foreach($allproducts as $product )


                        <div class=" col-6 col-lg-3 mb-2 " >

                            <a class="text-decoration-none" href="{{route('langs.details',[$product->id])}}">
                                <div class="p-2 card product-main position-relative">
                                    <div class="text-center">
                                        <h5 class="text-truncate font-weight-bolder"> {{$product->name ??
                                            'Code'}}</h5>
                                    </div>
                                    <div class="div-hr-w"></div>
                                    <div>
                                        <div class="text-center card-img p-2 "><img class="img-fluid"
                                                                                   src="{{$product->getFirstMediaUrl
                                                                                   ('products')}}">

                                        </div>
{{--                                        <div class="px-3">--}}
{{--                                            <p class="text-dark font-weight-bold">--}}

{{--                                                {{getTrans($product,'name')}}</p>--}}

{{--                                        @if(app()->getLocale()=='ar')--}}

{{--                                            <p class="text-dark font-weight-bold">{{$product->department->name ??--}}
{{--                                            'Depatment'}}</p>--}}

{{--                                            @elseif(app()->getLocale()=='en')--}}
{{--                                                <p class="text-dark font-weight-bold">{{$product->department->name_en--}}
{{--                                                 ??--}}
{{--                                            'Depatment'}}</p>--}}

{{--                                            @elseif(app()->getLocale()=='tr')--}}
{{--                                                <p class="text-dark font-weight-bold">{{$product->department->name_tr--}}
{{--                                                 ??--}}
{{--                                            'Depatment'}}</p>--}}
{{--                                            @endif--}}

{{--                                        </div>--}}
                                    </div>
                                </div>
                            </a>
                        </div>



                    @endforeach
                </div>
            </div>

        </div>


        </div>

{{--    tags section--}}
        <div class=" mt-2 container">
{{--            @foreach($tags as $tag)--}}

{{--                <a href="#" class="badge badge-dark tags-div py-2 px-2 mb-1">{{$tag->name['ar']}}</a>--}}

{{--            @endforeach--}}

            {{--                <a href="#" class="badge badge-dark tag-div py-2 px-2 mb-1">Dark</a>--}}


        </div>
    </section>
@endsection


