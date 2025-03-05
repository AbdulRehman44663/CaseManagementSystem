@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/signature_pad@4.0.0/dist/signature_pad.umd.min.js"></script>

<script src="{{url('assets/js/sketchpad.js')}}"></script>
<script>
    
    var signaturePad; // Define in global scope

    $(document).ready(function () {
        var canvas = document.getElementById("signatureSketchpad");

       
        if (canvas) {
            canvas.width = 750;  // Set canvas width
            canvas.height = 300; // Set canvas height

            // Initialize SignaturePad with the resized canvas
            signaturePad = new SignaturePad(canvas, {
                
            });
        }

        $(document).on("click", ".submitsignature", function () {
            if (!signaturePad) {
                console.log("Signature pad not initialized.");
                $(".signatureError").text("Signature pad is not initialized.").show();
                return;
            }

            if (signaturePad.isEmpty()) {
                console.log("No signature detected.");
                $(".signatureError").text("Please provide a signature.").show();
            } else {
                var dataURL = signaturePad.toDataURL("image/png");
                $(".signaturePlaceholder").attr("src", dataURL);
                $(".signatureValue").val(dataURL);
                $(".signatureError").hide(); // Hide error if signature is provided
                signaturePad.clear();

                
                $('#enterSignature').modal('hide');
            }
        });

        $(document).on("click", ".clearSignature", function () {
            if (signaturePad) {
                signaturePad.clear();
                $(".signatureError").hide(); // Hide error when cleared
            }
        });

        $('.closeSignature').on('click', function() {
            clearValidationError();
            $(".signatureError").text("")
            signaturePad.clear();
            $('#enterSignature').modal('hide');
        });
    
});
</script>
<script>
    $(document).ready(function () {
        $(document).on("change", ".inputFileDropZone", function(event) {
            var thisTag = $(this);
            var file = event.target.files[0];
            $('.logoError').remove();
            if (file && file.type.startsWith('image/')) {
                var reader = new FileReader();
                reader.onload = function(e) {
                  
                    thisTag.closest('.inputZoneDiv').find('.logo_preview').attr('src', e.target.result).show();
                    thisTag.closest('.inputZoneDiv').find('.inputZone').hide();
                };
                reader.readAsDataURL(file);
            } else {
                
                thisTag.closest('.inputZoneDiv').find('.logo_preview').hide();
                thisTag.closest('.inputZoneDiv').find('.inputZone').show();
            }
        });

        // $(document).on("click", ".uploadLogo", function() {
        //     $('.logoDataImg').val($('.logo_preview').attr('src'));
        //     $('.logoPlaceholder').attr('src',$('.logo_preview').attr('src'));
        // });
        $(document).on("click", ".uploadLogo", function() {
            var logoSrc = $('.logo_preview').attr('src');

            // Check if logo_preview has an image
            if (!logoSrc || logoSrc.trim() === "") {
                console.log("54");
                // Show an error message below the file upload section
                if (!$('.logoError').length) {
                    $('.inputZoneDiv').append('<div class="logoError text-danger mt-2">Please select an image before uploading.</div>');
                }
            } else {
                // Remove error message if it exists
                $('.logoError').remove();

                // Set the uploaded image URL
                $('.logoDataImg').val(logoSrc);
                $('.logoPlaceholder').attr('src', logoSrc);

                // Close modal if needed
                $('#enterLogo').modal('hide');
            }
        });


        $(document).on("click", ".delImage", function() {
            $(this).closest('.img_container').find('.logoPlaceholder').attr('src',base_url+'/assets/images/user-pic.png');
            $(this).closest('.img_container').find('.logoDataImg').val('');
        });

    });
</script>
<script>
    
    /// update a information
    $('#update-lawfirmInforamtion-form').on('submit', function(e) {
        e.preventDefault();
        
        var url = '{{ route("admin.update.lawfirmInforamtion") }}';

        var method = 'PUT';
        
        var formData = $(this).serialize(); 
        formData += '&_token=' + $('meta[name="csrf-token"]').attr('content');  // Append CSRF token
        
        $.ajax({
            url: url,
            method: method,
            data: formData,
            success: function(data) {
                if (!data.success || data.errors) {
                    displayErrors(data.errors);
                } else {
                    window.location.href = '/admin/lawfirmInforamtion';
                }
            },
            error: function(error) {
                console.log(error);
            }
        });
    });

    $('#choose_another_logo').on('click', function() {
        clearValidationError();

        // Reset the logo preview and show the inputFileDropZone
        $('#logo_preview').attr('src', '').hide();
        $('.inputZone').show();

        $('#enterLogo').modal('show');
    });

    $('.closelogo').on('click', function() {
        clearValidationError();

        // Clear the logo preview and show the input file upload zone again
        $('#logo_preview').attr('src', '').hide();
        $('.inputZone').show();
        $('.logoError').remove(); 
        $('#enterLogo').modal('hide');
    });
 

// Usage

function validateFaxNumber(input) {
    let faxPattern = /^\+?[0-9\s\-()]{7,20}$/;
    let errorDiv = document.getElementById("error_fax_no");

    if (input.value && !faxPattern.test(input.value)) {
        errorDiv.textContent = "Enter a valid fax number (e.g., +123-456-7890).";
        input.classList.add("is-invalid");
    } else {
        errorDiv.textContent = "";
        input.classList.remove("is-invalid");
    }
}

function formatLocation(input) {
    console.log("184");
    let value = input.value;
    
    // Remove unwanted characters
    value = value.replace(/[^a-zA-Z0-9, ]/g, '');

    // Ensure correct format: City, ST ZIP
    let parts = value.split(',');
    if (parts.length > 1) {
        let stateZip = parts[1].trim().split(' ');
        if (stateZip.length > 1) {
            stateZip[0] = stateZip[0].toUpperCase(); // Convert state to uppercase
            stateZip[1] = stateZip[1].replace(/\D/g, ''); // Remove non-numeric characters from ZIP
        }
        parts[1] = stateZip.join(' ');
    }
    input.value = parts.join(', ');
}



</script>
@endpush
