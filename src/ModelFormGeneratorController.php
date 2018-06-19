<?php
namespace Tichnut\ModelFormGenerator;
 
use App\Http\Controllers\Controller;
 
class ModelFormGeneratorController extends Controller
{
	/**
	 * @param [mixed] $model The Eloquent Model being used to generate the form
	 */
	public function __construct($model)
	{
		$this->model = $model;
	}

    public function generate($timezone)
    {
        foreach($model->getAttributes() as $key => $value):
        	
        endforeach;
    }
 
}