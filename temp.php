		<form class='form-horizontal' id='enterreqform' action='enterreq.php'>
			<div class='control-group'>
				<label class='control-label' for='company'>Company name : </label>
				<div class='controls'>
					<input type='text' name='company'/>
				</div>
			</div>
			<div class='control-group'>
				<label class='control-label' for='address'>Address : </label>
				<div class='controls'>
					<textarea name='address'></textarea>
				</div>
			</div>
			<div class='control-group'>
				<label class='control-label' for='name'>Name of person : </label>
				<div class='controls'>
					<input type='text' name='name'/>
				</div>
			</div>
			<div class='control-group'>
				<label class='control-label' for='phone'>Contact number : </label>
				<div class='controls'>
					<input type='text' name='phone'/>
				</div>
			</div>
			<div class='control-group'>
				<label class='control-label' for='mailid'>Email id : </label>
				<div class='controls'>
					<input type='text' name='mailid'/>
				</div>
			</div>
			<div class='control-group'>
				<label class='control-label' for='req'>Requirements : </label>
				<div class='controls'>
					<textarea name='req'></textarea>
				</div>
			</div>
			<div class='control-group'>
				<div class='controls'>
					<button type='submit' class='btn btn-success' name='submit'>Submit</button>
				</div>
			</div>
		</form>

		<form class='form-horizontal' id='seeeligibleform' action='showcandidates.php'>
			<div class='control-group'>
				<label class='control-label' for='uid'>Enter your unique id : </label>
				<div class='controls'>
					<input type='text' name='uid'/>
				</div>
			</div>
			<div class='control-group'>
				<div class='controls'>
					<button type='submit' class='btn btn-success' name='submit'>Show eligible candidates</button>
				</div>
			</div>
		</form>



--------------------------------------------------------------------------------------------------------------------------------------









		<form class='form-horizontal' id='entryform' action='upload.php'>
			<div class='control-group'>
				<label class='control-label' for='name'>Name : </label>
				<div class='controls'>
					<input type='text' name='name'/>
				</div>
			</div>
			<div class='control-group'>
				<label class='control-label' for='address'>Address : </label>
				<div class='controls'>
					<textarea name='address'></textarea>
				</div>
			</div>
			<div class='control-group'>
				<label class='control-label' for='phone'>Contact number : </label>
				<div class='controls'>
					<input type='text' name='phone'/>
				</div>
			</div>
			<div class='control-group'>
				<label class='control-label' for='mailid'>Email id : </label>
				<div class='controls'>
					<input type='text' name='mailid'/>
				</div>
			</div>
			<div class='control-group'>
				<label class='control-label' for='lang'>Languages known : </label>
				<div class='controls'>
					<textarea name='lang'></textarea>
				</div>
			</div>

			<div class='control-group'>
				<label class='control-label' for='skills'>Technical skills : </label>
				<div class='controls'>
					<textarea name='skills'></textarea>
				</div>
			</div>
			<div class='control-group'>
				<label class='control-label' for='achieve'>Achievements : </label>
				<div class='controls'>
					<textarea name='achieve'></textarea>
				</div>
			</div>
			<div class='control-group'>
				<label class='control-label' for='interest'>Field of interest : </label>
				<div class='controls'>
					<textarea name='interest'></textarea>
				</div>
			</div>
			<div class='control-group'>
				<label class='control-label' for='other'>Other talents : </label>
				<div class='controls'>
					<textarea name='other'></textarea>
				</div>
			</div>
			<div class='control-group'>
				<label class='control-label' for='hobbies'>Hobbies : </label>
				<div class='controls'>
					<textarea name='hobbies'></textarea>
				</div>
			</div>
			<div class='control-group'>
				<div class='controls'>
					<button type='submit' class='btn btn-success' name='submit'>Submit</button>
				</div>
			</div>
		</form>
<br/>
<center>
(OR)
<br/>
<br/>
<div class="fileupload fileupload-new" data-provides="fileupload">
<div class="input-append">
<div class="uneditable-input span3"><i class="icon-file fileupload-exists"></i> <span class="fileupload-preview"></span></div><span class="btn btn-file"><span class="fileupload-new">Select file</span><span class="fileupload-exists">Change</span><input type="file" /></span><a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a>
</div>
</div>
<button type='submit' class='btn btn-danger' name='submit'>Upload</button>
</center>