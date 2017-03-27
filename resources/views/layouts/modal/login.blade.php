<style type="text/css">
    #loginModal .modal-content {
        width: 50vw;
        top: 50vh;
        left: 50vw;
        transform: translate(-50%,-50%);
    }

    @media screen and (max-width: 600px) {
        #loginModal .modal-content {
            width: 100vw;
            top: 0;
        }
    }

    #loginModal .modal-body {
        margin: 0;
    }

    #loginModal .modal-body a {
        color: white;
    }
</style>

<div id="loginModal" class="modal modal-default fade" role="dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
            <ul class="nav nav-pills">
                <li class="active"><a data-toggle="tab" href="#login"><h4 class="modal-title">Log In</h4></a></li>
                <li><a data-toggle="tab" href="#register"><h4 class="modal-title">Register</h4></a></li>
            </ul>
        </div>
        <div class="modal-body">
            <div class="tab-content">
                <div id="login" class="tab-pane fade in active">
                    <div class="login-box-body" style="background-color:transparent;">
                        <p class="login-box-msg">{{ trans('adminlte::adminlte.login_message') }}</p>
                        <form action="{{ url(config('adminlte.login_url', 'login')) }}" method="post">
                            {!! csrf_field() !!}

                            <div class="form-group has-feedback {{ $errors->has('email') ? 'has-error' : '' }}">
                                <input type="email" name="email" class="form-control" value="{{ old('email') }}"
                                       placeholder="{{ trans('adminlte::adminlte.email') }}" autocomplete="off">
                                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group has-feedback {{ $errors->has('password') ? 'has-error' : '' }}">
                                <input type="password" name="password" class="form-control"
                                       placeholder="{{ trans('adminlte::adminlte.password') }}" autocomplete="off">
                                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="row">
                                <div class="">
                                    <div class="checkbox icheck col-xs-8">
                                        <label>
                                            <input type="checkbox" name="remember"> {{ trans('adminlte::adminlte.remember_me') }}
                                        </label>
                                    </div>
                                </div>
                                <!-- /.col -->
                                <div class="col-xs-4">
                                    <button type="submit"
                                            class="btn btn-primary btn-block btn-flat">{{ trans('adminlte::adminlte.sign_in') }}</button>
                                </div>
                                <!-- /.col -->
                            </div>
                        </form>
                        <div class="auth-links">
                            <a href="{{ url(config('adminlte.password_reset_url', 'password/reset')) }}"
                               class="text-center"
                            >{{ trans('adminlte::adminlte.i_forgot_my_password') }}</a>
                            <br>
                        </div>
                    </div>
                </div>
                <div id="register" class="tab-pane fade">
                    <div class="register-box-body">
                        <p class="login-box-msg">{{ trans('adminlte::adminlte.register_message') }}</p>
                        <form action="{{ url(config('adminlte.register_url', 'register')) }}" method="post">
                            {!! csrf_field() !!}

                            <!-- First Name -->
                            <div class="form-group has-feedback {{ $errors->has('first_name') ? 'has-error' : '' }}">
                                <input type="text" name="fname" class="form-control" value="{{ old('first_name') }}"
                                       placeholder="First Name">
                                <span class="glyphicon glyphicon-user form-control-feedback"></span>
                                @if ($errors->has('first_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('first_name') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <!-- Last Name -->
                            <div class="form-group has-feedback {{ $errors->has('last_name') ? 'has-error' : '' }}">
                                <input type="text" name="lname" class="form-control" value="{{ old('last_name') }}"
                                       placeholder="Last Name">
                                <span class="glyphicon glyphicon-user form-control-feedback"></span>
                                @if ($errors->has('last_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('last_name') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <!-- Email -->
                            <div class="form-group has-feedback {{ $errors->has('email') ? 'has-error' : '' }}">
                                <input type="email" name="email" class="form-control" value="{{ old('email') }}"
                                       placeholder="{{ trans('adminlte::adminlte.email') }}">
                                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <!-- Password -->
                            <div class="form-group has-feedback {{ $errors->has('password') ? 'has-error' : '' }}">
                                <input type="password" name="pword" class="form-control"
                                       placeholder="{{ trans('adminlte::adminlte.password') }}">
                                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <!-- Password Confirmation -->
                            <div class="form-group has-feedback {{ $errors->has('password_confirmation') ? 'has-error' : '' }}">
                                <input type="password" name="password_confirmation" class="form-control"
                                       placeholder="{{ trans('adminlte::adminlte.retype_password') }}">
                                <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <!-- Birthdate -->
                            <div class="form-group has-feedback {{ $errors->has('last_name') ? 'has-error' : '' }}">
                                <input type="text" name="lname" class="form-control" value="{{ old('last_name') }}"
                                       placeholder="Last Name">
                                <span class="glyphicon glyphicon-user form-control-feedback"></span>
                                @if ($errors->has('last_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('last_name') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <button type="submit"
                                    class="btn btn-primary btn-block btn-flat"
                            >{{ trans('adminlte::adminlte.register') }}</button>
                        </form>
                    </div>
                </div>
            </div>

        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
            <!-- <button type="button" class="btn btn-outline">Save changes</button> -->
        </div>
    </div>
</div>
