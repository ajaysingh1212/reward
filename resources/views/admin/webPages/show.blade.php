@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.webPage.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.web-pages.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.webPage.fields.id') }}
                        </th>
                        <td>
                            {{ $webPage->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.webPage.fields.title') }}
                        </th>
                        <td>
                            {{ $webPage->title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.webPage.fields.logo') }}
                        </th>
                        <td>
                            @if($webPage->logo)
                                <a href="{{ $webPage->logo->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $webPage->logo->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.webPage.fields.banner_1') }}
                        </th>
                        <td>
                            @if($webPage->banner_1)
                                <a href="{{ $webPage->banner_1->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $webPage->banner_1->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.webPage.fields.banner_2') }}
                        </th>
                        <td>
                            @if($webPage->banner_2)
                                <a href="{{ $webPage->banner_2->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $webPage->banner_2->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.webPage.fields.banner_3') }}
                        </th>
                        <td>
                            @if($webPage->banner_3)
                                <a href="{{ $webPage->banner_3->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $webPage->banner_3->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.webPage.fields.about_image') }}
                        </th>
                        <td>
                            @if($webPage->about_image)
                                <a href="{{ $webPage->about_image->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $webPage->about_image->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.webPage.fields.about_content') }}
                        </th>
                        <td>
                            {!! $webPage->about_content !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.webPage.fields.mission') }}
                        </th>
                        <td>
                            {!! $webPage->mission !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.webPage.fields.vision') }}
                        </th>
                        <td>
                            {!! $webPage->vision !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.webPage.fields.value') }}
                        </th>
                        <td>
                            {!! $webPage->value !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.webPage.fields.disclimer') }}
                        </th>
                        <td>
                            {{ $webPage->disclimer }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.webPage.fields.notes') }}
                        </th>
                        <td>
                            {!! $webPage->notes !!}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.web-pages.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection