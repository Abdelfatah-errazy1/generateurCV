<?php

namespace App\Http\Controllers;

use App\Models\Profil;
use Illuminate\Http\Request;
use App\Helpers\Components\Head;
use App\Http\Requests\AddTachRequest;
use App\Helpers\Components\Action;
use App\Http\Requests\Clients\Add;
use App\Http\Requests\Clients\edit;
use App\Models\Tache as ModelTarget;
use RealRashid\SweetAlert\Facades\Alert;
use League\Flysystem\FilesystemException;

class TacheController extends Controller
{
    /***
     *  page index
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    protected function index($profil)
    {
        $actions = [
            new Action(ucwords(trans('words.add')), Action::TYPE_NORMAL, url: route('taches.create',$profil)),
            new Action(ucwords(trans('words.delete_all')), Action::TYPE_DELETE_ALL, url: route('taches.destroyGroup'))
        ];
        $heads = [
            new Head('titre', Head::TYPE_TEXT, trans('pages/taches.titre')),

        ];

       
        $collection = ModelTarget::query()->where('profil','=',$profil)->get();
        $code='qual';
        $model = Profil::query()->findOrFail($profil);
        return view('crud.profil.edit', compact(['actions', 'heads', 'collection','code','model']));
    }

    /***
     * Page create
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create($experience)
    {
        return view('crud.taches.create',compact('experience'));
    }

    /***
    -----     * Page edit
     * @param Request $request
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(Request $request, $id)
    {
        $model = ModelTarget::query()->findOrFail($id);
        return view('crud.taches.edit', [
            'model' => $model
        ]);
    }

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

    /***
     * Delete one record by id if exists
     * @param Request $request
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy(Request $request, $id)
    {
        $model=ModelTarget::query()->findOrFail($id);
        ModelTarget::query()->findOrFail($id)->delete();
        $this->success(trans('messages.deleted_message'));
        return redirect()->route('experiences.show',$model['experience']);
    }

    /***
     * Add a new record
     * @param Add $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws FilesystemException
     */
    public function store(AddTachRequest $request)
    {
        $validated = $request->validated();
        $model = ModelTarget::query()
            ->create($validated);

        $this->success(text: trans('messages.added_message'));
        return redirect(route('experiences.show',$model['experience']));
    }

    /***
     * Update record if exists
     * @param Add $request
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws FilesystemException
     */
    public function update(AddTachRequest $request, $id)
    {

        $model = ModelTarget::query()->findOrFail($id);

        $validated = $request->validated();
       

        $model->update($validated);

        $this->success(text: trans('messages.updated_message'));
        return redirect(route('experiences.show',$model['experience']));
    }

}
