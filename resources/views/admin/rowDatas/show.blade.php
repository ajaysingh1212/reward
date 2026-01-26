@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.rowData.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.row-datas.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.rowData.fields.id') }}
                        </th>
                        <td>
                            {{ $rowData->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.rowData.fields.unique_code') }}
                        </th>
                        <td>
                            {{ $rowData->unique_code }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.rowData.fields.amount') }}
                        </th>
                        <td>
                            {{ $rowData->amount }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.rowData.fields.expiry_date') }}
                        </th>
                        <td>
                            {{ $rowData->expiry_date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.rowData.fields.status') }}
                        </th>
                        <td>
                            {{ App\Models\RowData::STATUS_SELECT[$rowData->status] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.rowData.fields.reward_status') }}
                        </th>
                        <td>
                            {{ App\Models\RowData::REWARD_STATUS_SELECT[$rowData->reward_status] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.rowData.fields.used_by') }}
                        </th>
                        <td>
                            {{ $rowData->used_by }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.rowData.fields.used_by_phone') }}
                        </th>
                        <td>
                            {{ $rowData->used_by_phone }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.row-datas.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        {{ trans('global.relatedData') }}
    </div>
    <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
        <li class="nav-item">
            <a class="nav-link" href="#cupon_number_winners" role="tab" data-toggle="tab">
                {{ trans('cruds.winner.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="cupon_number_winners">
            @includeIf('admin.rowDatas.relationships.cuponNumberWinners', ['winners' => $rowData->cuponNumberWinners])
        </div>
    </div>
</div>

@endsection