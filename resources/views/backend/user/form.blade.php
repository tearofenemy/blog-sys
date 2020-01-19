<div class="col-xs-9">
    <div class="box">
    <!-- /.box-header -->
        <div class="box-body">
            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                {!! Form::label('Name') !!}
                {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Input name']) !!}

                @if ($errors->has('name'))
                    <span class="help-block">{{ $errors->first('name') }}</span>
                @endif
            </div>

            <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                {!! Form::label('email') !!}
                {!! Form::text('email', null, ['class' => 'form-control', 'placeholder' => 'Input email']) !!}

                @if ($errors->has('email'))
                    <span class="help-block">{{ $errors->first('email') }}</span>
                @endif
            </div>

            <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                {!! Form::label('password') !!}
                {!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'Input password']) !!}

                @if ($errors->has('password'))
                    <span class="help-block">{{ $errors->first('password') }}</span>
                @endif
            </div>

            <div class="form-group {{ $errors->has('password_confirmation') ? 'has-error' : '' }}">
                {!! Form::label('password_confirmation') !!}
                {!! Form::password('password_confirmation', ['class' => 'form-control', 'placeholder' => 'Confirm Password']) !!}

                @if ($errors->has('password_confirmation'))
                    <span class="help-block">{{ $errors->first('password_confirmation') }}</span>
                @endif
            </div>

             <div class="form-group {{ $errors->has('role') ? 'has-error' : '' }}">
                {!! Form::label('role') !!}

                @if ($user->exists && $user->id == config('cms.default_user_id'))
                    <p class="form-control-static">{{ $user->roles->first()->display_name }}</p>
                @else
                    {!! Form::select('role', App\Role::pluck('display_name', 'id'), $user->exists ? $user->roles->first()->id : null, ['class' => 'form-control', 'placeholder' => 'Choose role']) !!}
                @endif

                @if ($errors->has('role'))
                    <span class="help-block">{{ $errors->first('role') }}</span>
                @endif
            </div>
        </div>
        <div class="box-footer clearfix">
            <div class="pull-left">
                <button type="submit" name="button" class="btn btn-primary">{{$user->exists ? 'Update' : 'Create'}}</button>
                <a class="btn btn-default" href="{{ route('backend.user.index') }}">Cancel</a>
            </div>
        </div>
    </div>
</div>
