<?php

namespace App\Http\Controllers;

use App\Http\Requests\addLoisires;
use Illuminate\Http\Request;
use App\Helpers\Components\Action;
use App\Helpers\Components\Head;
use App\Http\Requests\AddUserRequet;
use App\Models\Loisire as ModelTarget;
use App\Models\Profil;
use League\Flysystem\FilesystemException;


class LoisireController extends Controller
{

    /***
     *  page index
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    protected function index($profil)
    {
        $actions = [
            new Action(ucwords(trans('words.add')), Action::TYPE_NORMAL, url: route('loisirs.create',$profil)),
            new Action(ucwords(trans('words.delete_all')), Action::TYPE_DELETE_ALL, url: route('loisirs.destroyGroup'))
        ];
        $heads = [
            new Head('logo', Head::TYPE_IMG, trans('pages/loisirs.logo')),
            new Head('titre', Head::TYPE_TEXT, trans('pages/loisirs.titre')),
            new Head('description', Head::TYPE_TEXT, trans('pages/loisirs.description')),
        ];

        $collection = ModelTarget::query()->where('profil','=',$profil)
            ->get();
        $code='loisir';
        $model = Profil::query()->findOrFail($profil);
        $json_data = file_get_contents(public_path('countries.json'));
        $data = json_decode($json_data, true);
        
        return view('crud.profil.edit', compact(['actions', 'heads', 'collection','code','model','data']));
    }

    /***
     * Page create
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create($profil)
    {
        return view('crud.loisirs.create',compact('profil'));
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
        return view('crud.loisirs.edit', [
            'model' => $model
        ]);
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
        return redirect(route('profils.show',$model['profil']));
    }

    /***
     * Add a new record
     * @param Add $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws FilesystemException
     */
    public function store(addLoisires $request)
    {
        $validated = $request->validated();
        $logo = $request->validated()['logo'] ?? null;
        unset($validated['logo']);

        $model = ModelTarget::query()->create($validated);
        $model->update([
            'logo' => $this->saveFile('fileLoisire', file: $logo)
        ]);
      
        $this->success(text: trans('messages.added_message'));
        return redirect(route('profils.show',$model['profil']));
    }


    /***
     * Update record if exists
     * @param Add $request
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws FilesystemException
     */
    public function update(addLoisires $request, $id)
    {

        $model = ModelTarget::query()->findOrFail($id);

        $validated = $request->validated();
        unset($validated['logo']);
        $this->saveAndDeleteOld($request->validated()['logo'] ?? null, 'fileLoisire', $model, 'logo');
        $model->update($validated);
        
        $this->success(text: trans('messages.updated_message'));
        return redirect(route('profils.show',$model['profil']));
    }

}
