@extends('layouts.admin')
@section('content')
@can('web_page_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.web-pages.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.webPage.title_singular') }}
            </a>
            <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                {{ trans('global.app_csvImport') }}
            </button>
            @include('csvImport.modal', ['model' => 'WebPage', 'route' => 'admin.web-pages.parseCsvImport'])
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.webPage.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-WebPage">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.webPage.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.webPage.fields.title') }}
                        </th>
                        <th>
                            {{ trans('cruds.webPage.fields.logo') }}
                        </th>
                        <th>
                            {{ trans('cruds.webPage.fields.banner_1') }}
                        </th>
                        <th>
                            {{ trans('cruds.webPage.fields.banner_2') }}
                        </th>
                        <th>
                            {{ trans('cruds.webPage.fields.banner_3') }}
                        </th>
                        <th>
                            {{ trans('cruds.webPage.fields.about_image') }}
                        </th>
                        <th>
                            {{ trans('cruds.webPage.fields.disclimer') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($webPages as $key => $webPage)
                        <tr data-entry-id="{{ $webPage->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $webPage->id ?? '' }}
                            </td>
                            <td>
                                {{ $webPage->title ?? '' }}
                            </td>
                            <td>
                                @if($webPage->logo)
                                    <a href="{{ $webPage->logo->getUrl() }}" target="_blank" style="display: inline-block">
                                        <img src="{{ $webPage->logo->getUrl('thumb') }}">
                                    </a>
                                @endif
                            </td>
                            <td>
                                @if($webPage->banner_1)
                                    <a href="{{ $webPage->banner_1->getUrl() }}" target="_blank" style="display: inline-block">
                                        <img src="{{ $webPage->banner_1->getUrl('thumb') }}">
                                    </a>
                                @endif
                            </td>
                            <td>
                                @if($webPage->banner_2)
                                    <a href="{{ $webPage->banner_2->getUrl() }}" target="_blank" style="display: inline-block">
                                        <img src="{{ $webPage->banner_2->getUrl('thumb') }}">
                                    </a>
                                @endif
                            </td>
                            <td>
                                @if($webPage->banner_3)
                                    <a href="{{ $webPage->banner_3->getUrl() }}" target="_blank" style="display: inline-block">
                                        <img src="{{ $webPage->banner_3->getUrl('thumb') }}">
                                    </a>
                                @endif
                            </td>
                            <td>
                                @if($webPage->about_image)
                                    <a href="{{ $webPage->about_image->getUrl() }}" target="_blank" style="display: inline-block">
                                        <img src="{{ $webPage->about_image->getUrl('thumb') }}">
                                    </a>
                                @endif
                            </td>
                            <td>
                                {{ $webPage->disclimer ?? '' }}
                            </td>
                            <td>
                                @can('web_page_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.web-pages.show', $webPage->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('web_page_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.web-pages.edit', $webPage->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('web_page_delete')
                                    <form action="{{ route('admin.web-pages.destroy', $webPage->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                    </form>
                                @endcan

                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>



@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('web_page_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.web-pages.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan

  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  let table = $('.datatable-WebPage:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection