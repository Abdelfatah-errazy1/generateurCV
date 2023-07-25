<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Profil;
use App\Models\Country;
use Illuminate\Http\Request;
use App\Helpers\Components\Head;
use App\Helpers\Components\Action;
use App\Models\diplome as ModelTarget;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\AddDiplomeRequest;
use League\Flysystem\FilesystemException;

class DiplomeController extends Controller
{

    /***
     *  page index
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    protected function index($profil)
    {

//        User::factory(1)->create();

        $actions = [
            new Action(ucwords(trans('words.add')), Action::TYPE_NORMAL, url: route('diplomes.create',$profil)),
            new Action(ucwords(trans('words.delete_all')), Action::TYPE_DELETE_ALL, url: route('diplomes.destroyGroup'))
        ];
        $heads = [
            new Head('logoOrganisme', Head::TYPE_IMG, trans('pages/diplome.logoOrganisme')),
            new Head('titre', Head::TYPE_TEXT, trans('pages/diplome.titre')),
            new Head('secteur', Head::TYPE_TEXT, trans('pages/diplome.secteur')),
            new Head('dateDebut', Head::TYPE_DATE, trans('pages/diplome.dateDebut')),
            new Head('dateFin', Head::TYPE_DATE, trans('pages/diplome.dateFin')),
            new Head('niveau', Head::TYPE_TEXT, trans('pages/diplome.niveau')),
            new Head('score', Head::TYPE_TEXT, trans('pages/diplome.score')),
            new Head('mention', Head::TYPE_TEXT, trans('pages/diplome.mention')),
            new Head('ville', Head::TYPE_TEXT, trans('pages/diplome.ville')),
            new Head('pays', Head::TYPE_TEXT, trans('pages/diplome.pays')),
            new Head('type', Head::TYPE_OPTIONS, trans('pages/diplome.type'), [
                'C' => trans('pages/diplome.C'),
                'B' => trans('pages/diplome.B'),
                'D' => trans('pages/diplome.D'),
                'A' => trans('pages/diplome.A'),
                'S' => trans('pages/diplome.S'),
                'At' => trans('pages/diplome.At'),
                'P' => trans('pages/diplome.P'),
            ]),
            new Head('diplomeJoint', Head::TYPE_IMG, trans('pages/diplome.diplomeJoint')),


        ];

        $collection = ModelTarget::query()->where('profil','=',$profil)->get();
        $code='dip';
        $model = Profil::query()->findOrFail($profil);
        
        return view('crud.profil.edit', compact(['actions', 'heads', 'collection','code','model']));
    }

    /***
     * Page create
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create($profil)
    {
        return view('crud.diplomes.create',compact('profil'));
    }

    /***
     * Page edit
     * @param Request $request
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(Request $request, $id)
    {
        $model = ModelTarget::query()->findOrFail($id);
        return view('crud.diplomes.edit', [
            'model' => $model,
            
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
    public function store(AddDiplomeRequest $request)
    {
        $validated = $request->validated();
        $logoOrganisme = $request->validated()['logoOrganisme'] ?? null;
        $diplomeJoint = $request->validated()['diplomeJoint'] ?? null;
        unset($validated['logoOrganisme']);
        unset($validated['diplomeJoint']);
        
        $model = ModelTarget::query()->create($validated);
        $fullPath = "/genereteurCv/profils/".$model["profil"];
        if($diplomeJoint){

            $path = $diplomeJoint->store($fullPath.'/diplomes'.'/'.$model["idE"].' '. 'logo', 'public');
        }
       
       
        $model->update([
            'logoOrganisme' => $this->saveFile($fullPath.'/diplomes'.'/'.$model["idD"].' '. 'logo', file: $logoOrganisme),
            'diplomeJoint' =>  $path ?? null,
        ]);
        $this->success(text: trans('messages.added_message'));
        return redirect(route('profils.show',$model['profil']));
    }

    public function download( Request $request)
    {
        $id = $request->get('idD') ?? null;
        $path=ModelTarget::find($id)->diplomeJoint;
        // dd($path);
        if($path){ 
            return Storage::disk('public')->download($path);  
        }
        return back();
    }
    /***
     * Update record if exists
     * @param Add $request
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws FilesystemException
     */
    public function update(AddDiplomeRequest $request, $id)
    {

        $model = ModelTarget::query()->findOrFail($id);

        $validated = $request->validated();
        $diplomeJoint = $request->validated()['diplomeJoint'] ?? null;

        unset($validated['logoOrganisme']);
        unset($validated['diplomeJoint']);

        $this->saveAndDeleteOld($request->validated()['logoOrganisme'] ?? null, 'diplomes', $model, 'logoOrganisme');
        $fullPath = "/genereteurCv/profils/".$model["profil"];
        if($diplomeJoint){

            $path = $diplomeJoint->store($fullPath.'/diplomes'.'/'.$model["idE"].' '. 'logo', 'public');
            $validated['diplomeJoint']=$path;
        }
       
        $model->update($validated);

        $this->success(text: trans('messages.updated_message'));
        return redirect(route('profils.show',$model['profil']));
    }
}
