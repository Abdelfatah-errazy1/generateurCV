<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\Components\Action;
use App\Helpers\Components\Head;
use App\Http\Requests\AddCompetenceRequest;
use App\Http\Requests\AddUserRequet;
use App\Models\Competence as ModelTarget;
use App\Models\Profil;
use League\Flysystem\FilesystemException;


class CompetenceController extends Controller
{

    /***
     *  page index
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    protected function index($profil)
    {
        $actions = [
            new Action(ucwords(trans('words.add')), Action::TYPE_NORMAL, url: route('competences.create',$profil)),
            new Action(ucwords(trans('words.delete_all')), Action::TYPE_DELETE_ALL, url: route('competences.destroyGroup'))
        ];
        $heads = [
            new Head('titre', Head::TYPE_TEXT, trans('pages/competences.titre')),
            new Head('level', Head::TYPE_TEXT, trans('pages/competences.level')),
            new Head('description', Head::TYPE_TEXT, trans('pages/competences.description')),
        ];

        $collection = ModelTarget::query()->where('profil','=',$profil)
            ->get();
        $code='comp';
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
        return view('crud.competences.create',compact('profil'));
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
        return view('crud.competences.edit', [
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
    public function store(AddCompetenceRequest $request)
    {
        $validated = $request->validated();
       
        $model = ModelTarget::query()->create($validated);
        return redirect(route('profils.show',$model['profil']));
    }


    /***
     * Update record if exists
     * @param Add $request
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws FilesystemException
     */
    public function update(AddCompetenceRequest $request, $id)
    {

        $model = ModelTarget::query()->findOrFail($id);

        $validated = $request->validated();
        $model->update($validated);
        $this->success(text: trans('messages.updated_message'));
        return redirect(route('profils.show',$model['profil']));
    }

}
