    <div class="form-group">
        <input required="required" value="{{ old('title') }}" placeholder="Enter title here" type="text" name = "title"class="form-control" />
    </div>
    <div class="form-group">
        <textarea required="required" name='content' class="form-control">{{ old('content') }}</textarea>
    </div>
    <input type="submit" name='create' class="btn btn-success" value = "{{trans('base.form-submit-add')}}"/>