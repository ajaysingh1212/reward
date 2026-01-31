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
        from {
            opacity: 0;
            transform: translateY(25px);
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
        padding: 20px 25px;
        letter-spacing: 0.4px;
    }

    .dark-card label {
        color: #cfd3ff;
        font-weight: 500;
    }

    .dark-card .form-control {
        background-color: #0f0f1a;
        border: 1px solid #2d2d4f;
        color: #ffffff;
        border-radius: 10px;
        transition: all 0.3s ease;
    }

    .dark-card .form-control:focus {
        background-color: #0f0f1a;
        border-color: #6c63ff;
        box-shadow: 0 0 0 0.15rem rgba(108, 99, 255, 0.3);
        color: #ffffff;
    }

    .dark-card .help-block {
        color: #8b8fd8;
        font-size: 0.85rem;
    }

    .btn-save {
        background: linear-gradient(135deg, #6c63ff, #5146d9);
        border: none;
        padding: 10px 36px;
        font-weight: 600;
        border-radius: 30px;
        transition: all 0.3s ease;
    }

    .btn-save:hover {
        transform: translateY(-2px);
        box-shadow: 0 12px 22px rgba(108,99,255,0.45);
    }

    .is-invalid {
        border-color: #ff4d4f !important;
    }

    .invalid-feedback {
        color: #ff9a9a;
    }
</style>

<div class="card dark-card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.rowData.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route('admin.row-datas.store') }}" enctype="multipart/form-data">
            @csrf

            {{-- 🔹 FIRST ROW (3 INPUTS) --}}
            <div class="row">
                <div class="col-md-4 form-group">
                    <label class="required" for="unique_code">
                        {{ trans('cruds.rowData.fields.unique_code') }}
                    </label>
                    <input class="form-control {{ $errors->has('unique_code') ? 'is-invalid' : '' }}"
                           type="text"
                           name="unique_code"
                           id="unique_code"
                           value="{{ old('unique_code') }}"
                           required>
                    @if($errors->has('unique_code'))
                        <div class="invalid-feedback">{{ $errors->first('unique_code') }}</div>
                    @endif
                    <span class="help-block">{{ trans('cruds.rowData.fields.unique_code_helper') }}</span>
                </div>

                <div class="col-md-4 form-group">
                    <label class="required" for="amount">
                        {{ trans('cruds.rowData.fields.amount') }}
                    </label>
                    <input class="form-control {{ $errors->has('amount') ? 'is-invalid' : '' }}"
                           type="text"
                           name="amount"
                           id="amount"
                           value="{{ old('amount') }}"
                           required>
                    @if($errors->has('amount'))
                        <div class="invalid-feedback">{{ $errors->first('amount') }}</div>
                    @endif
                    <span class="help-block">{{ trans('cruds.rowData.fields.amount_helper') }}</span>
                </div>

                <div class="col-md-4 form-group">
                    <label for="expiry_date">
                        {{ trans('cruds.rowData.fields.expiry_date') }}
                    </label>
                    <input class="form-control date {{ $errors->has('expiry_date') ? 'is-invalid' : '' }}"
                           type="text"
                           name="expiry_date"
                           id="expiry_date"
                           value="{{ old('expiry_date') }}">
                    @if($errors->has('expiry_date'))
                        <div class="invalid-feedback">{{ $errors->first('expiry_date') }}</div>
                    @endif
                    <span class="help-block">{{ trans('cruds.rowData.fields.expiry_date_helper') }}</span>
                </div>
            </div>

            {{-- 🔹 SECOND ROW (2 INPUTS) --}}
            <div class="row">
                <div class="col-md-6 form-group">
                    <label>{{ trans('cruds.rowData.fields.status') }}</label>
                    <select class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}"
                            name="status"
                            id="status">
                        <option value disabled {{ old('status') === null ? 'selected' : '' }}>
                            {{ trans('global.pleaseSelect') }}
                        </option>
                        @foreach(App\Models\RowData::STATUS_SELECT as $key => $label)
                            <option value="{{ $key }}" {{ old('status') === (string) $key ? 'selected' : '' }}>
                                {{ $label }}
                            </option>
                        @endforeach
                    </select>
                    @if($errors->has('status'))
                        <div class="invalid-feedback">{{ $errors->first('status') }}</div>
                    @endif
                    <span class="help-block">{{ trans('cruds.rowData.fields.status_helper') }}</span>
                </div>

                <div class="col-md-6 form-group">
                    <label>{{ trans('cruds.rowData.fields.reward_status') }}</label>
                    <select class="form-control {{ $errors->has('reward_status') ? 'is-invalid' : '' }}"
                            name="reward_status"
                            id="reward_status">
                        <option value disabled {{ old('reward_status') === null ? 'selected' : '' }}>
                            {{ trans('global.pleaseSelect') }}
                        </option>
                        @foreach(App\Models\RowData::REWARD_STATUS_SELECT as $key => $label)
                            <option value="{{ $key }}" {{ old('reward_status') === (string) $key ? 'selected' : '' }}>
                                {{ $label }}
                            </option>
                        @endforeach
                    </select>
                    @if($errors->has('reward_status'))
                        <div class="invalid-feedback">{{ $errors->first('reward_status') }}</div>
                    @endif
                    <span class="help-block">{{ trans('cruds.rowData.fields.reward_status_helper') }}</span>
                </div>
            </div>

            {{-- 🔹 THIRD ROW (2 INPUTS) --}}
            <div class="row">
                <div class="col-md-6 form-group">
                    <label for="used_by">{{ trans('cruds.rowData.fields.used_by') }}</label>
                    <input class="form-control {{ $errors->has('used_by') ? 'is-invalid' : '' }}"
                           type="text"
                           name="used_by"
                           id="used_by"
                           value="{{ old('used_by') }}">
                    @if($errors->has('used_by'))
                        <div class="invalid-feedback">{{ $errors->first('used_by') }}</div>
                    @endif
                    <span class="help-block">{{ trans('cruds.rowData.fields.used_by_helper') }}</span>
                </div>

                <div class="col-md-6 form-group">
                    <label for="used_by_phone">{{ trans('cruds.rowData.fields.used_by_phone') }}</label>
                    <input class="form-control {{ $errors->has('used_by_phone') ? 'is-invalid' : '' }}"
                           type="text"
                           name="used_by_phone"
                           id="used_by_phone"
                           value="{{ old('used_by_phone') }}">
                    @if($errors->has('used_by_phone'))
                        <div class="invalid-feedback">{{ $errors->first('used_by_phone') }}</div>
                    @endif
                    <span class="help-block">{{ trans('cruds.rowData.fields.used_by_phone_helper') }}</span>
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
