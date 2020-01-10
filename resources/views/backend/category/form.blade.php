<div class="col-xs-9">
    <div class="box">
    <!-- /.box-header -->
        <div class="box-body">
            <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                {!! Form::label('title') !!}
                {!! Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Input title']) !!}

                @if ($errors->has('title'))
                    <span class="help-block">{{ $errors->first('title') }}</span>
                @endif
            </div>

            <div class="form-group {{ $errors->has('slug') ? 'has-error' : '' }}">
                {!! Form::label('slug') !!}
                {!! Form::text('slug', null, ['class' => 'form-control', 'placeholder' => 'Input slug']) !!}

                @if ($errors->has('slug'))
                    <span class="help-block">{{ $errors->first('slug') }}</span>
                @endif
            </div>
        </div>
        <div class="box-footer clearfix">
            <div class="pull-left">
                <button type="submit" name="button" class="btn btn-primary">{{$category->exists ? 'Update' : 'Create'}}</button>
                <a class="btn btn-default" href="{{ route('backend.category.index') }}">Cancel</a>
            </div>
        </div>
    </div>
</div>
