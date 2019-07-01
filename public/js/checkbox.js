$(document).ready(function()
{
    // by default we disable the start button
    $('.startQuiz').prop('disabled','true').addClass('startQuizDisabled');

    // the selector will match all input controls of type :checkbox
    // and attach a click event handler
    $("input:checkbox").on('click', function ()
    {
        // in the handler, 'this' refers to the box clicked on
        let $box = $(this);

        if ($box.is(":checked"))
        {
            // the name of the box is retrieved using the .attr() method
            // the checked state of the group/box on the other hand will change
            // as it is assumed and expected to be immutable
            let group = "input:checkbox[name='" + $box.attr("name") + "']";
            // and the current value is retrieved using .prop() method
            $(group).prop("checked", false);
            $box.prop("checked", true);
            $(group).parent().css('border', '0px solid #35A5AA');
            $box.parent().css('border', '2px solid #35A5AA');

            // enable the start button
            $('.startQuiz').removeClass('startQuizDisabled').removeAttr("disabled");
        }
        else
        {
            $box.prop("checked", false);
            $box.parent().css('border', '0px solid #35A5AA');

            // disable the start button
            $('.startQuiz').prop('disabled','true').addClass('startQuizDisabled');
        }
    });
});