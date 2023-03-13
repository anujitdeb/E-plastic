<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GlobalSettingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        if(auth('admin')->user()->can('setting.view')){
            return true;
        }else{
            return false;
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'site_name' => 'required',
            'site_title' => 'required',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'favicon' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'site_email' => 'nullable|email',
            'site_phone' => 'nullable|numeric',
            'site_address' => 'nullable',
            'facebook' => 'nullable|url',
            'twitter' => 'nullable|url',
            'instagram' => 'nullable|url',
            'youtube' => 'nullable|url',
            'linkedin' => 'nullable|url',
            'pinterest' => 'nullable|url',
        ];
    }

    public function messages(): array
    {
        return [
            'site_name.required' => 'Site Name is required',
            'site_title.required' => 'Site Title is required',
            'logo.image' => 'Logo must be image',
            'logo.mimes' => 'Logo must be image of type jpeg, png, jpg, gif, svg',
            'logo.max' => 'Logo must be less than 2 MB',
            'favicon.image' => 'Favicon must be image',
            'favicon.mimes' => 'Favicon must be image of type jpeg, png, jpg, gif, svg',
            'favicon.max' => 'Favicon must be less than 2 MB',
            'site_email.email' => 'Email is invalid',
            'site_phone.numeric' => 'Phone must be numeric',
            'facebook.url' => 'Facebook url is invalid',
            'twitter.url' => 'Twitter url is invalid',
            'instagram.url' => 'Instagram url is invalid',
            'youtube.url' => 'Youtube url is invalid',
            'linkedin.url' => 'Linkedin url is invalid',
            'pinterest.url' => 'Pinterest url is invalid',
        ];
    }
}
