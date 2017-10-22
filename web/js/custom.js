$(function(){
    matchLineSwitcherInit();
    $('select').material_select();

    $(".button-collapse").sideNav();

    // $('.datepicker').pickadate({
    //     selectMonths: true, // Creates a dropdown to control month
    //     selectYears: 15, // Creates a dropdown of 15 years to control year,
    //     today: 'Today',
    //     clear: 'Clear',
    //     close: 'Ok',
    //     closeOnSelect: false // Close upon selecting a date,
    // });
    $('.datepicker').bootstrapMaterialDatePicker({format: 'DD-MM-YYYY HH:mm'});
    if ($('.dataTabled').length){
        $('.dataTabled').dataTable();

    }
    $('.toastData').each(
        function(){
            Materialize.toast($(this).attr('data-toast-message'), 4000);
        }
    )
})

function matchLineSwitcherInit(){
    $('.matchLineSwitcher a')
        .off('click',switchMatchLine)
        .on('click',switchMatchLine)
    ;
}

function switchMatchLine(e){
    e.preventDefault();
    $target = $(e.target).closest('.matchLineSwitcher').prev('.matchLine');
    
    $target.toggleClass('hide')
    console.log( $(e.currentTarget).find('i.material-icons').html());
    $(e.currentTarget).find('i.material-icons').html(
        $(e.currentTarget).find('i.material-icons').html() === "arrow_drop_down" ? "arrow_drop_up": "arrow_drop_down"
    );
    // $(e.target).closest('.matchLineSwitcher').prev('.matchLine').toggleClass('hide');
}