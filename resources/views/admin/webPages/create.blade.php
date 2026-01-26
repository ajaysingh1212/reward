@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.webPage.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.web-pages.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="title">{{ trans('cruds.webPage.fields.title') }}</label>
                <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text" name="title" id="title" value="{{ old('title', '') }}">
                @if($errors->has('title'))
                    <div class="invalid-feedback">
                        {{ $errors->first('title') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.webPage.fields.title_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="logo">{{ trans('cruds.webPage.fields.logo') }}</label>
                <div class="needsclick dropzone {{ $errors->has('logo') ? 'is-invalid' : '' }}" id="logo-dropzone">
                </div>
                @if($errors->has('logo'))
                    <div class="invalid-feedback">
                        {{ $errors->first('logo') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.webPage.fields.logo_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="banner_1">{{ trans('cruds.webPage.fields.banner_1') }}</label>
                <div class="needsclick dropzone {{ $errors->has('banner_1') ? 'is-invalid' : '' }}" id="banner_1-dropzone">
                </div>
                @if($errors->has('banner_1'))
                    <div class="invalid-feedback">
                        {{ $errors->first('banner_1') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.webPage.fields.banner_1_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="banner_2">{{ trans('cruds.webPage.fields.banner_2') }}</label>
                <div class="needsclick dropzone {{ $errors->has('banner_2') ? 'is-invalid' : '' }}" id="banner_2-dropzone">
                </div>
                @if($errors->has('banner_2'))
                    <div class="invalid-feedback">
                        {{ $errors->first('banner_2') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.webPage.fields.banner_2_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="banner_3">{{ trans('cruds.webPage.fields.banner_3') }}</label>
                <div class="needsclick dropzone {{ $errors->has('banner_3') ? 'is-invalid' : '' }}" id="banner_3-dropzone">
                </div>
                @if($errors->has('banner_3'))
                    <div class="invalid-feedback">
                        {{ $errors->first('banner_3') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.webPage.fields.banner_3_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="about_image">{{ trans('cruds.webPage.fields.about_image') }}</label>
                <div class="needsclick dropzone {{ $errors->has('about_image') ? 'is-invalid' : '' }}" id="about_image-dropzone">
                </div>
                @if($errors->has('about_image'))
                    <div class="invalid-feedback">
                        {{ $errors->first('about_image') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.webPage.fields.about_image_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="about_content">{{ trans('cruds.webPage.fields.about_content') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('about_content') ? 'is-invalid' : '' }}" name="about_content" id="about_content">{!! old('about_content') !!}</textarea>
                @if($errors->has('about_content'))
                    <div class="invalid-feedback">
                        {{ $errors->first('about_content') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.webPage.fields.about_content_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="mission">{{ trans('cruds.webPage.fields.mission') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('mission') ? 'is-invalid' : '' }}" name="mission" id="mission">{!! old('mission') !!}</textarea>
                @if($errors->has('mission'))
                    <div class="invalid-feedback">
                        {{ $errors->first('mission') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.webPage.fields.mission_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="vision">{{ trans('cruds.webPage.fields.vision') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('vision') ? 'is-invalid' : '' }}" name="vision" id="vision">{!! old('vision') !!}</textarea>
                @if($errors->has('vision'))
                    <div class="invalid-feedback">
                        {{ $errors->first('vision') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.webPage.fields.vision_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="value">{{ trans('cruds.webPage.fields.value') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('value') ? 'is-invalid' : '' }}" name="value" id="value">{!! old('value') !!}</textarea>
                @if($errors->has('value'))
                    <div class="invalid-feedback">
                        {{ $errors->first('value') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.webPage.fields.value_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="disclimer">{{ trans('cruds.webPage.fields.disclimer') }}</label>
                <textarea class="form-control {{ $errors->has('disclimer') ? 'is-invalid' : '' }}" name="disclimer" id="disclimer">{{ old('disclimer') }}</textarea>
                @if($errors->has('disclimer'))
                    <div class="invalid-feedback">
                        {{ $errors->first('disclimer') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.webPage.fields.disclimer_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="notes">{{ trans('cruds.webPage.fields.notes') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('notes') ? 'is-invalid' : '' }}" name="notes" id="notes">{!! old('notes') !!}</textarea>
                @if($errors->has('notes'))
                    <div class="invalid-feedback">
                        {{ $errors->first('notes') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.webPage.fields.notes_helper') }}</span>
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
    Dropzone.options.logoDropzone = {
    url: '{{ route('admin.web-pages.storeMedia') }}',
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
      $('form').find('input[name="logo"]').remove()
      $('form').append('<input type="hidden" name="logo" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="logo"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($webPage) && $webPage->logo)
      var file = {!! json_encode($webPage->logo) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="logo" value="' + file.file_name + '">')
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
    Dropzone.options.banner1Dropzone = {
    url: '{{ route('admin.web-pages.storeMedia') }}',
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
      $('form').find('input[name="banner_1"]').remove()
      $('form').append('<input type="hidden" name="banner_1" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="banner_1"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($webPage) && $webPage->banner_1)
      var file = {!! json_encode($webPage->banner_1) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="banner_1" value="' + file.file_name + '">')
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
    Dropzone.options.banner2Dropzone = {
    url: '{{ route('admin.web-pages.storeMedia') }}',
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
      $('form').find('input[name="banner_2"]').remove()
      $('form').append('<input type="hidden" name="banner_2" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="banner_2"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($webPage) && $webPage->banner_2)
      var file = {!! json_encode($webPage->banner_2) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="banner_2" value="' + file.file_name + '">')
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
    Dropzone.options.banner3Dropzone = {
    url: '{{ route('admin.web-pages.storeMedia') }}',
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
      $('form').find('input[name="banner_3"]').remove()
      $('form').append('<input type="hidden" name="banner_3" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="banner_3"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($webPage) && $webPage->banner_3)
      var file = {!! json_encode($webPage->banner_3) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="banner_3" value="' + file.file_name + '">')
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
    Dropzone.options.aboutImageDropzone = {
    url: '{{ route('admin.web-pages.storeMedia') }}',
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
      $('form').find('input[name="about_image"]').remove()
      $('form').append('<input type="hidden" name="about_image" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="about_image"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($webPage) && $webPage->about_image)
      var file = {!! json_encode($webPage->about_image) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="about_image" value="' + file.file_name + '">')
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
    $(document).ready(function () {
  function SimpleUploadAdapter(editor) {
    editor.plugins.get('FileRepository').createUploadAdapter = function(loader) {
      return {
        upload: function() {
          return loader.file
            .then(function (file) {
              return new Promise(function(resolve, reject) {
                // Init request
                var xhr = new XMLHttpRequest();
                xhr.open('POST', '{{ route('admin.web-pages.storeCKEditorImages') }}', true);
                xhr.setRequestHeader('x-csrf-token', window._token);
                xhr.setRequestHeader('Accept', 'application/json');
                xhr.responseType = 'json';

                // Init listeners
                var genericErrorText = `Couldn't upload file: ${ file.name }.`;
                xhr.addEventListener('error', function() { reject(genericErrorText) });
                xhr.addEventListener('abort', function() { reject() });
                xhr.addEventListener('load', function() {
                  var response = xhr.response;

                  if (!response || xhr.status !== 201) {
                    return reject(response && response.message ? `${genericErrorText}\n${xhr.status} ${response.message}` : `${genericErrorText}\n ${xhr.status} ${xhr.statusText}`);
                  }

                  $('form').append('<input type="hidden" name="ck-media[]" value="' + response.id + '">');

                  resolve({ default: response.url });
                });

                if (xhr.upload) {
                  xhr.upload.addEventListener('progress', function(e) {
                    if (e.lengthComputable) {
                      loader.uploadTotal = e.total;
                      loader.uploaded = e.loaded;
                    }
                  });
                }

                // Send request
                var data = new FormData();
                data.append('upload', file);
                data.append('crud_id', '{{ $webPage->id ?? 0 }}');
                xhr.send(data);
              });
            })
        }
      };
    }
  }

  var allEditors = document.querySelectorAll('.ckeditor');
  for (var i = 0; i < allEditors.length; ++i) {
    ClassicEditor.create(
      allEditors[i], {
        extraPlugins: [SimpleUploadAdapter]
      }
    );
  }
});
</script>

@endsection