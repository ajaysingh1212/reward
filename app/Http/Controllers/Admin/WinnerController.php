<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyWinnerRequest;
use App\Http\Requests\StoreWinnerRequest;
use App\Http\Requests\UpdateWinnerRequest;
use App\Models\RowData;
use App\Models\Winner;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class WinnerController extends Controller
{
    use MediaUploadingTrait, CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('winner_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $winners = Winner::with(['cupon_numbers', 'created_by', 'media'])->get();

        return view('admin.winners.index', compact('winners'));
    }

    public function create()
    {
        abort_if(Gate::denies('winner_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $cupon_numbers = RowData::pluck('unique_code', 'id');

        return view('admin.winners.create', compact('cupon_numbers'));
    }

    public function store(StoreWinnerRequest $request)
    {
        $winner = Winner::create($request->all());
        $winner->cupon_numbers()->sync($request->input('cupon_numbers', []));
        if ($request->input('customer_photo', false)) {
            $winner->addMedia(storage_path('tmp/uploads/' . basename($request->input('customer_photo'))))->toMediaCollection('customer_photo');
        }

        foreach ($request->input('product_photo', []) as $file) {
            $winner->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('product_photo');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $winner->id]);
        }

        return redirect()->route('admin.winners.index');
    }

    public function edit(Winner $winner)
    {
        abort_if(Gate::denies('winner_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $cupon_numbers = RowData::pluck('unique_code', 'id');

        $winner->load('cupon_numbers', 'created_by');

        return view('admin.winners.edit', compact('cupon_numbers', 'winner'));
    }

    public function update(UpdateWinnerRequest $request, Winner $winner)
    {
        $winner->update($request->all());
        $winner->cupon_numbers()->sync($request->input('cupon_numbers', []));
        if ($request->input('customer_photo', false)) {
            if (! $winner->customer_photo || $request->input('customer_photo') !== $winner->customer_photo->file_name) {
                if ($winner->customer_photo) {
                    $winner->customer_photo->delete();
                }
                $winner->addMedia(storage_path('tmp/uploads/' . basename($request->input('customer_photo'))))->toMediaCollection('customer_photo');
            }
        } elseif ($winner->customer_photo) {
            $winner->customer_photo->delete();
        }

        if (count($winner->product_photo) > 0) {
            foreach ($winner->product_photo as $media) {
                if (! in_array($media->file_name, $request->input('product_photo', []))) {
                    $media->delete();
                }
            }
        }
        $media = $winner->product_photo->pluck('file_name')->toArray();
        foreach ($request->input('product_photo', []) as $file) {
            if (count($media) === 0 || ! in_array($file, $media)) {
                $winner->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('product_photo');
            }
        }

        return redirect()->route('admin.winners.index');
    }

    public function show(Winner $winner)
    {
        abort_if(Gate::denies('winner_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $winner->load('cupon_numbers', 'created_by');

        return view('admin.winners.show', compact('winner'));
    }

    public function destroy(Winner $winner)
    {
        abort_if(Gate::denies('winner_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $winner->delete();

        return back();
    }

    public function massDestroy(MassDestroyWinnerRequest $request)
    {
        $winners = Winner::find(request('ids'));

        foreach ($winners as $winner) {
            $winner->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('winner_create') && Gate::denies('winner_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Winner();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
