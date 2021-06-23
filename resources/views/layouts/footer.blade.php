<br>
<!-- footer -->

<footer class="main-footer" >
    <div class="footer-content row p-3">
        <div class="col-md text-center">
            <h5 class="pl-2 m-3 font-weight-bolder" >{{__('main.communication')}}</h5>
            <ul>
                <li>email@example.com <i class="fa fa-envelope m-2"></i></li>
                <li> +0201011447799 <i class="fa fa-phone-alt m-2"></i></li>
                <li>
                    <i class="fab fa-facebook-square m-2"></i>
                    <i class="fab fa-twitter m-2"></i>
                    <i class="fab fa-instagram m-2"></i>
                    <i class="fab fa-youtube m-2"></i>
                </li>
            </ul>
        </div>
        <div class="col-md text-center">
            <h5 class="pl-2 m-3 font-weight-bolder" >{{__('main.account')}}</h5>
            <ul>
                <li>text text text</li>
                <li>text text text text text</li>
                <li>text </li>
                <li>text text text</li>
                <li>text text text</li>
                <li>text text text text text</li>
                <li>text </li>
            </ul>
        </div>
        <div class="col-md text-center">
            <h5 class="pl-2 m-3 font-weight-bolder" >{{__('main.important.links')}}</h5>
            <ul>
                <li>text text text</li>
                <li>text text text text text</li>
                <li>text </li>
                <li>text text text</li>
                <li>text text text</li>
                <li>text text text text text</li>
                <li>text </li>
                <li>text text text</li>
                <li>text text text</li>
            </ul>
        </div>
    </div>
    <div class="copyrights row align-items-center justify-content-center">
        <h6>&copy;{{__('main.copyrights')}}</h6>
    </div>
</footer>
<div class="fixed-button" id="goTop"><i class="fa fa-angle-up" ></i></div>


<div class="fixed-button" id="search">
    <i class="fa fa-search" ></i>
</div>

<div class="search-cont">
    <input type="text" placeholder="{{__('main.search')}}" id="search_value">
    <div id="search_result">


    </div>
</div>


<div class="fixed-button" id="settingsButton"><i class="fa fa-cog" ></i></div>
<div id="slideSettings">
    <a href="{{url('/theme')}}"><i class="fa fa-adjust" ></i></a>
    <a href="{{app()->getLocale() == 'ar'? route('lang' ,'en'):route('lang' ,'ar')}}"><i class="fa fa-language" ></i></a>
</div>
</div>

<livewire:scripts>

<script>

    $('#search_value').on('keyup' ,function (){
        $.ajax({
            type:'POST',
            url:'{{route('home.search')}}',
            data:{
                '_token':'{{csrf_token()}}',
                'value' : $(this).val(),
            },
            success : function (data){
                $('#search_result').html('');
                for (let i = 0 ;i < data.result.length ;i++){
                    let name ,desc;
                    if ('{{app()->getLocale()}}' === 'en'){
                        name = data.result[i].product_name_en;
                        desc = data.result[i].product_desc_en;
                    }else if('{{app()->getLocale()}}' === 'ar'){
                        name = data.result[i].product_name_ar;
                        desc = data.result[i].product_desc_ar;
                    }
                    let link = '{{url('/view/')}}/' + data.result[i].id;
                    $('#search_result').append('<a href="'+ link +'">\n' +
                        '            <div class="s-result">\n' +
                        '                <div class="row">\n' +
                        '                    <div class="col-8 row align-items-center">\n' +
                        '                        <div class="pt-3 ">\n' +
                        '                            <h6>  '+ name +'  </h6>\n' +
                        '                            <p>  '+ desc +'  </p>\n' +
                        '                        </div>\n' +
                        '                    </div>\n' +
                        '                    <div class="col-4 row justify-content-center align-items-center">\n' +
                        '                        <img src="{{asset("img/products")}}/' + data.images[i].image_name +' " alt="" class="img-thumbnail img-size-64">\n' +
                        '                    </div>\n' +
                        '                </div>\n' +
                        '            </div>\n' +
                        '        </a>');
                }
            },
            error(){
                alert('Error!');
            }
        });
    });


</script>

<script src="{{asset('js/popper.js')}}" ></script>
<script src="{{asset('js/bootstrap.js')}}" ></script>
<script src="{{asset('js/script.js')}}" ></script>
</body>
</html>
