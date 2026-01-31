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
        margin-bottom: 30px;
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

    .dark-table {
        background-color: transparent;
        color: #ffffff;
        margin-bottom: 0;
    }

    .dark-table th {
        width: 30%;
        background-color: #0f0f1a;
        color: #cfd3ff;
        border: 1px solid #2d2d4f;
        font-weight: 600;
    }

    .dark-table td {
        background-color: #131326;
        border: 1px solid #2d2d4f;
        color: #ffffff;
    }

    .status-badge {
        padding: 6px 14px;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 600;
        display: inline-block;
    }

    .status-active {
        background: rgba(0, 200, 150, 0.15);
        color: #00e0a4;
    }

    .status-inactive {
        background: rgba(255, 77, 79, 0.15);
        color: #ff6b6b;
    }

    .reward-yes {
        background: rgba(108, 99, 255, 0.15);
        color: #6c63ff;
    }

    .reward-no {
        background: rgba(255, 193, 7, 0.15);
        color: #ffc107;
    }

    .btn-back {
        background: transparent;
        border: 1px solid #6c63ff;
        color: #6c63ff;
        border-radius: 30px;
        padding: 8px 26px;
        transition: all 0.3s ease;
        font-weight: 500;
    }

    .btn-back:hover {
        background: #6c63ff;
        color: #ffffff;
        box-shadow: 0 10px 20px rgba(108,99,255,0.4);
    }

    .dark-tabs .nav-link {
        color: #cfd3ff;
        border: none;
        padding: 12px 20px;
    }

    .dark-tabs .nav-link.active {
        background: #0f0f1a;
        color: #6c63ff;
        border-radius: 10px 10px 0 0;
    }

    .dark-tab-content {
        background: #0f0f1a;
        border-radius: 0 0 12px 12px;
        padding: 20px;
        border: 1px solid #2d2d4f;
    }
</style>

{{-- 🔹 MAIN DETAILS CARD --}}
<div class="card dark-card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.rowData.title') }}
    </div>

    <div class="card-body">

        <div class="mb-4">
            <a class="btn btn-back" href="{{ route('admin.row-datas.index') }}">
                ← {{ trans('global.back_to_list') }}
            </a>
        </div>

        <table class="table table-bordered dark-table">
            <tbody>
                <tr>
                    <th>{{ trans('cruds.rowData.fields.id') }}</th>
                    <td>{{ $rowData->id }}</td>
                </tr>
                <tr>
                    <th>{{ trans('cruds.rowData.fields.unique_code') }}</th>
                    <td>{{ $rowData->unique_code }}</td>
                </tr>
                <tr>
                    <th>{{ trans('cruds.rowData.fields.amount') }}</th>
                    <td>{{ $rowData->amount }}</td>
                </tr>
                <tr>
                    <th>{{ trans('cruds.rowData.fields.expiry_date') }}</th>
                    <td>{{ $rowData->expiry_date }}</td>
                </tr>
                <tr>
                    <th>{{ trans('cruds.rowData.fields.status') }}</th>
                    <td>
                        <span class="status-badge {{ $rowData->status === 'active' ? 'status-active' : 'status-inactive' }}">
                            {{ App\Models\RowData::STATUS_SELECT[$rowData->status] ?? '' }}
                        </span>
                    </td>
                </tr>
                <tr>
                    <th>{{ trans('cruds.rowData.fields.reward_status') }}</th>
                    <td>
                        <span class="status-badge {{ $rowData->reward_status === 'yes' ? 'reward-yes' : 'reward-no' }}">
                            {{ App\Models\RowData::REWARD_STATUS_SELECT[$rowData->reward_status] ?? '' }}
                        </span>
                    </td>
                </tr>
                <tr>
                    <th>{{ trans('cruds.rowData.fields.used_by') }}</th>
                    <td>{{ $rowData->used_by }}</td>
                </tr>
                <tr>
                    <th>{{ trans('cruds.rowData.fields.used_by_phone') }}</th>
                    <td>{{ $rowData->used_by_phone }}</td>
                </tr>
            </tbody>
        </table>

        <div class="mt-4">
            <a class="btn btn-back" href="{{ route('admin.row-datas.index') }}">
                ← {{ trans('global.back_to_list') }}
            </a>
        </div>

    </div>
</div>

{{-- 🔹 RELATED DATA CARD --}}
<div class="card dark-card">
    <div class="card-header">
        {{ trans('global.relatedData') }}
    </div>

    <div class="card-body">
        <ul class="nav nav-tabs dark-tabs" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" href="#cupon_number_winners" role="tab" data-toggle="tab">
                    {{ trans('cruds.winner.title') }}
                </a>
            </li>
        </ul>

        <div class="tab-content dark-tab-content">
            <div class="tab-pane active" role="tabpanel" id="cupon_number_winners">
                @includeIf(
                    'admin.rowDatas.relationships.cuponNumberWinners',
                    ['winners' => $rowData->cuponNumberWinners]
                )
            </div>
        </div>
    </div>
</div>

@endsection
