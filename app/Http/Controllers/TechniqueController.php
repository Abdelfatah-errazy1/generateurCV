<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Helpers\Components\Head;
use App\Helpers\Components\Action;
use App\Models\Technique as ModelTarget;
use App\Http\Requests\AddTechRequest;
class TechniqueController extends Controller
{
    
    /***
     * Page create
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create($experience)
    {
        return view('crud.techniques.create',compact('experience'));
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
        return view('crud.techniques.edit', [
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
    public function store(AddTechRequest $request)
    {
       

            $validated = $request->validated();
            $logoTech = $request->validated()['logoTech'] ?? null;
            unset($validated['logoTech']);
            // dd($logoTech);
            $model = ModelTarget::query()->create($validated);
            $model->update([
                'logoTech' => $this->saveFile('techniques', file: $logoTech)
            ]);
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
    public function update(AddTechRequest $request, $id)
    {
        $model = ModelTarget::query()->findOrFail($id);

        $validated = $request->validated();
        unset($validated['logoTech']);

        $this->saveAndDeleteOld($request->validated()['logoTech'] ?? null, 'experiences', $model, 'logoTech');
        $model->update($validated);


        $this->success(text: trans('messages.updated_message'));
        return redirect(route('experiences.show',$model['experience']));
    }

}
