@auth
   @if(auth()->user()->id == request()->route()->parameters['user_id'])

       @extends('layouts.app')

        @section('content')


{{--            ////////////       cart items    23--}}

    <livewire:cart-items />

{{--            /////////    make order button   --}}


            @if(session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{session('success')}}</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif


{{--            <script>--}}


{{--                ///////////// shopping cart scripts--}}

{{--                //plus and minus functions--}}
{{--                function plus(id){--}}
{{--                    $.ajax({--}}
{{--                        type:'POST',--}}
{{--                        url:'{{route('plus.cart')}}',--}}
{{--                        data:{--}}
{{--                            '_token' : '{{csrf_token()}}',--}}
{{--                            'id' : id,--}}
{{--                        }--}}
{{--                    });--}}
{{--                }--}}

{{--                function minus(id){--}}
{{--                    $.ajax({--}}
{{--                        type:'POST',--}}
{{--                        url:'{{route('minus.cart')}}',--}}
{{--                        data:{--}}
{{--                            '_token' : '{{csrf_token()}}',--}}
{{--                            'id' : id,--}}
{{--                        }--}}
{{--                    });--}}
{{--                }--}}


{{--                var count = function(ele){--}}

{{--                    // plus--}}
{{--                    $(ele + ' .plus').on("click" ,function(){--}}
{{--                        $(ele + ' .count').val(parseInt($(ele + ' .count').val()) + 1 );--}}
{{--                        getTotalPrice();--}}
{{--                    });--}}

{{--                    // minus--}}
{{--                    $(ele + ' .minus').on("click" ,function(){--}}
{{--                        $(ele + ' .count').val(parseInt($(ele + ' .count').val()) - 1 );--}}
{{--                        if ($( ele + ' .count').val() == 0) {--}}
{{--                            $(ele + ' .count').val(1);--}}
{{--                        }--}}
{{--                        getTotalPrice();--}}
{{--                    });--}}


{{--                }--}}



{{--                    @foreach($products as $product)--}}
{{--                        new count(".product{{$product->id}}");--}}
{{--                    @endforeach--}}


{{--                function getTotalPrice(){--}}
{{--                    let total = 0;--}}
{{--                    let prices = document.getElementsByClassName('pro-price');--}}
{{--                    let counts = document.getElementsByClassName('count');--}}
{{--                    if(prices.length > 0){--}}
{{--                        for (let i = 0 ; i < prices.length ;i++){--}}
{{--                            total += parseInt(prices[i].innerHTML) * counts[i].value;--}}
{{--                        }--}}
{{--                        document.querySelector('.total-cost').innerHTML = total + "$";--}}
{{--                    }else {--}}
{{--                        document.querySelector('.total-cost').innerHTML = "0$";--}}
{{--                    }--}}
{{--                }--}}
{{--                getTotalPrice();--}}
{{--            </script>--}}
        @endsection
    @endif
@endauth


