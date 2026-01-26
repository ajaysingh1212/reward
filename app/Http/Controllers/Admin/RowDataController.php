<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyRowDataRequest;
use App\Http\Requests\StoreRowDataRequest;
use App\Http\Requests\UpdateRowDataRequest;
use App\Models\RowData;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RowDataController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('row_data_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $rowDatas = RowData::with(['created_by'])->get();

        return view('admin.rowDatas.index', compact('rowDatas'));
    }

    public function create()
    {
        abort_if(Gate::denies('row_data_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.rowDatas.create');
    }

    public function store(StoreRowDataRequest $request)
    {
        $rowData = RowData::create($request->all());

        return redirect()->route('admin.row-datas.index');
    }

    public function edit(RowData $rowData)
    {
        abort_if(Gate::denies('row_data_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $rowData->load('created_by');

        return view('admin.rowDatas.edit', compact('rowData'));
    }

    public function update(UpdateRowDataRequest $request, RowData $rowData)
    {
        $rowData->update($request->all());

        return redirect()->route('admin.row-datas.index');
    }

    public function show(RowData $rowData)
    {
        abort_if(Gate::denies('row_data_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $rowData->load('created_by', 'cuponNumberWinners');

        return view('admin.rowDatas.show', compact('rowData'));
    }

    public function destroy(RowData $rowData)
    {
        abort_if(Gate::denies('row_data_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $rowData->delete();

        return back();
    }

    public function massDestroy(MassDestroyRowDataRequest $request)
    {
        $rowDatas = RowData::find(request('ids'));

        foreach ($rowDatas as $rowData) {
            $rowData->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
