<div>


    <h3 class="text-center m-4 mt-5" > Order information </h3>

    <div class="container p-2" >

        <form wire:submit.prevent="orderEnd" >




            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputFName">First Name</label>
                    <input type="text" wire:model="firstName" class="form-control" id="inputFName" placeholder="First Name">
                    @error('firstName')
                        <p style="color: #ff2222;">{{$message}}</p>
                    @enderror
                </div>


                <div class="form-group col-md-6">
                    <label for="inputLName">Last Name</label>
                    <input type="text" wire:model="lastName" class="form-control" id="inputLName" placeholder="Last name">
                    @error('lastName')
                        <p style="color: #ff2222;">{{$message}}</p>
                    @enderror
                </div>
            </div>


            <div class="form-group">
                <label for="inputEmail">Email</label>
                <input type="email" wire:model="email" class="form-control" id="inputEmail" placeholder="Email">
            </div>
            @error('email')
                <p style="color: #ff2222;">{{$message}}</p>
            @enderror

            <div class="form-group">
                <label for="inputPhone">Phone</label>
                <input type="text" wire:model="phone" class="form-control " id="inputPhone" placeholder="phone number to communicate">
            </div>
            @error('phone')
                <p style="color: #ff2222;">{{$message}}</p>
            @enderror

            <div class="form-group">
                <label for="inputAddress">Address</label>
                <input type="text" wire:model="address" class="form-control " id="inputAddress" placeholder="1234 Main St">
            </div>
                @error('address')
                    <p style="color: #ff2222;">{{$message}}</p>
                @enderror

            <div class="form-group">
                <label for="inputAddress2">Address 2 (Not mandatory)</label>
                <input type="text" wire:model="address2" class="form-control" id="inputAddress2" placeholder="Apartment, studio, or floor">
            </div>
            <button type="submit" class="btn btn-primary">End the order</button>
        </form>

    </div>



</div>
