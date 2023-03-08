<?php

namespace App\Http\Requests\Panel\Project;

use Illuminate\Foundation\Http\FormRequest;

class StoreProjectRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', 'unique:projects'],
            'url' => ['required', 'url', 'max:255'],
            'image' => ['image', 'mimes:png,jpg,jpeg', 'max:2048'],
            'short_description' => ['required'],
            'description' => ['required']
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'name' => __('content.panel.projects.labels.name'),
            'slug' => __('content.panel.projects.labels.slug'),
            'url' => __('content.panel.projects.labels.url'),
            'image' => __('content.panel.projects.labels.slug'),
            'short_description' => __('content.panel.projects.labels.short_description'),
            'description' => __('content.panel.projects.labels.description')
        ];
    }
}
