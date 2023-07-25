<?php

namespace App\Http\Controllers;

use App\Helpers\Components\Action;
use App\Helpers\Components\Head;
use App\Http\Requests\AddlangueRequest; 
use App\Models\Langue as Modeltarget;

use Illuminate\Http\Request;

class LangueController extends Controller
{
    public function index()
    {
        // Modeltarget::factory(10)->create();

        $actions = [
            new Action(ucwords(trans('words.add')), Action::TYPE_NORMAL, url: route('langues.create')),
            new Action(ucwords(trans('words.delete_all')), Action::TYPE_DELETE_ALL, url: route('langues.destroyGroup'))
        ];
        $heads = [
            new Head('flag', Head::TYPE_IMG, trans('pages/langues.flag')),
            new Head('code', Head::TYPE_TEXT, trans('pages/langues.code')),
            new Head('nom', Head::TYPE_TEXT, trans('pages/langues.nom')),
        ];

        $collection = ModelTarget::all();
        return view('crud.langues.index', compact(['actions', 'heads', 'collection']));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('crud.langues.create');
    }

    /***
     * Add a new record
     * @param Add $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws FilesystemException
     */
    public function store(AddlangueRequest $request)
    {
        $validated = $request->validated();
        $flag = $request->validated()['flag'] ?? null;
        unset($validated['flag']);
     
        $model = ModelTarget::query()->create($validated);
        // $path = $flag->store('profils', 'public');

        $model->update([
            'flag' => $this->saveFile('flag', file: $flag)
            // 'flag' => $path
        ]);
        $this->success(text: trans('messages.added_message'));
        return redirect(route('langues.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Periode  $periode
     * @return \Illuminate\Http\Response
     */
    public function show(Modeltarget $id)
    {
        $model = ModelTarget::all()->find($id);
        return view('crud.langues.edit', compact("model"));
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
    public function edit(Modeltarget $langue)
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
    public function update(AddlangueRequest $request, $id)
    {
        $model = ModelTarget::query()->findOrFail($id);

        // unset($validated['flag']);
        $validated = $request->validated();
                            
        // dd(444);
        unset($validated['flag']);

        $this->saveAndDeleteOld($request->validated()['flag'] ?? null, 'profils', $model, 'flag');
        $model->update($validated);

        $this->success(text: trans('messages.updated_message'));
        return redirect(route('langues.index'));
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
        // dd($idd);
        $this->success(trans('messages.deleted_message'));
        return redirect(route('langues.index'));
    }
}
