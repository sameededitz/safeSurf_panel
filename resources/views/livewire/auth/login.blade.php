<div>
    <div class="accountbg"></div>
    <div class="wrapper-page">

        <div class="card">
            <div class="card-body">

                <div class="text-center">
                    <a href="index.html" class="logo logo-admin"><img src="{{ asset('assets/images/login-logo.png') }}" height="80" alt="logo"></a>
                </div>

                <div class="px-3 pb-3">
                    <form class="form-horizontal m-t-20" wire:submit.prevent="login">

                        <div class="form-group row">
                            <div class="col-12">
                                <input class="form-control" wire:model="email" type="email" required="" placeholder="email">
                            </div>
                        </div>
                        @error('email')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror

                        <div class="form-group row">
                            <div class="col-12">
                                <input class="form-control" type="password" required="" wire:model="password" placeholder="Password">
                            </div>
                        </div>
                        @error('password')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror

                        <div class="form-group row">
                            <div class="col-12">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="customCheck1">
                                    <label class="custom-control-label" for="customCheck1">Remember me</label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group text-center row m-t-20">
                            <div class="col-12">
                                <button class="btn btn-danger btn-block waves-effect waves-light" wire:click="login" type="submit">Log In</button>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>
