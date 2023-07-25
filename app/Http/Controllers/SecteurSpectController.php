<?php

namespace App\Http\Controllers;
use App\Helpers\Components\Action;
use App\Helpers\Components\Head;
use App\Http\Requests\AddSecteurSpectRequest;
use App\Models\SecteurSpect as Modeltarget;

use Illuminate\Http\Request;

class SecteurSpectController extends Controller
{
    public function index()
    {
        // Modeltarget::factory(10)->create();

        $actions = [
            new Action(ucwords(trans('words.add')), Action::TYPE_NORMAL, url: route('secteursspects.create')),
            new Action(ucwords(trans('words.delete_all')), Action::TYPE_DELETE_ALL, url: route('secteursspects.destroyGroup'))
        ];
        $heads = [
            new Head('nom', Head::TYPE_TEXT, trans('pages/secteursspects.nom')),
            new Head('description', Head::TYPE_TEXT, trans('pages/secteursspects.description')),
        ];

        $collection = ModelTarget::all();
        return view('crud.secteursspects.index', compact(['actions', 'heads', 'collection']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('crud.secteursspects.create');
    }

    /***
     * Add a new record
     * @param Add $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws FilesystemException
     */
    public function store(AddSecteurSpectRequest $request)
    {
        $validated = $request->validated();

        ModelTarget::query()->create($validated);

        $this->success(text: trans('messages.added_message'));
        return redirect(route('secteursspects.index'));
    }

    public function show(Modeltarget $id)
    {
        $model = ModelTarget::all()->find($id);
        return view('crud.secteursspects.edit', compact("model"));
    }

    /***
     * Delete multi records
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroyGroup(Request $request)
    {
        $ids = $request['ids'] ?? [];
        foreach ($ids as $id) {
            $model = ModelTarget::query()->find((int)\Crypt::decrypt($id));
            $model?->delete();
        }
        $this->success(text: trans('messages.deleted_message'));
        return response()->json(['success' => true]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Periode  $periode
     * @return \Illuminate\Http\Response
     */
    public function edit(Modeltarget $secteursSpects)
    {
        //
    }

    /***
     * Update record if exists
     * @param Add $request
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws FilesystemException
     */
    public function update(AddSecteurSpectRequest $request, $id)
    {
        $model = ModelTarget::query()->findOrFail($id);

        $validated = $request->validated();
        $model->update($validated);
        $this->success(text: trans('messages.updated_message'));
        return redirect(route('secteursspects.index'));
    }

    /***
     * Delete one record by id if exists
     * @param Request $request
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy(Request $request, $id)
    {
        $idd = ModelTarget::query()->findOrFail($id)->delete();
        $this->success(trans('messages.deleted_message'));
        return redirect(route('secteursspects.index'));
    }
}
