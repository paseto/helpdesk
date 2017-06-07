// functions outside of document ready for single page usage
// load ticket table	
function ticket_table_load(position) {
    var values = $("#auto-filter-form").serializeArray();

    if (position == "updates") {

        var now = new Date();
        var datetime = now.getFullYear() + '-' + (now.getMonth() + 1) + '-' + now.getDate();
        datetime += ' ' + now.getHours() + ':' + now.getMinutes() + ':' + now.getSeconds();

        values.push({name: 'dt', value: datetime});

    }

    $.ajax({
        url: "ajax/a-tickets.php",
        type: "post",
        data: values,
        cache: false,
        success: function (ticketdata) {

            if (position == "begin") {

                $("#tickets").html(ticketdata);

            } else if (position == "updates") {

                $("#tickets").prepend(ticketdata);

            }

            // set sidebar height after loading tickets
            //set_sidebar_heights();

            // checkbox to localstorage
            if (window.localStorage) {

                // select all tickets
                $(function () {
                    $('#select-all').click(function (event) {
                        if (this.checked) {
                            // Iterate each checkbox
                            $('.checkbox:checkbox').each(function () {
                                this.checked = true;
                                localStorage && localStorage.setItem(this.id, 'checked');
                            });
                        }
                        if (!this.checked) {
                            // Iterate each checkbox
                            $('.checkbox:checkbox').each(function () {
                                this.checked = false;
                                localStorage && localStorage.removeItem(this.id);
                            });
                        }
                    });
                });

                // on class checkbox change
                $('.checkbox').change(function () {
                    // set array and check
                    var name = this.id;
                    var value = this.value;

                    // if checked
                    if ($(this).is(':checked')) {

                        //shorthand to check that localStorage exists	
                        localStorage && localStorage.setItem(this.id, 'checked');

                    } else {

                        //shorthand to check that localStorage exists
                        localStorage && localStorage.removeItem(this.id);

                    }

                });

                $('.checkbox:checkbox').each(function () {

                    $(this).prop('checked', localStorage.getItem(this.id) == 'checked');

                });

                $(".ticket").click(function () {

                    var tid = this.id;
                    window.open("p.php?p=ticket&tid=" + tid, "_self");

                });


            }


            $(".ticket input:checkbox").click(function (e) {

                e.stopPropagation();

            });


        }

    });

}

// check for updates every 15 seconds

function refreshtickets() {
    ticketrefresh = setInterval(function () {
        ticket_table_load("updates");
    }, 15000);
}
// end functions


$(document).ready(function () {

    // set hidden sort fields to visible sort fields on page load. Used for session variables
    // set before loading page!
    var sortdir = $("#sortdir").val();
    $("#filter_sortdir").val(sortdir);
    var sortval = $("#sortval").val();
    $("#filter_sortval").val(sortval);

    // inital filter grap and table load
    // initially load ticket table
    ticket_table_load("begin");
    // run function to check for updates
    refreshtickets();


    // clear any checkboxes in localstorage on page load
    Object.keys(localStorage)
            .forEach(function (key) {

                var regex = /^[0-9]*(?:\.\d{1,2})?$/;    // allow only numbers [0-9] 

                //alert(key);
                if (regex.test(key)) {
                    localStorage.removeItem(key);
                }
            });

    function aa_ticket_view_check() {
        $('#ticket_view_header').hide();        
        if ($('#ticket_view').val() == 'List') {            
            $('#ticket_view_header').show();
        }
    }
    aa_ticket_view_check();
    $('#ticket_view').change(function () {
        aa_ticket_view_check();
    });


    // hide search page from view by select in tickets page
    $("#ticket_view").select2({
        minimumResultsForSearch: -1
    });

    // get emails
    $('#getemails').click(function () {

        $('#tickets').html('<p class="center">Getting emails</p><p class="center"><i class=\"fa fa-spinner fa-spin\"></p>');
        $.ajax({
            url: "../cron/cron-email.php",
            type: "post",
            cache: false,
            success: function (data) {
                location.reload();
            },
            error: function () {
                alert("Failed get emails");
            }
        });

    })

    // change ticket status
    $('#chg').click(function (e) {

        e.preventDefault();

        // set array variable			
        var selected = new Array();
        var selectval = $("#chg_field").val();
        var update = $("#chg_val").val();

        // foreach checkbox cheked pushed into array
        $("input:checkbox[name=checked_ticket]:checked").each(function () {
            // push data into array  
            selected.push($(this).val());

        });

        // post selected array and uid to php page
        $.post("ajax/a-tickets-bulk-update.php", {tid: selected, field: selectval, changeto: update}, function (data) {

            // resend variables		
            values = $("#auto-filter-form").serializeArray();
            /* Send the data using post and put the results in a div */
            ticket_table_load("begin");
            $('#select-all').prop('checked', false);

        });
        localStorage.clear();

    });

    // on filter form change
    $(".auto-ticket-filter").change(function (event) {

        // ensure one user is selected
        var count_user = $("[name='user[]']:checked").length;

        if (count_user == 0)
        {
            //alert("Please select any record to delete.");
            $(this).prop('checked', true);
            return false;
        }

        event.preventDefault();

        values = $("#auto-filter-form").serializeArray();

        // post filter to tickets
        /* Send the data using post and put the results in a div */
        ticket_table_load("begin");
        set_sidebar_heights();

    });

    // on visible sort change, change the hidden values
    $("#sortval").change(function (ve) {

        var sortval = $("#sortval").val();

        $("#filter_sortval").val(sortval);

        $('#auto-filter-form').trigger('change');

    });
    // on visible sort change, change the hidden values
    $("#sortdir").change(function (ve) {

        var sortdir = $("#sortdir").val();

        $("#filter_sortdir").val(sortdir);

        $('#auto-filter-form').trigger('change');

    });

    // reset filter form by clearing the sessions
    $("#filter-reset").click(function () {

        $.ajax({
            url: "ajax/a-tickets-filter-reset.php",
            type: "post",
            cache: false,
            success: function (data) {
                location.reload();
            },
            error: function () {
                alert("Failed to reset filter form");
            }
        });

    });
    // end tickets page


});