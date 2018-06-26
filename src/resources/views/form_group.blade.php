<div class="form-group">
	<label class="col-form-label">{{ $field['label'] }}</label>
	<input 
		class="form-control" 
		name="{{ $field['id'] }}" 
		value="{{ $field['value'] }}"
		{{ $field['disabled'] ? ' disabled' : '' }} />
</div>