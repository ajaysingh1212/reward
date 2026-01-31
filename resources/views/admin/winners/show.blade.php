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

    .btn-back {
        background: transparent;
        border: 1px solid #6c63ff;
        color: #6c63ff;
        border-radius: 30px;
        padding: 8px 26px;
        transition: 0.3s;
        font-weight: 500;
    }

    .btn-back:hover {
        background: #6c63ff;
        color: #fff;
        box-shadow: 0 10px 20px rgba(108,99,255,0.4);
    }

    .dark-table {
        background: transparent;
        color: #ffffff;
        margin-bottom: 0;
    }

    .dark-table th {
        width: 30%;
        background: #0f0f1a;
        color: #cfd3ff;
        border: 1px solid #2d2d4f;
        font-weight: 600;
    }

    .dark-table td {
        background: #131326;
        border: 1px solid #2d2d4f;
        color: #ffffff;
    }

    .code-badge {
        background: #6c63ff;
        color: #fff;
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 600;
        display: inline-block;
        margin: 2px;
    }

    .image-thumb {
        border-radius: 10px;
        border: 1px solid #2d2d4f;
        margin-right: 8px;
        transition: 0.3s;
    }

    .image-thumb:hover {
        transform: scale(1.05);
        box-shadow: 0 6px 16px rgba(0,0,0,0.4);
    }
</style>

<div class="card dark-card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.winner.title') }}
    </div>

    <div class="card-body">

        <div class="mb-4">
            <a class="btn btn-back" href="{{ route('admin.winners.index') }}">
                ← {{ trans('global.back_to_list') }}
            </a>
        </div>

        <table class="table table-bordered dark-table">
            <tbody>
                <tr>
                    <th>{{ trans('cruds.winner.fields.id') }}</th>
                    <td>{{ $winner->id }}</td>
                </tr>

                <tr>
                    <th>{{ trans('cruds.winner.fields.cupon_number') }}</th>
                    <td>
                        @foreach($winner->cupon_numbers as $cupon_number)
                            <span class="code-badge">
                                {{ $cupon_number->unique_code }}
                            </span>
                        @endforeach
                    </td>
                </tr>

                <tr>
                    <th>{{ trans('cruds.winner.fields.full_name') }}</th>
                    <td>{{ $winner->full_name }}</td>
                </tr>

                <tr>
                    <th>{{ trans('cruds.winner.fields.phone_number') }}</th>
                    <td>{{ $winner->phone_number }}</td>
                </tr>

                <tr>
                    <th>{{ trans('cruds.winner.fields.email') }}</th>
                    <td>{{ $winner->email }}</td>
                </tr>

                <tr>
                    <th>{{ trans('cruds.winner.fields.upi') }}</th>
                    <td>{{ $winner->upi }}</td>
                </tr>

                <tr>
                    <th>{{ trans('cruds.winner.fields.product_name') }}</th>
                    <td>{{ $winner->product_name }}</td>
                </tr>

                <tr>
                    <th>{{ trans('cruds.winner.fields.customer_photo') }}</th>
                    <td>
                        @if($winner->customer_photo)
                            <a href="{{ $winner->customer_photo->getUrl() }}" target="_blank">
                                <img class="image-thumb"
                                     src="{{ $winner->customer_photo->getUrl('thumb') }}">
                            </a>
                        @endif
                    </td>
                </tr>

                <tr>
                    <th>{{ trans('cruds.winner.fields.product_photo') }}</th>
                    <td>
                        @foreach($winner->product_photo as $media)
                            <a href="{{ $media->getUrl() }}" target="_blank">
                                <img class="image-thumb"
                                     src="{{ $media->getUrl('thumb') }}">
                            </a>
                        @endforeach
                    </td>
                </tr>
            </tbody>
        </table>

        <div class="mt-4">
            <a class="btn btn-back" href="{{ route('admin.winners.index') }}">
                ← {{ trans('global.back_to_list') }}
            </a>
        </div>

    </div>
</div>

@endsection
