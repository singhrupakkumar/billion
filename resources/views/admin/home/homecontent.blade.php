@extends('layouts.admin')
@section('content')

<section class="content-header">
    <h1>Edit Home Data</h1>
</section>

<section class="content">
    <div class="row">  
        <div class="col-md-8">   
            @if(Session::has('error'))
                <div class="alert alert-danger">{{ Session::get('error') }}</div>
            @endif
  
                <form role="form" class="contact-form" id="nanny-add" method="post" action="{{route('admin.homecontent')}}" enctype="multipart/form-data">
                    {{ csrf_field() }}
 
                        @php
                        $fieldss = App\Home::fields();
                        @endphp 

                        @foreach($fieldss as $key => $fields)
                        <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">{{ $key }}</h3>
                        </div>
                        <div class="box-body">
                        @foreach($fields as $field)
                        @if($field['type'] == 'file')
                        <div class="form-group">
                            <label for="{{ $field['label'] }}" class="control-label">{{ $field['label'] }}</label>
                            <input type="{{ $field['type'] }}" name="{{ $field['name'] }}" class="form-control upload">
                            @if(App\Home::get_field($field['name']) != '')
                                <img src="{{ url('/') }}/images/config/{{ App\Home::get_field($field['name']) }}" class="previewHolder" width="200">
                            @else
                                <img src="{{ url('/') }}/images/noimage.svg" class="previewHolder" width="200">  
                            @endif
                        </div>
                        @endif

                        @if($field['type'] == 'text')
                        <div class="form-group">
                            <label for="{{ $field['label'] }}" class="control-label">{{ $field['label'] }}</label> <small> {{ isset($field['alert']) ? ' ('.$type['alert'].')' : '' }}</small>
                            <input type="{{ $field['type'] }}" name="{{ $field['name'] }}" placeholder="{{ $field['placeholder'] }}" class="form-control" value="{{ App\Home::get_field($field['name']) }}">
                        </div> 
                        @endif

                        @if($field['type'] == 'number')
                        <div class="form-group">    
                            <label for="{{ $field['label'] }}" class="control-label">{{ $field['label'] }}</label> <small> {{ isset($field['alert']) ? ' ('.$type['alert'].')' : '' }}</small>
                            <input type="{{ $field['type'] }}" min="1" step="0.1" name="{{ $field['name'] }}" placeholder="{{ $field['placeholder'] }}" class="form-control" value="{{ App\Home::get_field($field['name']) }}">
                        </div>  
                        @endif


                        @if($field['type'] == 'textarea')
                        <div class="form-group">
                            <label for="{{ $field['label'] }}" class="control-label">{{ $field['label'] }}</label> <small> {{ isset($field['alert']) ? ' ('.$type['alert'].')' : '' }}</small>
                            <textarea type="{{ $field['type'] }}" name="{{ $field['name'] }}" class="form-control textarea">{{ App\Home::get_field($field['name']) }}</textarea>
                        </div>
                        @endif

                        @if($field['type'] == 'select')
                        <div class="form-group">
                            <label for="{{ $field['label'] }}" class="control-label">{{ $field['label'] }}</label>
                            <select class="form-control" name="{{ $field['name'] }}">
                                @foreach($field['options'] as $key => $value)
                                <option value="{{ $key }}" {{ App\Home::get_field($field['name']) == $key ? 'selected' : '' }}>{{ $value }}</option>
                                @endforeach
                            </select>
                        </div>
                        @endif
                        @endforeach
                        </div>
                        </div>
                        @endforeach

            <div class="box box-primary">  
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <button type="submit" class="btn btn-info">Submit</button> 
                    </div>
                </form>
            </div>
            <!-- /.box -->
        </div>
        <!-- /.box -->
    </div>
</section>    
<script>
function readURL(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    reader.onload = function(e) {
      $(input).next('.previewHolder').attr('src', e.target.result);
    }
    reader.readAsDataURL(input.files[0]);
  }
}
$(".upload").change(function() {
  readURL(this);
});
</script>

@endsection