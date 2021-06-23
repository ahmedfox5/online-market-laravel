@extends('dashboard.layouts.app')

@section('content')


    <!-- TABLE: LATEST ORDERS -->
    <div class="card fox-glass2-light">
        <div class="card-header border-transparent">
            <h3 class="card-title">{{__('dashboard.slider.slides')}}</h3>

        </div>
        <!-- /.card-header -->



            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table m-0" >
                        <thead>
                        <tr>
                            <th class="w-50">{{__('dashboard.slider.image')}}</th>
                            <th class="w-50">{{__('dashboard.slider.image.mobile')}}</th>
                            <th>{{__('dashboard.slider.actions')}}</th>
                        </tr>
                        </thead>
                        <tbody>

                            @foreach($slides as $slide)
                                <tr>
                                    <td >
                                        <img src="{{asset('img/slides/' . $slide->image_name)}}" class="m-auto d-flex img-thumbnail " alt="">
                                    </td>

                                    <td >
                                        <img src="{{asset('img/slides/mobile/' . $slide->image_name)}}" class="m-auto d-flex img-thumbnail " alt="">
                                    </td>

                                    <td>
                                        <a href="{{route('slider.edit' ,$slide->id)}}"><button class="btn btn-sm btn-success m-1">{{__('dashboard.edit')}}</button></a>
                                        <button onclick="alert_delete('{{route('slider.delete',$slide->id)}}');"  class="btn btn-sm btn-danger m-1">{{__('dashboard.delete')}}</button>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>



            <!-- /.table-responsive -->

            <div class="card-footer clearfix">
                <a href="{{route('slider.create')}}" class="btn btn-sm btn-primary float-left">{{__('dashboard.slider.create')}}</a>
            </div>
        </div>

    </div>



@endsection

@section('script')
    <script>
        $('.d-home-slider').addClass('active');
    </script>
@endsection
