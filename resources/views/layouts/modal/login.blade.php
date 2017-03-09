@extends('adminlte::master')

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
        padding: 0;
        margin: 0;
    }
</style>

<div id="loginModal" class="modal modal-default fade" role="dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
            <h4 class="modal-title">Log In</h4>
        </div>
        <div class="modal-body">
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
                        <div class="col-xs-8">
                            <div class="checkbox icheck">
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
                    @if (config('adminlte.register_url', 'register'))
                        <a href="{{ url(config('adminlte.register_url', 'register')) }}"
                           class="text-center"
                        >{{ trans('adminlte::adminlte.register_a_new_membership') }}</a>
                    @endif
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
            <!-- <button type="button" class="btn btn-outline">Save changes</button> -->
        </div>
    </div>
</div>
