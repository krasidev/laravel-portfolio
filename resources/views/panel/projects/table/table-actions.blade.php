<div class="btn-group btn-group-sm" role="group">
    @if ($project->trashed())
        <a href="{{ route('panel.projects.restore', ['project' => $project->id]) }}" data-dt-toggle="tooltip" data-placement="top" title="{{ __('content.panel.projects.buttons.restore') }}" class="btn dt-bt-restore">
            <i class="fas fa-trash-restore text-success"></i>
        </a>
        <a href="{{ route('panel.projects.force-delete', ['project' => $project->id]) }}" data-dt-toggle="tooltip" data-placement="top" title="{{ __('content.panel.projects.buttons.destroy') }}" class="btn dt-bt-delete">
            <i class="fas fa-trash text-danger"></i>
        </a>
    @else
        <a href="{{ route('panel.projects.edit', ['project' => $project->id]) }}" data-dt-toggle="tooltip" data-placement="top" title="{{ __('content.panel.projects.buttons.update') }}" class="btn">
            <i class="fas fa-edit text-primary"></i>
        </a>
        <a href="{{ route('panel.projects.destroy', ['project' => $project->id]) }}" data-dt-toggle="tooltip" data-placement="top" title="{{ __('content.panel.projects.buttons.destroy') }}" class="btn dt-bt-delete">
            <i class="fas fa-trash text-warning"></i>
        </a>
    @endif
</div>