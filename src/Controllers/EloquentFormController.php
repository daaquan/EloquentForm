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
        return view('eloquent_form::form', ['model' => $this->model])->render();
    }
 
}