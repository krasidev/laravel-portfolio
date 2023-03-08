<?php

namespace App\Repository\Panel;

use App\Models\Project;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use LazyElePHPant\Repository\Repository;

class ProjectRepository extends Repository
{
    public function model()
    {
        return Project::class;
    }

    public function data($data)
    {
		$projects = $this->getModel()
			->select('projects.*')
            ->orderBy('order', 'desc');

        if (request()->trashed) {
            $projects->onlyTrashed();
        }

        $datatable = datatables()->eloquent($projects);

        $datatable->addColumn('actions', function($project) {
			return view('panel.projects.table.table-actions', compact('project'));
		});

        return $datatable->make(true);
    }

    public function create($data)
    {
        $data['slug'] = Str::slug($data['slug']);

        $project = $this->getModel()->create($data);

        $project->update([
            'order' => $project->id
        ]);

        return $project;
    }

    public function update(array $data, $id, $attribute = 'id')
    {
        $data['slug'] = Str::slug($data['slug']);

        $project = $this->getModel()->findOrFail($id);

        $project->update($data);

        return $project;
    }

    public function delete($id)
    {
        if ($this->getModel()->where('id', $id)->exists()) {
            return $this->getModel()->destroy($id);
        }
    }

    public function restore($id)
    {
        return $this->getModel()->withTrashed()->findOrFail($id)->restore();
    }

    public function forceDelete($id)
    {
        if ($this->getModel()->withTrashed()->where('id', $id)->exists()) {
            $project = $this->getModel()->withTrashed()->findOrFail($id);

            File::delete(public_path($project->imagePath));

            return $project->forceDelete();
        }
    }

    public function reorder($data)
    {
        $ids = [];

        foreach ($data as $position => $value) {
            $ids[$position] = $value[1];
        }

        $projects = $this->getModel()->whereIn('id', $ids)->pluck('order', 'id');

        if (count($projects)) {
            foreach ($data as $value) {
                $this->getModel()->findOrFail($value[0])->update([
                    'order' => $projects[$value[1]]
                ]);
            }
        }
    }
}
