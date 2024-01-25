                <!-- Upload Image Process -->
					<script>  
						$(document).ready(function(){
							
						// Image Preview  
							$upload_image_crop_process = $('#upload_image_preview').croppie({
								enableExif:true,
								viewport:{
									width:480,
									height:270,
									type:'square'
								},
								boundary:{
									width:530,
									height:320
								},
								showZoomer: true,
							});
						// Image Preview

						// Image Upload
							$('#upload_image_upload').change(function(){
								var reader = new FileReader();

								reader.onload = function(event){
								$upload_image_crop_process.croppie('bind', {
									url:event.target.result
								}).then(function(){
									console.log('jQuery bind complete');
								});
								}
								reader.readAsDataURL(this.files[0]);
							});
						// Image Upload

						// Crop & Form Button Hide
							$('#upload_image_upload').change(function(){
								// $('.upload_image_crop').show();
								$('#upload_image_preview').show();
								$('#upload_image_tc').hide();
								$('.upload_image_crop').removeAttr('disabled', '');
							});
							
							// $('.upload_image_crop').hide();
							$('.upload_image_crop').attr('disabled', '');
							$('#upload_image_form_submit').attr('disabled', '');
							$('#upload_image_preview').hide();
							// $('#upload_image_form_submit').hide();
						// Crop & Form Button Hide

						// Image Crop , Data Send & Received
							$('.upload_image_crop').click(function(event){
								$upload_image_crop_process.croppie('result', {
								type:'canvas',
								size: { width: 1920, height: 1080 }
								}).then(function(response){
								var _token = $('input[name=_token]').val();
								$.ajax({
									url:'{{ route("image.process") }}',
									type:'post',
									data:{"image":response, _token:_token},
									dataType:"json",
									success:function(data)
									{
									var image_display = '<img src="/'+data.temp_image+'" style="width:192px;height:108px;"" />';
									var img_data = '<input value="'+data.temp_image+'" type="hidden" name="temp_image"> <input value="'+data.temp_image_name+'" type="hidden" name="temp_image_name"> <input value="'+data.temp_image_path+'" type="hidden" name="temp_image_path">';
									$('#upload_image_display').html(image_display);
									$('#upload_img_data').html(img_data);

									// Form Button show If Image Croped
									if(image_display != "") { $('#upload_image_form_submit').removeAttr('disabled', ''); }
									}
								});
								});
							});
						// Image Crop , Data Send & Received
							
						});  
					</script>
				<!-- Upload Image Process -->

				<!-- Promotion Image Process -->
					<script>  
						$(document).ready(function(){
							
						// Image Preview  
							$promotion_image_crop_process = $('#promotion_image_preview').croppie({
								enableExif:true,
								viewport:{
									width:200,
									height:200,
									type:'square'
								},
								boundary:{
									width:400,
									height:250
								},
								showZoomer: true,
							});
						// Image Preview

						// Image Upload
							$('#promotion_image_upload').change(function(){
								var reader = new FileReader();

								reader.onload = function(event){
								$promotion_image_crop_process.croppie('bind', {
									url:event.target.result
								}).then(function(){
									console.log('jQuery bind complete');
								});
								}
								reader.readAsDataURL(this.files[0]);
							});
						// Image Upload

						// Crop & Form Button Hide
							$('#promotion_image_upload').change(function(){
								$('#promotion_image_preview').show();
								$('#promotion_image_tc').hide();
								$('.promotion_image_crop').removeAttr('disabled', '');
							});
							
							$('.promotion_image_crop').attr('disabled', '');
							$('#promotion_image_form_submit').attr('disabled', '');
							$('#promotion_image_preview').hide();
						// Crop & Form Button Hide

						// Image Crop , Data Send & Received
							$('.promotion_image_crop').click(function(event){
								$promotion_image_crop_process.croppie('result', {
								type:'canvas',
								size: { width: 500, height: 500 }
								}).then(function(response){
								var _token = $('input[name=_token]').val();
								$.ajax({
									url:'{{ route("image.process") }}',
									type:'post',
									data:{"image":response, _token:_token},
									dataType:"json",
									success:function(data)
									{
									var promotion_image_display = '<img src="/'+data.temp_image+'" style="width:80px;height:80px;"" />';
									var promotion_img_data = '<input value="'+data.temp_image+'" type="hidden" name="temp_image"> <input value="'+data.temp_image_name+'" type="hidden" name="temp_image_name"> <input value="'+data.temp_image_path+'" type="hidden" name="temp_image_path">';
									$('#promotion_image_display').html(promotion_image_display);
									$('#promotion_img_data').html(promotion_img_data);

									// Form Button show If Image Croped
									if(promotion_image_display != "") { $('#promotion_image_form_submit').removeAttr('disabled', ''); }
									}
								});
								});
							});
						// Image Crop , Data Send & Received
							
						});  
					</script>
				<!-- Promotion Image Process -->

				<!-- Upload Video Process -->
					<script>  
						$(document).ready(function(){
							$(document).on("change", "#video_upload_file", function(evt) {
							var $source = $('#video_upload_source');
							$source[0].src = URL.createObjectURL(this.files[0]);
							$source.parent()[0].load();
							$('#video_upload_display').show();
							});

							$('#video_upload_display').hide();
						});  
					</script>

				<!-- Upload Video Process -->

                <!-- Toastr js-->
					<script src="{{ asset('dashlead/plugins/toastr/toastr.min.js') }}"></script>
					{!! Toastr::message() !!}
					<script>
						@if($errors->any())
							@foreach($errors->all() as $error)
								toastr.error('{{ $error }}','Error',{
									closeButton:true,
									progressBar:true,
								});
							@endforeach
						@endif
					</script>
				<!-- Toastr js-->