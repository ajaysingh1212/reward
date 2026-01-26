<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyWebPageRequest;
use App\Http\Requests\StoreWebPageRequest;
use App\Http\Requests\UpdateWebPageRequest;
use App\Models\WebPage;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class WebPageController extends Controller
{
    use MediaUploadingTrait, CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('web_page_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $webPages = WebPage::with(['created_by', 'media'])->get();

        return view('admin.webPages.index', compact('webPages'));
    }

    public function create()
    {
        abort_if(Gate::denies('web_page_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.webPages.create');
    }

    public function store(StoreWebPageRequest $request)
    {
        $webPage = WebPage::create($request->all());

        if ($request->input('logo', false)) {
            $webPage->addMedia(storage_path('tmp/uploads/' . basename($request->input('logo'))))->toMediaCollection('logo');
        }

        if ($request->input('banner_1', false)) {
            $webPage->addMedia(storage_path('tmp/uploads/' . basename($request->input('banner_1'))))->toMediaCollection('banner_1');
        }

        if ($request->input('banner_2', false)) {
            $webPage->addMedia(storage_path('tmp/uploads/' . basename($request->input('banner_2'))))->toMediaCollection('banner_2');
        }

        if ($request->input('banner_3', false)) {
            $webPage->addMedia(storage_path('tmp/uploads/' . basename($request->input('banner_3'))))->toMediaCollection('banner_3');
        }

        if ($request->input('about_image', false)) {
            $webPage->addMedia(storage_path('tmp/uploads/' . basename($request->input('about_image'))))->toMediaCollection('about_image');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $webPage->id]);
        }

        return redirect()->route('admin.web-pages.index');
    }

    public function edit(WebPage $webPage)
    {
        abort_if(Gate::denies('web_page_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $webPage->load('created_by');

        return view('admin.webPages.edit', compact('webPage'));
    }

    public function update(UpdateWebPageRequest $request, WebPage $webPage)
    {
        $webPage->update($request->all());

        if ($request->input('logo', false)) {
            if (! $webPage->logo || $request->input('logo') !== $webPage->logo->file_name) {
                if ($webPage->logo) {
                    $webPage->logo->delete();
                }
                $webPage->addMedia(storage_path('tmp/uploads/' . basename($request->input('logo'))))->toMediaCollection('logo');
            }
        } elseif ($webPage->logo) {
            $webPage->logo->delete();
        }

        if ($request->input('banner_1', false)) {
            if (! $webPage->banner_1 || $request->input('banner_1') !== $webPage->banner_1->file_name) {
                if ($webPage->banner_1) {
                    $webPage->banner_1->delete();
                }
                $webPage->addMedia(storage_path('tmp/uploads/' . basename($request->input('banner_1'))))->toMediaCollection('banner_1');
            }
        } elseif ($webPage->banner_1) {
            $webPage->banner_1->delete();
        }

        if ($request->input('banner_2', false)) {
            if (! $webPage->banner_2 || $request->input('banner_2') !== $webPage->banner_2->file_name) {
                if ($webPage->banner_2) {
                    $webPage->banner_2->delete();
                }
                $webPage->addMedia(storage_path('tmp/uploads/' . basename($request->input('banner_2'))))->toMediaCollection('banner_2');
            }
        } elseif ($webPage->banner_2) {
            $webPage->banner_2->delete();
        }

        if ($request->input('banner_3', false)) {
            if (! $webPage->banner_3 || $request->input('banner_3') !== $webPage->banner_3->file_name) {
                if ($webPage->banner_3) {
                    $webPage->banner_3->delete();
                }
                $webPage->addMedia(storage_path('tmp/uploads/' . basename($request->input('banner_3'))))->toMediaCollection('banner_3');
            }
        } elseif ($webPage->banner_3) {
            $webPage->banner_3->delete();
        }

        if ($request->input('about_image', false)) {
            if (! $webPage->about_image || $request->input('about_image') !== $webPage->about_image->file_name) {
                if ($webPage->about_image) {
                    $webPage->about_image->delete();
                }
                $webPage->addMedia(storage_path('tmp/uploads/' . basename($request->input('about_image'))))->toMediaCollection('about_image');
            }
        } elseif ($webPage->about_image) {
            $webPage->about_image->delete();
        }

        return redirect()->route('admin.web-pages.index');
    }

    public function show(WebPage $webPage)
    {
        abort_if(Gate::denies('web_page_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $webPage->load('created_by');

        return view('admin.webPages.show', compact('webPage'));
    }

    public function destroy(WebPage $webPage)
    {
        abort_if(Gate::denies('web_page_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $webPage->delete();

        return back();
    }

    public function massDestroy(MassDestroyWebPageRequest $request)
    {
        $webPages = WebPage::find(request('ids'));

        foreach ($webPages as $webPage) {
            $webPage->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('web_page_create') && Gate::denies('web_page_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new WebPage();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
