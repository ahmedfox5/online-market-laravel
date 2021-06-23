@extends('dashboard.layouts.app')

@section('content')
    <!-- TABLE: LATEST ORDERS -->
    <div class="card fox-glass2-light">
        <div class="card-header border-transparent">
            <h3 class="card-title">{{__('dashboard.section.products')}} :  {{$section_name}}</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table m-0" >
                    <thead>
                    <tr>
                        <th>{{__('dashboard.product.name')}}</th>
                        <th>{{__('dashboard.product.desc')}}</th>
                        <th>{{__('dashboard.product.price')}}</th>
                        <th>{{__('dashboard.product.img')}}</th>
                        <th>{{__('dashboard.actions')}}</th>
                    </tr>
                    </thead>
                    <tbody>

                        @foreach($products as $product)
                            <tr>
                                <td>{{$product->product_name_en}}</td>
                                <td>{{$product->product_desc_en}}</td>
                                <td>{{$product->price}}</td>
                                <td>
                                    @foreach($images as $image)
                                        @if($image->product_id == $product->id)
                                            <img src="{{asset('img/products/' . $image->image_name)}}" class="img-thumbnail" alt="">
                                            @break
                                        @endif
                                    @endforeach
                                </td>
                                <td>
{{--                                    <button class="btn btn-sm btn-primary m-1">{{__('dashboard.details')}}</button>--}}
                                    <a href="{{route('d.product.edit' ,$product->id)}}"><button class="btn btn-sm btn-success m-1">{{__('dashboard.edit')}}</button></a>
                                    <button onclick="alert_delete('{{route('d.destroy',$product->id)}}');" class="btn btn-sm btn-danger m-1">{{__('dashboard.delete')}}</button>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
            <!-- /.table-responsive -->
        </div>
        <!-- /.card-body -->
        <div class="card-footer clearfix">
            <a href="{{route('d.newProduct')}}" class="btn btn-sm btn-primary float-left">{{__('dashboard.product.create')}}</a>
        </div>
        <!-- /.card-footer -->
    </div>

@endsection
@section('script')
    <script>
        $('.d-sections').addClass('active');
        $('.pagination').parent().addClass('pagination-father');
        $('.pagination .page-link').addClass('fox-glass2-light');
    //    end of pagination


    //

    </script>
@endsection


