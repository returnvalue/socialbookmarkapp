<?php namespace Phpleaks\Http\Requests;

use Phpleaks\Http\Requests\Request;

class LinkUpdateFormRequest extends Request
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if (\Auth::check()) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        $this->sanitize();

        return [
            'name' => 'required',
            'url' => 'required|url',
            'category' => 'required|integer|min:1',
            'description' => 'required|max:500',
            'tags' => 'required'
        ];
    }

    /**
     * Sanitize the link input
     * @return [type] [description]
     */
    public function sanitize()
    {
        $input = $this->all();

        if (preg_match("#https?://#", $input['url']) === 0) {
            $input['url'] = 'http://'.$input['url'];
        }

        $input['name'] = filter_var($input['name'], FILTER_SANITIZE_STRING);
        $input['description'] = filter_var($input['description'], FILTER_SANITIZE_STRING);

        $this->replace($input);
    }


    public function messages()
    {
        return [
            'name.required' => 'Please provide a brief link description',
            'url.required' => 'Please provide a URL',
            'url.url' => 'A valid URL is required',
            'url.unique' => 'This URL has already been submitted',
            'category.required' => 'Please associate this link with a category',
            'category.min' => 'Please associate this link with a category',
            'description.required' => 'A description is required',
            'description.max' => 'The description can\'t be longer than 300 characters',
            'tags.required' => 'Please choose at least one tag'
        ];
    }

}
