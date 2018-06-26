<?php
namespace Tichnut\EloquentForm;
 
use App\Http\Controllers\Controller;
 
class EloquentFormController extends Controller
{
	/**
	 * @param [mixed] $model The Eloquent Model being used to generate the form
	 */
	public function __construct($model)
	{
		$this->model = $model;
	}

    public function generate()
    {

    	 foreach($this->model->getAttributes() as $key => $value):
    		if(in_array($key, $this->model->getHidden())) continue;
    		if(in_array($key, $this->model->ef_hide ?? [])) continue;
    		if($key == 'id') continue;

		    $form_data['fields'][] = [
		    	'id' => $key,
		    	'label' => ucwords(str_replace('_', ' ', $key)),
		    	'value' => $value,
		    	'disabled' => in_array($key, $this->model->ef_disabled ?? []),
		    ];
		endforeach;


        return view('eloquent_form::form', compact('form_data'))->render();
    }
 
}