/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you require will output into a single css file (app.css in this case)

require('../css/app.scss');
const $ = require('jquery');
require('bootstrap');
require('core-js');
// Need jQuery? Install it with "yarn add jquery", then uncomment to require it.
// const $ = require('jquery');


$(document).ready(function () {
    console.log('Hello Webpack Encore! Edit me in assets/js/app.js');


    $hall = {
        rows: Array(),
        addRow: function (countSeats, type) {
            this.rows.push({
                seats: Array(countSeats),
                type: type,
                addSeat: function(){
                    this.seats.push('1');
                    return this;
                },
                removeSeat:function () {
                    this.seats.pop();
                }
            });
        },
        getRow: function (row) {
            return this.rows[row];
        }
    };


    $hall.addRow(5, 1);
    console.log($hall, $hall.getRow(0));
    $hall.getRow(0).addSeat().addSeat();
    console.log($hall);



    $('#addRow').click(function () {





        $colCount = parseInt($('#colCount').val());
        $rowType  = $('#rowType').val();
        $currentRowCount = $(this).data('current');
        console.log($currentRowCount, $(this).data('current'), $colCount+1);
        $currentRowCount++;

        $hall.addRow($colCount, $rowType);
        console.log($hall);
        $result = '  <div class="row row-' + $currentRowCount + '" data-row="' + $currentRowCount + '">' +
            '                    <div class="input-group-prepend">' +
            '                        <button class="addSeat btn btn-success btn-outline-secondary" data-max-y="'+ $colCount +'" data-row="' + $currentRowCount + '" data-type="'+$rowType+'">Add Seat</button>' +
            '                    </div>' +
            '                    <div class="row rowContent">';
            for(i=1;i <  $colCount+1; i++) {
                $result =  $result + addSeat($currentRowCount, i, $rowType);
            }


        $result =$result + ' </div>' +
            '<div class="input-group-append">' +
            '                        <button class="removeRow btn btn-danger btn-outline-secondary" data-row="' + $currentRowCount + '">Remove Row</button>' +
            '                    </div>' +
            '                </div>';

        $('#hallPreview').append($result);

        $(this).data('current', $currentRowCount); //записать номер последнего добавленного ряда
        console.log($colCount, $rowType);
    });

    $hallPreview = $('#hallPreview');
    $hallPreview.on('click', '.removeRow', function () {
        $currentRow = $(this).data('row');
        alert('click Remove'+$currentRow);
        $('.row-'+$currentRow).remove();

    });

    $hallPreview.on('click', '.addSeat', function () {
        //console.log($(this).parent().parent().data());
        $currentRowCount = $(this).data('row');
        $maxY = parseInt($(this).data('maxY'));
        $type = parseInt($(this).data('type'));
        $maxY++;
        //$('.row-1 .rowContent').append() что хотели получить.
        $('.row-'+ $currentRowCount + ' .rowContent').append(addSeat($currentRowCount, $maxY, $type));
        $(this).data('maxY', $maxY);
    });

    $hallPreview.on('click', '.seat', function () {
        alert('click Remove');
    });
    
});

function addSeat($row, $col, $type) {
    return '<div class="col seat" data-x="' + $row + '" data-y="'+$col+'" data-type="'+ $type +'">'+$row+','+$col+'</div>';
}