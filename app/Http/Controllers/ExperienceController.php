<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Tache;
use App\Models\Profil;
use App\Models\Country;
use Illuminate\Http\Request;
use App\Helpers\Components\Head;
use App\Helpers\Components\Action;
use Illuminate\Support\Facades\Storage;
use App\Models\Experience as ModelTarget;
use League\Flysystem\FilesystemException;
use App\Http\Requests\AddExperienceRequest;
use App\Models\Technique;

class ExperienceController extends Controller
{

    /***
     *  page index
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    protected function index($profil)
    {

//        User::factory(1)->create();

        $actions = [
            new Action(ucwords(trans('words.add')), Action::TYPE_NORMAL, url: route('experiences.create',$profil)),
            new Action(ucwords(trans('words.delete_all')), Action::TYPE_DELETE_ALL, url: route('experiences.destroyGroup'))
        ];
        $heads = [
            new Head('logoEntreprise', Head::TYPE_IMG, trans('pages/Experiences.logoEntreprise')),
            new Head('titrePoste', Head::TYPE_TEXT, trans('pages/Experiences.titrePoste')),
            new Head('missionP', Head::TYPE_TEXT, trans('pages/Experiences.missionP')),
            new Head('dateDebut', Head::TYPE_DATE, trans('pages/Experiences.dateDebut')),
            new Head('dateFin', Head::TYPE_DATE, trans('pages/Experiences.dateFin')),
            new Head('entreprise', Head::TYPE_TEXT, trans('pages/Experiences.entreprise')),
            new Head('adresse', Head::TYPE_TEXT, trans('pages/Experiences.adresse')),
            new Head('ville', Head::TYPE_TEXT, trans('pages/Experiences.ville')),
            new Head('pays', Head::TYPE_TEXT, trans('pages/Experiences.pays')),
            new Head('type', Head::TYPE_OPTIONS, trans('pages/Experiences.type'), [
                'S' => trans('pages/Experiences.S'),
                'CDI' => trans('pages/Experiences.CDI'),
                'CDD' => trans('pages/Experiences.CDD'),
                'L' => trans('pages/Experiences.L'),
                'V' => trans('pages/Experiences.V'),
                'B' => trans('pages/Experiences.B'),
                'AE' => trans('pages/Experiences.AE'),
            ]),
            new Head('jointureDip', Head::TYPE_TEXT, trans('words.jointureDip')),


        ];

        $collection = ModelTarget::query()->where('profil','=',$profil)->get();
        $code='exp';
        $model = Profil::query()->findOrFail($profil);
        
        return view('crud.profil.edit', compact(['actions', 'heads', 'collection','code','model']));
    }

    /***
     * Page create
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create($profil)
    {
        return view('crud.Experience.create',compact('profil'));
    }

    /***
     * Page edit
     * @param Request $request
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(Request $request, $id)
    {
        

        $actionsTa = [
            new Action(ucwords(trans('words.add')), Action::TYPE_NORMAL, url: route('taches.create',$id)),
            new Action(ucwords(trans('words.delete_all')), Action::TYPE_DELETE_ALL, url: route('taches.destroyGroup'))
        ];
        $headsTa = [
            new Head('titre', Head::TYPE_TEXT, trans('words.titre')),
            new Head('description', Head::TYPE_TEXT, trans('words.description')),


        ];

        $taches = Tache::query()->where('experience','=',$id)->get();

        $actionsTe = [
            new Action(ucwords(trans('words.add')), Action::TYPE_NORMAL, url: route('techniques.create',$id)),
            new Action(ucwords(trans('words.delete_all')), Action::TYPE_DELETE_ALL, url: route('techniques.destroyGroup'))
        ];
        $headsTe= [
            new Head('logoTech', Head::TYPE_IMG, trans('words.logo')),
            new Head('titre', Head::TYPE_TEXT, trans('words.titre')),
            new Head('description', Head::TYPE_TEXT, trans('words.description')),
        ];

        $techniques = Technique::query()->where('experience','=',$id)->get();


      

       

       
        $model = ModelTarget::query()->findOrFail($id);
        return view('crud.Experience.edit', [
            'model' => $model,
            'taches' => $taches,
            'techniques' => $techniques,
            'actionsTa' => $actionsTa,
            'actionsTe' => $actionsTe,
            'headsTa' => $headsTa,
            'headsTe' => $headsTe,
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
    public function store(AddExperienceRequest $request)
    {
        $validated = $request->validated();
        $logoEntreprise = $request->validated()['logoEntreprise'] ?? null;
        $jointureDip = $request->validated()['jointureDip'] ?? null;
        unset($validated['logoEntreprise'],$validated['jointureDip']);
        
        $model = ModelTarget::query()->create($validated);
        $fullPath = "/genereteurCv/profils/".$model["profil"];
        if($jointureDip){

            $path = $jointureDip->store($fullPath.'/diplomes'.'/'.$model["idE"].' '. 'logo', 'public');
        }
       
        $model->update([
            'jointureDip' => $path ?? null,
            'logoEntreprise' => $this->saveFile($fullPath.'/experiences'.'/'.$model["idE"].' '. 'logo', file: $logoEntreprise)
        ]);
        $this->success(text: trans('messages.added_message'));
        return redirect(route('experiences.show',$model['idE']));
    }

    public function download( Request $request)
    {
        $id = $request->get('idE') ?? null;
        $path=ModelTarget::find($id)->jointureDip;
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
    public function update(AddExperienceRequest $request, $id)
    {

        $model = ModelTarget::query()->findOrFail($id);

        $validated = $request->validated();
        

        $jointureDip = $request->validated()['jointureDip'] ?? null;
        unset($validated['logoEntreprise'],$validated['jointureDip']);

        $this->saveAndDeleteOld($request->validated()['logoEntreprise'] ?? null, 'experiences', $model, 'logoEntreprise');
        $fullPath = "/genereteurCv/profils/".$model["profil"];
        if($jointureDip){
            $path = $jointureDip->store($fullPath.'/diplomes'.'/'.$model["idE"].' '. 'logo', 'public');
            $validated['jointureDip']=$path;
        }
        $model->update($validated);

        $this->success(text: trans('messages.updated_message'));
        return redirect(route('experiences.show',$model['idE']));
    }
}
