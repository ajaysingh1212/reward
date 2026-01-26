<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRowDataRequest;
use App\Http\Requests\UpdateRowDataRequest;
use App\Http\Resources\Admin\RowDataResource;
use App\Models\RowData;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RowDataApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('row_data_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new RowDataResource(RowData::with(['created_by'])->get());
    }

    public function store(StoreRowDataRequest $request)
    {
        $rowData = RowData::create($request->all());

        return (new RowDataResource($rowData))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(RowData $rowData)
    {
        abort_if(Gate::denies('row_data_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new RowDataResource($rowData->load(['created_by']));
    }

    public function update(UpdateRowDataRequest $request, RowData $rowData)
    {
        $rowData->update($request->all());

        return (new RowDataResource($rowData))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(RowData $rowData)
    {
        abort_if(Gate::denies('row_data_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $rowData->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
