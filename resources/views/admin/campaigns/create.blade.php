@extends('layouts.admin')
@section('content')

<style>
    .dark-card {
        background: linear-gradient(145deg, #1e1e2f, #151521);
        border-radius: 16px;
        border: none;
        box-shadow: 0 20px 40px rgba(0,0,0,0.4);
        animation: fadeSlide 0.7s ease-in-out;
        color: #fff;
    }

    @keyframes fadeSlide {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .dark-card .card-header {
        background: transparent;
        border-bottom: 1px solid rgba(255,255,255,0.1);
        font-size: 1.2rem;
        font-weight: 600;
        letter-spacing: 0.5px;
        padding: 20px 25px;
    }

    .dark-card label {
        color: #cfd3ff;
        font-weight: 500;
    }

    .dark-card .form-control {
        background-color: #0f0f1a;
        border: 1px solid #2e2e4d;
        color: #fff;
        border-radius: 10px;
        transition: all 0.3s ease;
    }

    .dark-card .form-control:focus {
        background-color: #0f0f1a;
        border-color: #6c63ff;
        box-shadow: 0 0 0 0.15rem rgba(108, 99, 255, 0.25);
        color: #fff;
    }

    .dark-card .help-block {
        color: #8b8fd8;
        font-size: 0.85rem;
    }

    .dark-card .btn-save {
        background: linear-gradient(135deg, #6c63ff, #5146d9);
        border: none;
        padding: 10px 30px;
        font-weight: 600;
        border-radius: 30px;
        transition: all 0.3s ease;
    }

    .dark-card .btn-save:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 20px rgba(108,99,255,0.4);
    }

    .is-invalid {
        border-color: #ff4d4f !important;
    }

    .invalid-feedback {
        color: #ff8080;
    }
</style>

<div class="card dark-card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.campaign.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route('admin.campaigns.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="row">
                <div class="col-md-6 form-group">
                    <label class="required" for="camp_name">
                        {{ trans('cruds.campaign.fields.camp_name') }}
                    </label>
                    <input class="form-control {{ $errors->has('camp_name') ? 'is-invalid' : '' }}"
                           type="text"
                           name="camp_name"
                           id="camp_name"
                           value="{{ old('camp_name', '') }}"
                           required>
                    @if($errors->has('camp_name'))
                        <div class="invalid-feedback">
                            {{ $errors->first('camp_name') }}
                        </div>
                    @endif
                    <span class="help-block">
                        {{ trans('cruds.campaign.fields.camp_name_helper') }}
                    </span>
                </div>

                <div class="col-md-6 form-group">
                    <label for="status">
                        {{ trans('cruds.campaign.fields.status') }}
                    </label>
                    <select class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}"
                            name="status"
                            id="status">
                        <option value disabled {{ old('status', null) === null ? 'selected' : '' }}>
                            {{ trans('global.pleaseSelect') }}
                        </option>
                        @foreach(App\Models\Campaign::STATUS_SELECT as $key => $label)
                            <option value="{{ $key }}"
                                {{ old('status', 'active') === (string) $key ? 'selected' : '' }}>
                                {{ $label }}
                            </option>
                        @endforeach
                    </select>
                    @if($errors->has('status'))
                        <div class="invalid-feedback">
                            {{ $errors->first('status') }}
                        </div>
                    @endif
                    <span class="help-block">
                        {{ trans('cruds.campaign.fields.status_helper') }}
                    </span>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 form-group">
                    <label class="required" for="start_date">
                        {{ trans('cruds.campaign.fields.start_date') }}
                    </label>
                    <input class="form-control date {{ $errors->has('start_date') ? 'is-invalid' : '' }}"
                           type="text"
                           name="start_date"
                           id="start_date"
                           value="{{ old('start_date') }}"
                           required>
                    @if($errors->has('start_date'))
                        <div class="invalid-feedback">
                            {{ $errors->first('start_date') }}
                        </div>
                    @endif
                    <span class="help-block">
                        {{ trans('cruds.campaign.fields.start_date_helper') }}
                    </span>
                </div>

                <div class="col-md-6 form-group">
                    <label class="required" for="end_date">
                        {{ trans('cruds.campaign.fields.end_date') }}
                    </label>
                    <input class="form-control date {{ $errors->has('end_date') ? 'is-invalid' : '' }}"
                           type="text"
                           name="end_date"
                           id="end_date"
                           value="{{ old('end_date') }}"
                           required>
                    @if($errors->has('end_date'))
                        <div class="invalid-feedback">
                            {{ $errors->first('end_date') }}
                        </div>
                    @endif
                    <span class="help-block">
                        {{ trans('cruds.campaign.fields.end_date_helper') }}
                    </span>
                </div>
            </div>

            <div class="form-group text-right mt-4">
                <button class="btn btn-save" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>

@endsection
