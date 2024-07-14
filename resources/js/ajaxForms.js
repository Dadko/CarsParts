import $ from 'jquery';

function handleAjaxForm(formSelector) {
    $(document).ready(function() {
        let token = document.head.querySelector('meta[name="csrf-token"]').content;

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': token
            }
        });

        $(formSelector).on('submit', function(e) {
            e.preventDefault();

            $('.is-invalid').removeClass('is-invalid');
            $('.invalid-feedback').remove();

            $.ajax({
                url: $(this).attr('action'),
                method: 'POST',
                data: $(this).serialize(),
                success: function(response) {
                    window.location.href = response.redirect;
                },
                error: function(response) {
                    if(response.status === 422) {
                        let errors = response.responseJSON.errors;

                        for (let key in errors) {
                            if (errors.hasOwnProperty(key)) {
                                let input = $(`[name=${key}]`);
                                input.addClass('is-invalid');

                                let errorElement = `<span class="invalid-feedback" role="alert"><strong>${errors[key][0]}</strong></span>`;
                                input.after(errorElement);
                            }
                        }
                    }
                    else {
                        alert('Submission failed. Please try again.');
                    }
                    console.log(response.responseJSON);
                }
            });
        });
    });
}

export default handleAjaxForm;