@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.winner.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.winners.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.winner.fields.id') }}
                        </th>
                        <td>
                            {{ $winner->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.winner.fields.cupon_number') }}
                        </th>
                        <td>
                            @foreach($winner->cupon_numbers as $key => $cupon_number)
                                <span class="label label-info">{{ $cupon_number->unique_code }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.winner.fields.full_name') }}
                        </th>
                        <td>
                            {{ $winner->full_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.winner.fields.phone_number') }}
                        </th>
                        <td>
                            {{ $winner->phone_number }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.winner.fields.email') }}
                        </th>
                        <td>
                            {{ $winner->email }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.winner.fields.upi') }}
                        </th>
                        <td>
                            {{ $winner->upi }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.winner.fields.product_name') }}
                        </th>
                        <td>
                            {{ $winner->product_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.winner.fields.customer_photo') }}
                        </th>
                        <td>
                            @if($winner->customer_photo)
                                <a href="{{ $winner->customer_photo->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $winner->customer_photo->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.winner.fields.product_photo') }}
                        </th>
                        <td>
                            @foreach($winner->product_photo as $key => $media)
                                <a href="{{ $media->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $media->getUrl('thumb') }}">
                                </a>
                            @endforeach
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.winners.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection