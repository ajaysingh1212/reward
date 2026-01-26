@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.winner.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.winners.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="cupon_numbers">{{ trans('cruds.winner.fields.cupon_number') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('cupon_numbers') ? 'is-invalid' : '' }}" name="cupon_numbers[]" id="cupon_numbers" multiple required>
                    @foreach($cupon_numbers as $id => $cupon_number)
                        <option value="{{ $id }}" {{ in_array($id, old('cupon_numbers', [])) ? 'selected' : '' }}>{{ $cupon_number }}</option>
                    @endforeach
                </select>
                @if($errors->has('cupon_numbers'))
                    <div class="invalid-feedback">
                        {{ $errors->first('cupon_numbers') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.winner.fields.cupon_number_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="full_name">{{ trans('cruds.winner.fields.full_name') }}</label>
                <input class="form-control {{ $errors->has('full_name') ? 'is-invalid' : '' }}" type="text" name="full_name" id="full_name" value="{{ old('full_name', '') }}" required>
                @if($errors->has('full_name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('full_name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.winner.fields.full_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="phone_number">{{ trans('cruds.winner.fields.phone_number') }}</label>
                <input class="form-control {{ $errors->has('phone_number') ? 'is-invalid' : '' }}" type="text" name="phone_number" id="phone_number" value="{{ old('phone_number', '') }}" required>
                @if($errors->has('phone_number'))
                    <div class="invalid-feedback">
                        {{ $errors->first('phone_number') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.winner.fields.phone_number_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="email">{{ trans('cruds.winner.fields.email') }}</label>
                <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="email" name="email" id="email" value="{{ old('email') }}">
                @if($errors->has('email'))
                    <div class="invalid-feedback">
                        {{ $errors->first('email') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.winner.fields.email_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="upi">{{ trans('cruds.winner.fields.upi') }}</label>
                <input class="form-control {{ $errors->has('upi') ? 'is-invalid' : '' }}" type="text" name="upi" id="upi" value="{{ old('upi', '') }}" required>
                @if($errors->has('upi'))
                    <div class="invalid-feedback">
                        {{ $errors->first('upi') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.winner.fields.upi_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="product_name">{{ trans('cruds.winner.fields.product_name') }}</label>
                <input class="form-control {{ $errors->has('product_name') ? 'is-invalid' : '' }}" type="text" name="product_name" id="product_name" value="{{ old('product_name', '') }}">
                @if($errors->has('product_name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('product_name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.winner.fields.product_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="customer_photo">{{ trans('cruds.winner.fields.customer_photo') }}</label>
                <div class="needsclick dropzone {{ $errors->has('customer_photo') ? 'is-invalid' : '' }}" id="customer_photo-dropzone">
                </div>
                @if($errors->has('customer_photo'))
                    <div class="invalid-feedback">
                        {{ $errors->first('customer_photo') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.winner.fields.customer_photo_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="product_photo">{{ trans('cruds.winner.fields.product_photo') }}</label>
                <div class="needsclick dropzone {{ $errors->has('product_photo') ? 'is-invalid' : '' }}" id="product_photo-dropzone">
                </div>
                @if($errors->has('product_photo'))
                    <div class="invalid-feedback">
                        {{ $errors->first('product_photo') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.winner.fields.product_photo_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection

@section('scripts')
<script>
    Dropzone.options.customerPhotoDropzone = {
    url: '{{ route('admin.winners.storeMedia') }}',
    maxFilesize: 20, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 20,
      width: 4096,
      height: 4096
    },
    success: function (file, response) {
      $('form').find('input[name="customer_photo"]').remove()
      $('form').append('<input type="hidden" name="customer_photo" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="customer_photo"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($winner) && $winner->customer_photo)
      var file = {!! json_encode($winner->customer_photo) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="customer_photo" value="' + file.file_name + '">')
      this.options.maxFiles = this.options.maxFiles - 1
@endif
    },
    error: function (file, response) {
        if ($.type(response) === 'string') {
            var message = response //dropzone sends it's own error messages in string
        } else {
            var message = response.errors.file
        }
        file.previewElement.classList.add('dz-error')
        _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
        _results = []
        for (_i = 0, _len = _ref.length; _i < _len; _i++) {
            node = _ref[_i]
            _results.push(node.textContent = message)
        }

        return _results
    }
}

</script>
<script>
    var uploadedProductPhotoMap = {}
Dropzone.options.productPhotoDropzone = {
    url: '{{ route('admin.winners.storeMedia') }}',
    maxFilesize: 20, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 20,
      width: 4096,
      height: 4096
    },
    success: function (file, response) {
      $('form').append('<input type="hidden" name="product_photo[]" value="' + response.name + '">')
      uploadedProductPhotoMap[file.name] = response.name
    },
    removedfile: function (file) {
      console.log(file)
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedProductPhotoMap[file.name]
      }
      $('form').find('input[name="product_photo[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($winner) && $winner->product_photo)
      var files = {!! json_encode($winner->product_photo) !!}
          for (var i in files) {
          var file = files[i]
          this.options.addedfile.call(this, file)
          this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
          file.previewElement.classList.add('dz-complete')
          $('form').append('<input type="hidden" name="product_photo[]" value="' + file.file_name + '">')
        }
@endif
    },
     error: function (file, response) {
         if ($.type(response) === 'string') {
             var message = response //dropzone sends it's own error messages in string
         } else {
             var message = response.errors.file
         }
         file.previewElement.classList.add('dz-error')
         _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
         _results = []
         for (_i = 0, _len = _ref.length; _i < _len; _i++) {
             node = _ref[_i]
             _results.push(node.textContent = message)
         }

         return _results
     }
}

</script>
@endsection