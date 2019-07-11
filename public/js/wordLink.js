$(document).ready(function()
{
    let td   = $('.tableBody > tbody > tr > td');
    td.css('cursor', 'pointer');

    // we get the link of the a tags in the td tag on which we clicked, and we put this link on the td tag
    td.click(function()
    {
        let link = $(this).find('a');
        window.location = link.attr('href');
    });

    // hover the whole column
    td.hover(function ()
    {
        let className = $(this).attr('class');
        $('.' + className).css('background-color',' #f8f8f8').css('transition','all 0.2s ease-out');
    });

    td.mouseleave(function ()
    {
        let className = $(this).attr('class');
        $('.' + className).css('background-color',' #ececec').css('transition','all 0.2s ease-out');
    });
});