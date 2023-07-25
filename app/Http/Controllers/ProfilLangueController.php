<?php

namespace App\Http\Controllers;

use App\Models\Langue;
use App\Models\Profil;
use Illuminate\Http\Request;
use App\Helpers\Components\Head;
use App\Http\Requests\addQualite;
use App\Helpers\Components\Action;
use App\Http\Requests\Clients\Add;
use App\Http\Requests\Clients\edit;
use PhpParser\Node\Expr\AssignOp\Mod;

use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;
use League\Flysystem\FilesystemException;
use App\Models\ProfilLangue as ModelTarget;
use App\Http\Requests\AddProfilLangueRequest;

class ProfilLangueController extends Controller
{
    /***
     *  page index
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    protected function index($profil)
    {
        $actions = [
            new Action(ucwords(trans('words.add')), Action::TYPE_NORMAL, url: route('profilLangues.create',$profil)),
            new Action(ucwords(trans('words.delete_all')), Action::TYPE_DELETE_ALL, url: route('profilLangues.destroyGroup'))
        ];
        $heads = [
            new Head('langue', Head::TYPE_TEXT, trans('words.langue')),
            new Head('niveau', Head::TYPE_TEXT, trans('words.niveau')),

        ];

       
        // $collection = ModelTarget::query()->where('profil','=',$profil)->get();\


        $collection = ModelTarget::query()
        ->join('langues', 'langues.idL', 'profillangue.langue')
        ->where('profil', '=', $profil)
        ->select('profillangue.*' , 'langues.nom as langue')
        ->get();

        $code='lang';
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
        $langues=Langue::all();
        $langueProfil=ModelTarget::query()->where('profil','=',$profil)->get();
        // dd($langues);
        return view('crud.profilLangues.create',compact('profil','langues','langueProfil'));
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
        return view('crud.profilLangues.edit', [
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
        return redirect()->route('profils.show',$model['profil']);
    }

    /***
     * Add a new record
     * @param Add $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws FilesystemException
     */
    public function store(Request $request)
    {
        ModelTarget::query()->where('profil','=',$request->profil)->delete();
        $language=$request->language;
        $level=array_filter($request->level,function($level) {
            return $level != 0;
        });
        if($language){

            foreach ($language as $index => $value) {
                if(isset($level[$index])){
                    $val=[
                        'profil'=>$request->profil,
                        'langue'=>$value,
                        'niveau'=>$level[$index]
                        
                    ];
                $rules=[
                    'profil'=>'nullable',
                    'langue'=>'required',
                    'niveau'=>'required|max:5|min:1'
                    
                ];
                $validator = Validator::make($val, $rules);
                if ($validator->fails()) {
                    return back();
                } else {
                    $model= ModelTarget::query()->create($val);
                }
                }
            } 
            $this->success(text: trans('messages.added_message'));
            return redirect(route('profils.show',$model['profil']));
        }

       
        return back()->with(['message'=>'you must add a langue at least']);
    }

    /***
     * Update record if exists
     * @param Add $request
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws FilesystemException
     */
    public function update(addQualite $request, $id)
    {

        $model = ModelTarget::query()->findOrFail($id);

        $validated = $request->validated();
       

        $model->update($validated);

        $this->success(text: trans('messages.updated_message'));
        return redirect(route('profils.show',$model['profil']));
    }

}

