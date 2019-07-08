$(document).ready(function()
{
    let inputs = $('#word_from_word, #word_to_translation');
    $('#word_save').prop('disabled','false');

    inputs.each(function()
    {
        inputs.keyup(function()
        {
            if($('#word_from_word').val() !== '' && $('#word_to_translation').val() !== '')
            {
                $('#word_save').css('background-color', '#B63966').css('border-color', '#B63966').css('cursor', 'pointer').removeAttr("disabled");
            }
            else
            {
                $('#word_save').css('background-color', '#707070').css('border-color', '#707070').prop('disabled','true').css('cursor', 'not-allowed');
            }
        });
    });
});