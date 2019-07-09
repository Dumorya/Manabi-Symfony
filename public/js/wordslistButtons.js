$(document).ready(function()
{
    let displayed = false;

    $('.paramButton').click(function ()
    {
        if(displayed === true)
        {
            $('.editButton, .deleteButton, .addButton').css('width', '0').css('height', '0').css('padding', '0');
            $('.editButton > img, .deleteButton > img, .addButton > img').css('width', '0').css('height', '0');

            displayed = false;
        }
        else
        {
            $('.editButton, .addButton').css('width', '20px').css('height', '20px').css('padding', '10px');
            $('.deleteButton').css('width', '40px').css('height', '40px').css('padding', '10px');
            $('.editButton > img, .deleteButton > img, .addButton > img').css('width', '20px').css('height', 'auto');

            displayed = true;
        }
    });

    $('form > .deleteButton').click(function(event)
    {
        event.preventDefault();
        $('.deleteButtonModal').trigger('click');
        $('.yesDeleteButton').click(function()
        {
            $('.deleteButton').parent().submit();
        });
    });
});