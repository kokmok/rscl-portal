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
        $('.dataTabled').dataTable(
            {"order": $(this).data('order')}
        );

    }
    $('.toastData').each(
        function(){
            Materialize.toast($(this).attr('data-toast-message'), 4000);
        }
    )
    var $dataVictories = $('#victories');
    if ($dataVictories.length){
        var ctx = document.getElementById('victories').getContext('2d');
        
        var data = {
            datasets: [{
                data: [$dataVictories.data('victories'), $dataVictories.data('defeats'), $dataVictories.data('draws')],
                backgroundColor: ["red", "black","grey","#e8c3b9","#c45850"]    
            },
                
                
                ],
                labels: [
                    'Victoires '+$dataVictories.data('victories'),
                    'Défaites '+$dataVictories.data('defeats'),
                    'Nuls '+$dataVictories.data('draws')
                ],
                
        };
        
        var myDoughnutChart = new Chart(ctx, {
            type: 'doughnut',
            data: data
        });
        var ctx = document.getElementById('buts').getContext('2d');
        var $dataButs = $('#buts');
        var data = {
            datasets: [{
                data: [$dataButs.data('scored'), $dataButs.data('encaisses')],
                backgroundColor: ["red", "black","grey","#e8c3b9","#c45850"]    
            },
            ],
            labels: [
                'Marqués '+$dataButs.data('scored'),
                'Encaissés '+$dataButs.data('encaisses')
            ],
                
        };
        
        var myDoughnutChart = new Chart(ctx, {
            type: 'doughnut',
            data: data
        });
    }
});

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