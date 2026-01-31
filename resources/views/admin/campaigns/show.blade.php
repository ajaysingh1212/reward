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
</style>

<div class="card dark-card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.campaign.title') }}
    </div>

    <div class="card-body">

        <div class="mb-4">
            <a class="btn btn-back" href="{{ route('admin.campaigns.index') }}">
                ← {{ trans('global.back_to_list') }}
            </a>
        </div>

        <table class="table table-bordered dark-table">
            <tbody>
                <tr>
                    <th>{{ trans('cruds.campaign.fields.id') }}</th>
                    <td>{{ $campaign->id }}</td>
                </tr>

                <tr>
                    <th>{{ trans('cruds.campaign.fields.camp_name') }}</th>
                    <td>{{ $campaign->camp_name }}</td>
                </tr>

                <tr>
                    <th>{{ trans('cruds.campaign.fields.start_date') }}</th>
                    <td>{{ $campaign->start_date }}</td>
                </tr>

                <tr>
                    <th>{{ trans('cruds.campaign.fields.end_date') }}</th>
                    <td>{{ $campaign->end_date }}</td>
                </tr>

                <tr>
                    <th>{{ trans('cruds.campaign.fields.status') }}</th>
                    <td>
                        @php
                            $statusLabel = App\Models\Campaign::STATUS_SELECT[$campaign->status] ?? '';
                        @endphp

                        <span class="status-badge {{ $campaign->status === 'active' ? 'status-active' : 'status-inactive' }}">
                            {{ $statusLabel }}
                        </span>
                    </td>
                </tr>
            </tbody>
        </table>

        <div class="mt-4">
            <a class="btn btn-back" href="{{ route('admin.campaigns.index') }}">
                ← {{ trans('global.back_to_list') }}
            </a>
        </div>

    </div>
</div>

@endsection
