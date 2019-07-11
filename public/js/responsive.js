$(document).ready(function()
{
    // on load
    if($(window).width() < 900)
    {
        $('.mobile').css('display', 'block');
        $('.desktop').css('display', 'none');
    }
    else
    {
        $('.mobile').css('display', 'none');
        $('.desktop').css('display', 'block');
    }

    // on resize
    $(window).resize(function()
    {
        if($(window).width() < 900)
        {
            $('.mobile').css('display', 'block');
            $('.desktop').css('display', 'none');
        }
        else
        {
            $('.mobile').css('display', 'none');
            $('.desktop').css('display', 'block');
        }
    });
});