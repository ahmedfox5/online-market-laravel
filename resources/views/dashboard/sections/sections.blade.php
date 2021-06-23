@extends('dashboard.layouts.app')

@section('content')

    <?php
        $section_name = 'section_name_' . app()->getLocale();
    ?>
    <!-- TABLE: LATEST ORDERS -->
    <div class="card fox-glass2-light">
        <div class="card-header border-transparent">
            <h3 class="card-title">{{__('dashboard.products')}}</h3>

        </div>
        <!-- /.card-header -->
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table m-0" >
                    <thead>
                    <tr>
                        <th>{{__('dashboard.section.name')}}</th>
                        <th>{{__('dashboard.section.image.offer')}}</th>
                        <th>{{__('dashboard.section.actions')}}</th>
                    </tr>
                    </thead>
                    <tbody>

                        @foreach($sections as $section)
                            <tr>
                                <td>{{$section->$section_name}}</td>
                                <td>
                                    @if($section->section_image)
                                        <img src="{{asset('img/sections/' . $section->section_image)}}" class="img-thumbnail" alt="">
                                    @else
                                        {{__('dashboard.no.image')}}
                                    @endif
                                </td>
                                <td>
                                    <a href="{{route('d.edit.section',$section->id)}}"><button class="btn btn-sm btn-success m-1">{{__('dashboard.edit')}}</button></a>
                                    <a href="{{route('d.products.section',$section->id)}}"><button class="btn btn-sm btn-secondary m-1">{{__('dashboard.products')}}</button></a>
                                    <button onclick="alert_delete('{{route('d.delete.section' ,$section->id)}}');" class="btn btn-sm btn-danger m-1">{{__('dashboard.delete')}}</button>
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
            <a href="{{route('d.new.section')}}" class="btn btn-sm btn-primary float-left">{{__('dashboard.section.create')}}</a>
{{--            {{$products->links()}}--}}
            <a href="javascript:void(0)" class="btn btn-sm btn-primary float-right">{{__('dashboard.product.all')}}</a>
        </div>
        <!-- /.card-footer -->
    </div>

@endsection

@section('script')
    <script>
        $('.d-sections').addClass('active');
    </script>
@endsection
