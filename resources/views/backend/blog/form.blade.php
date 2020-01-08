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

            <div class="form-group {{ $errors->has('excerpt') ? 'has-error' : '' }}">
                {!! Form::label('excerpt') !!}
                {!! Form::textarea('excerpt', null, ['class' => 'form-control', 'placeholder' => 'Input excerpt']) !!}

                @if ($errors->has('excerpt'))
                    <span class="help-block">{{ $errors->first('excerpt') }}</span>
                @endif
            </div>

            <div class="form-group {{ $errors->has('body') ? 'has-error' : '' }}">
                {!! Form::label('body') !!}
                {!! Form::textarea('body', null, ['class' => 'form-control', 'placeholder' => 'Input body']) !!}

                @if ($errors->has('body'))
                    <span class="help-block">{{ $errors->first('body') }}</span>
                @endif
            </div>
        </div>
    <!-- /.box-body -->
    </div>
    <!-- /.box -->
</div>
<div class="col-xs-3">
    <!-- published_at widget -->
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Publish</h3>
        </div>
        <div class="box-body">
            <div class="form-group {{ $errors->has('published_at') ? 'has-error' : '' }}">
                {!! Form::label('published_at', 'Publish Date') !!}
                <div class="input-group" id='datetimepicker1' data="published_at">
                    {!! Form::text('published_at', null, ['class' => 'form-control', 'placeholder' => 'Y-m-d H:i:s']) !!}
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
                @if ($errors->has('published_at'))
                    <span class="help-block">{{ $errors->first('published_at') }}</span>
                @endif
            </div>
        </div>
        <div class="box-footer clearfix">
            <div class="pull-left">
                <a id="draft-btn" class="btn btn-default">Save Draft</a>
            </div>
            <div class="pull-right">
                <div class="form-group">
                    {!! Form::submit('Publish', ['class' => 'btn btn-primary']) !!}
                </div>
            </div>
        </div>
    </div>
    <!-- end published_at widget -->

    <!-- category widget -->
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Category</h3>
        </div>
        <div class="box-body">
            <div class="form-group {{ $errors->has('category_id') ? 'has-error' : '' }}">
                {!! Form::select('category_id', App\Category::pluck('title', 'id'), null, ['class' => 'form-control','placeholder' => 'Select category']) !!}

                @if ($errors->has('category_id'))
                    <span class="help-block">{{ $errors->first('category_id') }}</span>
                @endif
            </div>
        </div>
    </div>
    <!-- end category widget -->

    <!-- img widget -->
    <div class="box">
        <div class="box-header with-border">
            <div class="box-title">Post Image</div>
        </div>
        <div class="box-body text-center">
            <div class="form-group {{ $errors->has('img') ? 'has-error' : '' }}">
                <div class="fileinput fileinput-new" data-provides="fileinput">
                    <div class="fileinput-new img-thumbnail" style="width: 200px; height: 150px;">
                        <img src="{{ ($post->img_thumb_url) ? $post->img_thumb_url : 'http://via.placeholder.com/200x150?text=250X150' }}"  alt="...">
                    </div>
                    <div class="fileinput-preview fileinput-exists img-thumbnail" style="max-width: 200px; max-height: 150px;"></div>
                    <div>
                        <br><span class="btn btn-primary btn-file"><span class="fileinput-new">Select image</span><span class="fileinput-exists">Change</span>{!! Form::file('img') !!}</span>
                        <a href="#" class="btn btn-danger fileinput-exists" data-dismiss="fileinput">Remove</a>
                    </div>
                </div>

                @if ($errors->has('img'))
                    <span class="help-block">{{ $errors->first('img') }}</span>
                @endif
            </div>
        </div>
    </div>
    <!-- end img widget -->
</div>
