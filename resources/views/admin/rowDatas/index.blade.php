@extends('layouts.admin')
@section('content')
@can('row_data_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.row-datas.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.rowData.title_singular') }}
            </a>
            <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                {{ trans('global.app_csvImport') }}
            </button>
            @include('csvImport.modal', ['model' => 'RowData', 'route' => 'admin.row-datas.parseCsvImport'])
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.rowData.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-RowData">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.rowData.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.rowData.fields.unique_code') }}
                        </th>
                        <th>
                            {{ trans('cruds.rowData.fields.amount') }}
                        </th>
                        <th>
                            {{ trans('cruds.rowData.fields.expiry_date') }}
                        </th>
                        <th>
                            {{ trans('cruds.rowData.fields.status') }}
                        </th>
                        <th>
                            {{ trans('cruds.rowData.fields.reward_status') }}
                        </th>
                        <th>
                            {{ trans('cruds.rowData.fields.used_by') }}
                        </th>
                        <th>
                            {{ trans('cruds.rowData.fields.used_by_phone') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($rowDatas as $key => $rowData)
                        <tr data-entry-id="{{ $rowData->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $rowData->id ?? '' }}
                            </td>
                            <td>
                                {{ $rowData->unique_code ?? '' }}
                            </td>
                            <td>
                                {{ $rowData->amount ?? '' }}
                            </td>
                            <td>
                                {{ $rowData->expiry_date ?? '' }}
                            </td>
                            <td>
                                {{ App\Models\RowData::STATUS_SELECT[$rowData->status] ?? '' }}
                            </td>
                            <td>
                                {{ App\Models\RowData::REWARD_STATUS_SELECT[$rowData->reward_status] ?? '' }}
                            </td>
                            <td>
                                {{ $rowData->used_by ?? '' }}
                            </td>
                            <td>
                                {{ $rowData->used_by_phone ?? '' }}
                            </td>
                            <td>
                                @can('row_data_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.row-datas.show', $rowData->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('row_data_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.row-datas.edit', $rowData->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('row_data_delete')
                                    <form action="{{ route('admin.row-datas.destroy', $rowData->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('row_data_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.row-datas.massDestroy') }}",
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
  let table = $('.datatable-RowData:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection