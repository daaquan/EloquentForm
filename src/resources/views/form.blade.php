<form id="model-form">
	@foreach ($form_data['fields'] as $field)
		@include('eloquent_form::form_group')
	@endforeach
	<div class="form-group">
		<button id="model-form-submit" class="btn btn-success">Save</button>
		<button id="model-form-delete" class="btn btn-danger">Delete</button>
	</div>
</form>

<script>
let model_form = {
	form: document.getElementById('model-form'),
	submit_btn: document.getElementById('model-form-submit'),
	delete_btn: document.getElementById('model-form-delete'),
	save_url: @json($model->save_url ?? null),
	path_parts: location.pathname.split('/'),
	render_save_url() {
		if(!this.save_url) {
			this.save_url = this.path_parts[4];
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
	delete() {
		let self = this;
		if(confirm('Are you sure you want tot delete this item?')){
			$.ajax({
				url: this.save_url,
				method: 'delete',
				success() {
					//go back to the root models page
					location.href = self.path_parts.slice(0, -1).join('/')
				}
			})
		}
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

		this.delete_btn.onclick = (e) => {
			self.delete();
		}

		//render save url
		this.render_save_url();
	}
}

model_form.init();
</script>