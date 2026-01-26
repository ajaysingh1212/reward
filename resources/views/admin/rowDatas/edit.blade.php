@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.rowData.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.row-datas.update", [$rowData->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="unique_code">{{ trans('cruds.rowData.fields.unique_code') }}</label>
                <input class="form-control {{ $errors->has('unique_code') ? 'is-invalid' : '' }}" type="text" name="unique_code" id="unique_code" value="{{ old('unique_code', $rowData->unique_code) }}" required>
                @if($errors->has('unique_code'))
                    <div class="invalid-feedback">
                        {{ $errors->first('unique_code') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.rowData.fields.unique_code_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="amount">{{ trans('cruds.rowData.fields.amount') }}</label>
                <input class="form-control {{ $errors->has('amount') ? 'is-invalid' : '' }}" type="text" name="amount" id="amount" value="{{ old('amount', $rowData->amount) }}" required>
                @if($errors->has('amount'))
                    <div class="invalid-feedback">
                        {{ $errors->first('amount') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.rowData.fields.amount_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="expiry_date">{{ trans('cruds.rowData.fields.expiry_date') }}</label>
                <input class="form-control date {{ $errors->has('expiry_date') ? 'is-invalid' : '' }}" type="text" name="expiry_date" id="expiry_date" value="{{ old('expiry_date', $rowData->expiry_date) }}">
                @if($errors->has('expiry_date'))
                    <div class="invalid-feedback">
                        {{ $errors->first('expiry_date') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.rowData.fields.expiry_date_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.rowData.fields.status') }}</label>
                <select class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status" id="status">
                    <option value disabled {{ old('status', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\RowData::STATUS_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('status', $rowData->status) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('status'))
                    <div class="invalid-feedback">
                        {{ $errors->first('status') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.rowData.fields.status_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.rowData.fields.reward_status') }}</label>
                <select class="form-control {{ $errors->has('reward_status') ? 'is-invalid' : '' }}" name="reward_status" id="reward_status">
                    <option value disabled {{ old('reward_status', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\RowData::REWARD_STATUS_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('reward_status', $rowData->reward_status) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('reward_status'))
                    <div class="invalid-feedback">
                        {{ $errors->first('reward_status') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.rowData.fields.reward_status_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="used_by">{{ trans('cruds.rowData.fields.used_by') }}</label>
                <input class="form-control {{ $errors->has('used_by') ? 'is-invalid' : '' }}" type="text" name="used_by" id="used_by" value="{{ old('used_by', $rowData->used_by) }}">
                @if($errors->has('used_by'))
                    <div class="invalid-feedback">
                        {{ $errors->first('used_by') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.rowData.fields.used_by_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="used_by_phone">{{ trans('cruds.rowData.fields.used_by_phone') }}</label>
                <input class="form-control {{ $errors->has('used_by_phone') ? 'is-invalid' : '' }}" type="text" name="used_by_phone" id="used_by_phone" value="{{ old('used_by_phone', $rowData->used_by_phone) }}">
                @if($errors->has('used_by_phone'))
                    <div class="invalid-feedback">
                        {{ $errors->first('used_by_phone') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.rowData.fields.used_by_phone_helper') }}</span>
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