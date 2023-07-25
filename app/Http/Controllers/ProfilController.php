<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Profil;
use App\Models\Country;
use App\Models\diplome;
use App\Models\Loisire;
use App\Models\Qualite;
use App\Models\Competence;
use App\Models\Experience;
use App\Models\ProfilLangue;
use Illuminate\Http\Request;
use App\Helpers\Components\Head;
use App\Helpers\Components\Action;
use App\Models\Profil as ModelTarget;
use App\Http\Requests\AddProfilRequest;
use League\Flysystem\FilesystemException;
use App\Http\Requests\UpdateProfilRequest;

class ProfilController extends Controller
{

    /***
     *  page index
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    protected function index()
    {

//        User::factory(1)->create();

        $actions = [
            new Action(ucwords(trans('words.add')), Action::TYPE_NORMAL, url: route('profils.create')),
            new Action(ucwords(trans('words.delete_all')), Action::TYPE_DELETE_ALL, url: route('profils.destroyGroup'))
        ];
        $heads = [
            new Head('avatar', Head::TYPE_IMG, trans('pages/profils.avatar')),
            new Head('cin', Head::TYPE_TEXT, trans('pages/profils.cin')),
            new Head('nom', Head::TYPE_TEXT, trans('pages/profils.nom')),
            new Head('prenom', Head::TYPE_TEXT, trans('pages/profils.prenom')),
            new Head('genre', Head::TYPE_OPTIONS, trans('pages/profils.gender'), [
                'H' => trans('words.man'),
                'F' => trans('words.woman'),
            ]),
            new Head('civilite', Head::TYPE_OPTIONS, trans('pages/profils.civilite'), [  
                'C' => trans('words.celibataire'),
                'M' =>  trans('words.marie'),
                'D' =>  trans('words.divorce'),
                'V' =>  trans('words.veuf'),  
             ]),
            new Head('etat', Head::TYPE_OPTIONS, trans('pages/profils.etat'), [  
                'O' => trans('words.yes'),
                'N' =>  trans('words.no'),
             ]),
            // new Head('civilite', Head::TYPE_TEXT, trans('pages/profils.civilite')),
            new Head('dateNaissance', Head::TYPE_DATE, trans('pages/profils.dateNaissance')),
            new Head('titre', Head::TYPE_TEXT, trans('pages/profils.titre')),
            new Head('sousTitre', Head::TYPE_TEXT, trans('pages/profils.sousTitre')),
            new Head('gsm1', Head::TYPE_TEXT, trans('pages/profils.gsm1')),
            new Head('gsm2', Head::TYPE_TEXT, trans('pages/profils.gsm2')),
            new Head('email', Head::TYPE_TEXT, trans('pages/profils.email')),
            new Head('linkden', Head::TYPE_TEXT, trans('pages/profils.linkden')),
            new Head('facebook', Head::TYPE_TEXT, trans('pages/profils.facebook')),
            new Head('instagram', Head::TYPE_TEXT, trans('pages/profils.instagram')),
            new Head('siteWeb', Head::TYPE_TEXT, trans('pages/profils.siteWeb')),
            new Head('adresse', Head::TYPE_TEXT, trans('pages/profils.adresse')),
            new Head('ville', Head::TYPE_TEXT, trans('pages/profils.ville')),
            new Head('pays', Head::TYPE_TEXT, trans('pages/profils.pays')),
            new Head('observation', Head::TYPE_TEXT, trans('pages/profils.observation')),
            // new Head('etat', Head::TYPE_TEXT, trans('pages/profils.etat')),

        ];

        $collection = ModelTarget::all();

        return view('crud.profil.index', compact(['actions', 'heads', 'collection']));
    }

    /***
     * Page create
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
      
        return view('crud.profil.create');
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
        $code=false;
        // dd($id);
        $diplomes=diplome::query()->where('profil',$id)->get();
        $diplomes = diplome::query()
        ->join('secteursspects', 'secteursspects.idS', 'diplomes.secteur')
        ->where('profil', '=', $id)
        ->select('diplomes.*' , 'secteursspects.nom as secteur')
        ->get();
        $actionsD = [
            new Action(ucwords(trans('words.add')), Action::TYPE_NORMAL, url: route('diplomes.create',$id)),
            new Action(ucwords(trans('words.delete_all')), Action::TYPE_DELETE_ALL, url: route('diplomes.destroyGroup'))
        ];
        $headsD = [
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


        ];


        $actionsE = [
            new Action(ucwords(trans('words.add')), Action::TYPE_NORMAL, url: route('experiences.create',$id)),
            new Action(ucwords(trans('words.delete_all')), Action::TYPE_DELETE_ALL, url: route('experiences.destroyGroup'))
        ];
        $headsE = [
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


        ];

        $experiences = Experience::query()->where('profil','=',$id)->get();

        $actionsL = [
            new Action(ucwords(trans('words.add')), Action::TYPE_NORMAL, url: route('loisirs.create',$id)),
            new Action(ucwords(trans('words.delete_all')), Action::TYPE_DELETE_ALL, url: route('loisirs.destroyGroup'))
        ];
        $headsL = [
            new Head('logo', Head::TYPE_IMG, trans('pages/loisirs.logo')),
            new Head('titre', Head::TYPE_TEXT, trans('pages/loisirs.titre')),
            new Head('description', Head::TYPE_TEXT, trans('pages/loisirs.description')),
        ];

        $loisirs = Loisire::query()->where('profil','=',$id)->get();

        $actionsQ = [
            new Action(ucwords(trans('words.add')), Action::TYPE_NORMAL, url: route('qualites.create',$id)),
            new Action(ucwords(trans('words.delete_all')), Action::TYPE_DELETE_ALL, url: route('qualites.destroyGroup'))
        ];
        $headsQ = [
            new Head('titre', Head::TYPE_TEXT, trans('pages/qualites.titre')),

        ];

       
        $qualites = Qualite::query()->where('profil','=',$id)->get();

        $actionsLang = [
            new Action(ucwords(trans('words.add')), Action::TYPE_NORMAL, url: route('profilLangues.create',$id)),
            new Action(ucwords(trans('words.delete_all')), Action::TYPE_DELETE_ALL, url: route('profilLangues.destroyGroup'))
        ];
        $headsLang = [
            new Head('langue', Head::TYPE_TEXT, trans('words.langue')),
            new Head('niveau', Head::TYPE_TEXT, trans('words.niveau')),

        ];

       
        // $collection = ModelTarget::query()->where('profil','=',$profil)->get();\


        $langues = ProfilLangue::query()
        ->join('langues', 'langues.idL', 'profillangues.langue')
        ->where('profil', '=', $id)
        ->select('profillangues.*' , 'langues.nom as langue')
        ->get();

        $actionsC = [
            new Action(ucwords(trans('words.add')), Action::TYPE_NORMAL, url: route('competences.create',$id)),
            new Action(ucwords(trans('words.delete_all')), Action::TYPE_DELETE_ALL, url: route('competences.destroyGroup'))
        ];
        $headsC = [
            new Head('titre', Head::TYPE_TEXT, trans('pages/competences.titre')),
            new Head('level', Head::TYPE_TEXT, trans('pages/competences.level')),
            new Head('description', Head::TYPE_TEXT, trans('pages/competences.description')),
        ];

        $competences = Competence::query()->where('profil','=',$id)
            ->get();
        return view('crud.profil.edit',
        compact(
            'model',
            'diplomes','actionsD','headsD',
            'experiences','actionsE','headsE',
            'loisirs','actionsL','headsL',
            'qualites','actionsQ','headsQ',
            'competences','actionsC','headsC',
            'langues','actionsLang','headsLang'));
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
        ModelTarget::query()->findOrFail($id)->delete();
        $this->success(trans('messages.deleted_message'));
        return redirect(route('profils.index'));
    }

    /***
     * Add a new record
     * @param Add $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws FilesystemException
     */
    public function store(AddProfilRequest $request)
    {
        $validated = $request->validated();
        $avatar = $request->validated()['avatar'] ?? null;
        unset($validated['avatar']);
     
        $model = ModelTarget::query()->create($validated);
        // $path = $avatar->store('profils', 'public');

        $model->update([
            'avatar' => $this->saveFile('profils', file: $avatar)
            // 'avatar' => $path
        ]);
        $this->success(text: trans('messages.added_message'));
        return redirect(route('profils.show',$model->id));
    }


    /***
     * Update record if exists
     * @param Add $request
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws FilesystemException
     */
    public function update(UpdateProfilRequest $request, $id)
    {

        $model = ModelTarget::query()->findOrFail($id);

        // unset($validated['avatar']);
        $validated = $request->validated();
                            
        // dd(444);
        unset($validated['avatar']);

        $this->saveAndDeleteOld($request->validated()['avatar'] ?? null, 'profils', $model, 'avatar');
        $model->update($validated);

        $this->success(text: trans('messages.updated_message'));
        return redirect(route('profils.show',$model['id']));
    }
}
