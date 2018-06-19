<?php
namespace Tichnut\Formalize;
 
use App\Http\Controllers\Controller;
 
class FormalizeController extends Controller
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
        return view('formalize::form', ['model' => $this->model])->render();
    }
 
}