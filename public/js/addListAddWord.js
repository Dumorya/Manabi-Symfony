$(document).ready(function()
{
    // add word
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


    // edit word
    let editWordInputs = $('#editModal > form > div > input');
    $('#editModal #word_save').prop('disabled','false');

    // The input is alreadu filled so we check at the beginning without keyup
    if(editWordInputs.val() !== '')
    {
        $('#editModal #word_save').css('background-color', '#B63966').css('border-color', '#B63966').css('cursor', 'pointer').removeAttr("disabled");
    }
    else
    {
        $('#editModal #word_save').css('background-color', '#707070').css('border-color', '#707070').prop('disabled','true').css('cursor', 'not-allowed');
    }

    editWordInputs.keyup(function()
    {
        if(editListInput.val() !== '')
        {
            $('#editModal #word_save').css('background-color', '#B63966').css('border-color', '#B63966').css('cursor', 'pointer').removeAttr("disabled");
        }
        else
        {
            $('#editModal #word_save').css('background-color', '#707070').css('border-color', '#707070').prop('disabled','true').css('cursor', 'not-allowed');
        }
    });

    // add list
    let addListInput = $('.addListAddWord > form > div > input');
    let saveButtonaddList = $('.addListAddWord > form > #words_list_save');
    saveButtonaddList.prop('disabled','false');

    addListInput.keyup(function()
    {
        if(addListInput.val() !== '')
        {
            saveButtonaddList.css('background-color', '#B63966').css('border-color', '#B63966').css('cursor', 'pointer').removeAttr("disabled");
        }
        else
        {
            saveButtonaddList.css('background-color', '#707070').css('border-color', '#707070').prop('disabled','true').css('cursor', 'not-allowed');
        }
    });

    // edit list
    let editListInput = $('#editModal > form > div > input');
    $('#editModal #words_list_save').prop('disabled','false');

    // The input is alreadu filled so we check at the beginning without keyup
    if(editListInput.val() !== '')
    {
        $('#editModal #words_list_save').css('background-color', '#B63966').css('border-color', '#B63966').css('cursor', 'pointer').removeAttr("disabled");
    }
    else
    {
        $('#editModal #words_list_save').css('background-color', '#707070').css('border-color', '#707070').prop('disabled','true').css('cursor', 'not-allowed');
    }

    editListInput.keyup(function()
    {
        if(editListInput.val() !== '')
        {
            $('#editModal #words_list_save').css('background-color', '#B63966').css('border-color', '#B63966').css('cursor', 'pointer').removeAttr("disabled");
        }
        else
        {
            $('#editModal #words_list_save').css('background-color', '#707070').css('border-color', '#707070').prop('disabled','true').css('cursor', 'not-allowed');
        }
    });
});