@extends('layouts.admin')
@section('content')

<style>
    .dark-card {
        background: linear-gradient(145deg, #1e1e2f, #141421);
        border-radius: 16px;
        border: none;
        box-shadow: 0 20px 40px rgba(0,0,0,0.45);
        animation: fadeSlide 0.7s ease-in-out;
        color: #ffffff;
    }

    @keyframes fadeSlide {
        from { opacity: 0; transform: translateY(25px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .dark-card .card-header {
        background: transparent;
        border-bottom: 1px solid rgba(255,255,255,0.1);
        font-size: 1.2rem;
        font-weight: 600;
        padding: 20px 25px;
    }

    .dark-card label {
        color: #cfd3ff;
        font-weight: 500;
    }

    .dark-card .form-control,
    .dark-card .select2-container--default .select2-selection--multiple {
        background-color: #0f0f1a;
        border: 1px solid #2d2d4f;
        color: #fff;
        border-radius: 10px;
    }

    .select2-container--default .select2-selection--multiple .select2-selection__choice {
        background: #6c63ff;
        border: none;
        color: #fff;
        border-radius: 20px;
        padding: 2px 10px;
    }

    .help-block {
        color: #8b8fd8;
        font-size: 0.85rem;
    }

    .btn-save {
        background: linear-gradient(135deg, #6c63ff, #5146d9);
        border: none;
        padding: 10px 36px;
        font-weight: 600;
        border-radius: 30px;
        transition: 0.3s;
    }

    .btn-save:hover {
        transform: translateY(-2px);
        box-shadow: 0 12px 22px rgba(108,99,255,0.45);
    }

    .dark-dropzone {
        background: #0f0f1a;
        border: 2px dashed #6c63ff;
        border-radius: 14px;
        padding: 30px;
        text-align: center;
        transition: 0.3s;
    }

    .dark-dropzone:hover {
        background: rgba(108,99,255,0.08);
    }

    .dark-dropzone .dz-message {
        color: #cfd3ff;
        font-weight: 500;
    }
</style>

<div class="card dark-card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.winner.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST"
              action="{{ route('admin.winners.update', [$winner->id]) }}"
              enctype="multipart/form-data">
            @method('PUT')
            @csrf

            {{-- 🔹 ROW 1 (3 INPUTS) --}}
            <div class="row">
                <div class="col-md-4 form-group">
                    <label class="required">{{ trans('cruds.winner.fields.cupon_number') }}</label>
                    <div class="mb-2">
                        <span class="btn btn-info btn-xs select-all">{{ trans('global.select_all') }}</span>
                        <span class="btn btn-info btn-xs deselect-all">{{ trans('global.deselect_all') }}</span>
                    </div>
                    <select class="form-control select2 {{ $errors->has('cupon_numbers') ? 'is-invalid' : '' }}"
                            name="cupon_numbers[]" multiple required>
                        @foreach($cupon_numbers as $id => $cupon_number)
                            <option value="{{ $id }}"
                                {{ (in_array($id, old('cupon_numbers', [])) || $winner->cupon_numbers->contains($id)) ? 'selected' : '' }}>
                                {{ $cupon_number }}
                            </option>
                        @endforeach
                    </select>
                    <span class="help-block">{{ trans('cruds.winner.fields.cupon_number_helper') }}</span>
                </div>

                <div class="col-md-4 form-group">
                    <label class="required">{{ trans('cruds.winner.fields.full_name') }}</label>
                    <input class="form-control" type="text" name="full_name"
                           value="{{ old('full_name', $winner->full_name) }}" required>
                </div>

                <div class="col-md-4 form-group">
                    <label class="required">{{ trans('cruds.winner.fields.phone_number') }}</label>
                    <input class="form-control" type="text" name="phone_number"
                           value="{{ old('phone_number', $winner->phone_number) }}" required>
                </div>
            </div>

            {{-- 🔹 ROW 2 (3 INPUTS) --}}
            <div class="row">
                <div class="col-md-4 form-group">
                    <label>{{ trans('cruds.winner.fields.email') }}</label>
                    <input class="form-control" type="email" name="email"
                           value="{{ old('email', $winner->email) }}">
                </div>

                <div class="col-md-4 form-group">
                    <label class="required">{{ trans('cruds.winner.fields.upi') }}</label>
                    <input class="form-control" type="text" name="upi"
                           value="{{ old('upi', $winner->upi) }}" required>
                </div>

                <div class="col-md-4 form-group">
                    <label>{{ trans('cruds.winner.fields.product_name') }}</label>
                    <input class="form-control" type="text" name="product_name"
                           value="{{ old('product_name', $winner->product_name) }}">
                </div>
            </div>
            {{-- 🔹 NEW STATUS & REMARKS ROW --}}
            <div class="row">
                <div class="col-md-4 form-group">
                    <label class="required">Status</label>
                    <select class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}"
                            name="status" required>
                        @php
                            $statuses = [
                                'pending' => 'Pending',
                                'processing' => 'Processing',
                                'verifying' => 'Verifying',
                                'send_to_bank' => 'Send To Bank',
                                'rejected' => 'Rejected',
                                'disapproved' => 'Disapproved',
                                'approved' => 'Approved',
                                'successed' => 'Successed',
                            ];
                        @endphp

                        @foreach($statuses as $key => $label)
                            <option value="{{ $key }}"
                                {{ old('status', $winner->status ?? '') === $key ? 'selected' : '' }}>
                                {{ $label }}
                            </option>
                        @endforeach
                    </select>

                    @if($errors->has('status'))
                        <div class="invalid-feedback">
                            {{ $errors->first('status') }}
                        </div>
                    @endif
                </div>

                <div class="col-md-8 form-group">
                    <label>Remarks / Notes</label>
                    <textarea class="form-control {{ $errors->has('remarks') ? 'is-invalid' : '' }}"
                            name="remarks"
                            rows="4"
                            placeholder="Write remarks or reason here...">{{ old('remarks', $winner->remarks ?? '') }}</textarea>

                    @if($errors->has('remarks'))
                        <div class="invalid-feedback">
                            {{ $errors->first('remarks') }}
                        </div>
                    @endif
                </div>
            </div>

            {{-- 🔹 ROW 3 (DROPZONES) --}}
            <div class="row">
                <div class="col-md-6 form-group">
                    <label>{{ trans('cruds.winner.fields.customer_photo') }}</label>
                    <div class="needsclick dropzone dark-dropzone" id="customer_photo-dropzone"></div>
                    <span class="help-block">{{ trans('cruds.winner.fields.customer_photo_helper') }}</span>
                </div>

                <div class="col-md-6 form-group">
                    <label>{{ trans('cruds.winner.fields.product_photo') }}</label>
                    <div class="needsclick dropzone dark-dropzone" id="product_photo-dropzone"></div>
                    <span class="help-block">{{ trans('cruds.winner.fields.product_photo_helper') }}</span>
                </div>
            </div>

            <div class="text-right mt-4">
                <button class="btn btn-save" type="submit">
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
        maxFilesize: 20,
        acceptedFiles: '.jpeg,.jpg,.png,.gif',
        maxFiles: 1,
        addRemoveLinks: true,
        headers: { 'X-CSRF-TOKEN': "{{ csrf_token() }}" },
        params: { size: 20, width: 4096, height: 4096 },
        success: function (file, response) {
            $('form').find('input[name="customer_photo"]').remove()
            $('form').append('<input type="hidden" name="customer_photo" value="' + response.name + '">')
        },
        removedfile: function (file) {
            file.previewElement.remove()
            if (file.status !== 'error') {
                $('form').find('input[name="customer_photo"]').remove()
                this.options.maxFiles++
            }
        },
        init: function () {
@if(isset($winner) && $winner->customer_photo)
            var file = {!! json_encode($winner->customer_photo) !!}
            this.options.addedfile.call(this, file)
            this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
            file.previewElement.classList.add('dz-complete')
            $('form').append('<input type="hidden" name="customer_photo" value="' + file.file_name + '">')
            this.options.maxFiles--
@endif
        }
    }
</script>

<script>
    var uploadedProductPhotoMap = {}
    Dropzone.options.productPhotoDropzone = {
        url: '{{ route('admin.winners.storeMedia') }}',
        maxFilesize: 20,
        acceptedFiles: '.jpeg,.jpg,.png,.gif',
        addRemoveLinks: true,
        headers: { 'X-CSRF-TOKEN': "{{ csrf_token() }}" },
        params: { size: 20, width: 4096, height: 4096 },
        success: function (file, response) {
            $('form').append('<input type="hidden" name="product_photo[]" value="' + response.name + '">')
            uploadedProductPhotoMap[file.name] = response.name
        },
        removedfile: function (file) {
            file.previewElement.remove()
            var name = uploadedProductPhotoMap[file.name]
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
        }
    }
</script>
@endsection
