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
    	$attributes = $this->get_table_columns($this->model);

    	foreach($attributes as $key => $value):
    		if($this->skip_fields($key)) continue;
		    $form_data['fields'][] = $this->build_field($key, $value);
		endforeach;

        return view('eloquent_form::form', compact('form_data'))->render();
    }

    private function get_table_columns($model) 
    {
        $columns = $model->getConnection()->getSchemaBuilder()->getColumnListing($model->getTable());
        return $columns;
    }

    /**
     * Fields that should be skipped when
     * the fileds are built
     * @param  string $attribute model attribute
     * @return boolean      [description]
     */
    private function skip_fields($attribute)
    {
		if(in_array($attribute, $this->model->getHidden())) return true;
		if(in_array($attribute, $this->model->ef_hide ?? [])) return true;
		if($attribute == 'id') return true;

		return false;
    }

    private function build_field($attribute, $value = '')
    {
    	return [
	    	'id' => $attribute,
	    	'label' => ucwords(str_replace('_', ' ', $attribute)),
	    	'value' => $value,
	    	'disabled' => in_array($attribute, $this->model->ef_disabled ?? [])
    	];
    }
 
}