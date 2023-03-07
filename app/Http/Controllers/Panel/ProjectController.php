<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Http\Requests\Panel\Project\StoreProjectRequest;
use App\Http\Requests\Panel\Project\UpdateProjectRequest;
use App\Models\Project;
use App\Repository\Panel\ProjectRepository;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    private $repository;

    public function __construct(ProjectRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return $this->repository->data($request->all());
        }

        return view('panel.projects.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('panel.projects.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Panel\Project\StoreProjectRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProjectRequest $request)
    {
        $project = $this->repository->create($request->only(['name', 'slug', 'url', 'short_description', 'description']));

        if ($request->hasFile('image')) {
            $image = $project->id . '.' . $request->image->extension();
            $request->image->move(public_path(Project::IMAGE_PATH), $image);

            $project->update([
                'image' => $image
            ]);
        }

        return redirect()->route('panel.projects.index')
            ->with('success', [
                'title' => __('messages.panel.projects.store_success.title'),
                'text' => __('messages.panel.projects.store_success.text')
            ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $project = $this->repository->find($id);

        return view('panel.projects.edit', compact('project'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Panel\Project\UpdateProjectRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProjectRequest $request, $id)
    {
        $data = $request->only(['name', 'slug', 'url', 'short_description', 'description']);

        if ($request->hasFile('image')) {
            $data['image'] = $id . '.' . $request->image->extension();
            $request->image->move(public_path(Project::IMAGE_PATH), $data['image']);
        }

        $this->repository->update($data, $id);

        return redirect()->route('panel.projects.index')
            ->with('success', [
                'title' => __('messages.panel.projects.update_success.title'),
                'text' => __('messages.panel.projects.update_success.text'),
            ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->repository->delete($id);
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        return $this->repository->restore($id);
    }

    /**
     * Force delete the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function forceDelete($id)
    {
        return $this->repository->forceDelete($id);
    }
}
