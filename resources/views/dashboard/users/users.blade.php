@extends('dashboard.layouts.app')

@section('content')
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
                        <th>{{__('dashboard.name')}}</th>
                        <th>{{__('dashboard.account')}}</th>
                        <th>{{__('dashboard.user.job')}}</th>
                        <th>{{__('dashboard.user.img')}}</th>
                        <th>{{__('dashboard.user.actions')}}</th>
                    </tr>
                    </thead>
                    <tbody>

                        @foreach($users as $user)
                            <tr>
                                <td>{{$user->first_name . " " . $user->last_name}}</td>
                                <td>{{$user->email}}</td>
                                <td class="user_job_show">
                                </td>
                                <td >
                                    <img src="{{asset('img/users/' . $user->img_name)}}" style="width: 50px; height: 50px" class="img-thumbnail offset-2 img-circle" alt="">
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-success edit-job-button m-1" data-job="@if($user->job === 2){{__('dashboard.user.job.2')}}@elseif($user->job === 3){{__('dashboard.user.job.3')}}@endif" onclick="editUserJob(this ,{{$user->id}} ,'{{$user->first_name}}')">{{__('dashboard.edit')}}</button>
                                    <button onclick="alert_delete('{{route('d.user.delete',$user->id)}}');" class="btn btn-sm btn-danger m-1">{{__('dashboard.delete')}}</button>
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
             {{$users->links()}}
        <!-- /.card-footer -->
    </div>

        <form id="edit_user_job" method="post" class="p-3" >

            <div class="cont">
                <h6 class="text-center">{{__('dashboard.user.edit.job') . ' '}} <span id="us_name" ></span></h6>

                <div class="m-3">
                    <!-- radio -->
                    <div class="form-group clearfix">
                        <div  class="icheck-primary d-flex align-items-center justify-content-center ">
                            <input type="radio" value="2" id="radioPrimary2" class="d-inline m-2 job-input" name="job">
                            <label for="radioPrimary2" class="w-100 font-weight-normal">
                                {{__('dashboard.user.job.2')}}
                            </label>
                        </div>
                    </div>

                    <div class="form-group clearfix">
                        <div  class="icheck-primary d-flex align-items-center justify-content-center ">
                            <input type="radio" value="3" id="radioPrimary3" class="d-inline m-2 job-input" name="job">
                            <label for="radioPrimary3" class="w-100 font-weight-normal">
                                {{__('dashboard.user.job.3')}}
                            </label>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary ajax-edit-job">Submit</button>
            </div>

            <div class="ajax-success">Successful :)</div>

        </form>

@endsection
@section('script')
    <script>
        $('.d-users').addClass('active');
        $('.pagination').parent().addClass('pagination-father');
        $('.pagination .page-link').addClass('fox-glass2-light');
    //    end of pagination


    // edit user job
        let the_job ,the_btn;
        function editUserJob(btn ,id ,userName ){
            $('#us_name').html(userName);
            the_btn = btn;
            $('.ajax-success').hide();
            $('#edit_user_job').fadeIn();
            $('#radioPrimary2').removeAttr('checked');
            $('#radioPrimary3').removeAttr('checked');
            $('.ajax-edit-job').attr('id',id);
        }

        function change_jobs(){
            var shows = document.getElementsByClassName('user_job_show');
            var btns = document.getElementsByClassName('edit-job-button');
            for (let i = 0 ;i < shows.length ;i++){
                shows[i].innerHTML = btns[i].getAttribute('data-job');
            }
        }
        change_jobs();


        $('.ajax-edit-job').on('click',function (event){
            event.preventDefault();
            the_job = $('input[name=job]:checked').val();
            $.ajax({
                type:'POST',
                url:'{{route('d.user.job.edit')}}',
                data:{
                    '_token' : "{{csrf_token()}}",
                    'job' : $('input[name=job]:checked').val(),
                    'id' : $(this).attr('id'),
                },
                success:function (){
                    var the_j;
                    if($('input[name=job]:checked').val() == 3){
                        the_j = 'User';
                    }else if($('input[name=job]:checked').val() == 2){
                        the_j = 'Admin';
                    }
                    $('.ajax-success').fadeIn().delay(1000).fadeOut();
                    $('#edit_user_job').delay(1000).fadeOut();
                    the_btn.setAttribute('data-job',the_j);
                    change_jobs();
                }
            });

        });


    </script>
@endsection


