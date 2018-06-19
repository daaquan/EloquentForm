<form id="model-form">
	@foreach ($model->getAttributes() as $key => $value)
		@continue(in_array($key, $model->getHidden()))
		<div class="form-group">
			<label class="col-form-label">{{ ucwords(str_replace('_', ' ', $key)) }}</label>
			<input class="form-control" name="{{ $key }}" id="{{ $key }}" value="{{ $value }}"{{ $key == 'id' ? ' disabled' : '' }} />
		</div>
	@endforeach
	<div class="form-group">
		<button id="model-form-submit" class="btn btn-success">Save</button>
	</div>
</form>

<script>
let model_form = {
	form: document.getElementById('model-form'),
	submit_btn: document.getElementById('model-form-submit'),
	save_url: @json($model->save_url ?? null),
	render_save_url() {
		if(!this.save_url) {
			let path_parts = location.pathname.split('/')
			this.save_url = path_parts[4];
		}
	},
	save() {

		let form_data = {};

		for(var i in this.form.elements) {
			let element = this.form.elements[i];
			form_data[element.name] = element.value;
		}

		$.ajax({
			url: this.save_url,
			method: 'post',
			data: form_data
		})
	},
	init() {
		let self = this;
		//stop form default submit
		this.form.onsubmit = (e) => {
			e.preventDefault();
		}

		this.submit_btn.onclick = (e) => {
			self.save();
		}

		//render save url
		this.render_save_url();
	}
}

model_form.init();
</script>