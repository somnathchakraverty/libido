$("#add_video_modal_form").submit(function () {
    if ($("#video_type_checkboxes").length) {
        var checked = $("#video_type_checkboxes input:checked").length > 0;
        if (!checked) {
            $("#general_title").text('Alert');
            $('#general_body').text('You need to select a type for video');
            $('#general_popup_modal').modal('show');
            $('#general_cancel').css('display', 'none');
            return false;
        }

        var check = true;
        $("#video_type_checkboxes input[type=checkbox]:checked").each(function () {
            var a = $(this).val();
            if (a === '1') {
                if ($('#amateur_heavy').is(":checked") || $('#amateur_light').is(":checked")) {
                } else {
                    alert('Please select sessions in Amateur');
                    check = false;
                }
            }
            if (a === '2') {
                if ($('#intermediate_heavy').is(":checked") || $('#intermediate_light').is(":checked")) {
                } else {
                    alert('Please select sessions in Intermediate');
                    check = false;
                }
            }
            if (a === '3') {
                if ($('#advanced_heavy').is(":checked") || $('#advanced_light').is(":checked")) {
                } else {
                    alert('Please select sessions in Advanced');
                    check = false;
                }
            }
        });
        if (!check) {
            return false;
        }

    }

    if ($("#skill_type_checkboxes").length) {
        var checked = $("#skill_type_checkboxes input:checked").length > 0;
        if (!checked) {
            $("#general_title").text('Alert');
            $('#general_body').text('You need to select a skill level');
            $('#general_popup_modal').modal('show');
            $('#general_cancel').css('display', 'none');
            return false;
        }
    }
});
$("#edit_video_modal_form").submit(function () {
    if ($("#video_type_checkboxes").length) {
        var checked = $("#video_type_checkboxes input:checked").length > 0;
        if (!checked) {
            $("#general_title").text('Alert');
            $('#general_body').text('You need to select a type for video');
            $('#general_popup_modal').modal('show');
            $('#general_cancel').css('display', 'none');
            return false;
        }

        var check = true;
        $("#video_type_checkboxes input[type=checkbox]:checked").each(function () {
            var a = $(this).val();
            if (a === '1') {
                if ($('#amateur_heavy').is(":checked") || $('#amateur_light').is(":checked")) {
                } else {
                    alert('Please select sessions in Amateur');
                    check = false;
                }
            }
            if (a === '2') {
                if ($('#intermediate_heavy').is(":checked") || $('#intermediate_light').is(":checked")) {
                } else {
                    alert('Please select sessions in Intermediate');
                    check = false;
                }
            }
            if (a === '3') {
                if ($('#advanced_heavy').is(":checked") || $('#advanced_light').is(":checked")) {
                } else {
                    alert('Please select sessions in Advanced');
                    check = false;
                }
            }
        });
        if (!check) {
            return false;
        }
    }
    
    if ($("#skill_type_checkboxes").length) {
        var checked = $("#skill_type_checkboxes input:checked").length > 0;
        if (!checked) {
            $("#general_title").text('Alert');
            $('#general_body').text('You need to select a skill level');
            $('#general_popup_modal').modal('show');
            $('#general_cancel').css('display', 'none');
            return false;
        }
    }
});

$(document).ready(function () {
    getNewValues();
//    $('#loader_div').hide();
    setTimeout(function () {
        $('#loader_div').fadeOut();
    }, 1000);
    var url_serach = window.location.search;
    var current_url = window.location.href;
    if (current_url.indexOf('videos/all-videos') >= 0 || current_url.indexOf('videos/intro-videos') >= 0) {
        if (current_url.indexOf('workouts') >= 0) {
            $('#training-videos').addClass('active');
            $('#training-videos-link').trigger("click");
        } else {
            $('#gyming-videos').addClass('active');
            $('#gyming-videos-link').trigger("click");
        }


        if (current_url.indexOf('workouts') >= 0) {
            if (url_serach == '?category=warm-up' || url_serach == '?category=movement-up' || url_serach == '?category=running-with-ball' || url_serach == '?category=dynamic-strength' || url_serach == '?category=ladder-work' || current_url.indexOf('videos/intro-videos?category=warm-up') >= 0) {
                $('#warm-up').addClass('active');
            } else if (url_serach == '?category=agility' || current_url.indexOf('videos/intro-videos?category=agility') >= 0) {
                $('#agility').addClass('active');
            } else if (url_serach == '?category=technical' || current_url.indexOf('videos/intro-videos?category=technical') >= 0) {
                $('#technical').addClass('active');
            } else if (
                    url_serach == '?category=power-drills' ||
                    url_serach == '?category=diamond-work' ||
                    url_serach == '?category=box-work' ||
                    url_serach == '?category=improvisation' ||
                    url_serach == '?category=line-forward-backword' ||
                    url_serach == '?category=line-straight' ||
                    url_serach == '?category=h-work' ||
                    url_serach == '?category=t-work' ||
                    url_serach == '?category=v-work' ||
                    current_url.indexOf('videos/intro-videos?category=power-drills'
                            ) >= 0) {
                $('#power-drills').addClass('active');
            } else if (url_serach == '?category=passing-shooting' || current_url.indexOf('videos/intro-videos?category=passing-shooting') >= 0) {
                $('#passing-shooting').addClass('active');
            } else if (url_serach == '?category=strength-and-conditioning' || current_url.indexOf('videos/intro-videos?category=strength-and-conditioning') >= 0) {
                $('#strength-and-conditioning').addClass('active');
            } else if (url_serach == '?category=warm-down' || url_serach == '?category=movement-down' || url_serach == '?category=dynamic-stretching' || current_url.indexOf('videos/intro-videos?category=warm-down') >= 0) {
                $('#warm-down').addClass('active');
            } else {
                $('#training-videos').addClass('active');
            }
        } else {
            if (url_serach == '?category=warm-up' || current_url.indexOf('videos/intro-videos?category=warm-up') >= 0) {
                $('#warm-up-gym').addClass('active');
            } else if (url_serach == '?category=group-a' || url_serach == '?category=trunk-for-group-a' || url_serach == '?category=abs-for-group-a' || url_serach == '?category=pull-for-group-a' || url_serach == '?category=push-for-group-a' || current_url.indexOf('videos/intro-videos?category=group-a') >= 0) {
                $('#group-a').addClass('active');
            } else if (url_serach == '?category=group-b' || url_serach == '?category=trunk-for-group-b' || url_serach == '?category=abs-for-group-b' || url_serach == '?category=pull-for-group-b' || url_serach == '?category=push-for-group-b' || current_url.indexOf('videos/intro-videos?category=group-b') >= 0) {
                $('#group-b').addClass('active');
            } else if (url_serach == '?category=group-c' || url_serach == '?category=trunk-for-group-c' || url_serach == '?category=abs-for-group-c' || url_serach == '?category=pull-for-group-c' || url_serach == '?category=push-for-group-c' || current_url.indexOf('videos/intro-videos?category=group-c') >= 0) {
                $('#group-c').addClass('active');
            } else if (url_serach == '?category=warm-down' || current_url.indexOf('videos/intro-videos?category=warm-down') >= 0) {
                $('#warm-down-gym').addClass('active');
            } else {
                $('#gyming-videos').addClass('active');
            }
        }



    }
});

$('#add_new_video_form').submit(function () {
    $('#loader_div').fadeIn();
});
$('#edit_video_form').submit(function () {
    $('#loader_div').fadeIn();
});
$('#intro_video_form').submit(function () {
    $('#loader_div').fadeIn();
});

function addMoreSetsRepsEdit(e) {
    parent_node = $('#sets_reps').find($('#video_sets_reps'));
//    child_node = parent_node.clone();
    var child_node = '<div id="video_sets_reps" class="sets_reps">' +
//                        '<div class="form-group">'+
//                            '<label class="control-label col-sm-2" for="sets">Sets: <span class="required" style="color:red">*</span></label>'+
//                            '<div class="col-sm-4">'+
//                                '<input required type="number" min="0" max="100" name="sets[]" class="form-control" id="sets" placeholder="Enter Sets">'+
//                            '</div>'+
//                            '<label class="control-label col-sm-2" for="reps">Reps: <span class="required" style="color:red">*</span></label>'+
//                            '<div class="col-sm-4">'+
//                                '<input required type="number" min="0" max="100" name="reps[]" class="form-control" id="reps" placeholder="Enter Reps">'+
//                            '</div>'+
//                        '</div>'+
            '<div class="form-group">' +
            '<label class="control-label col-sm-2" for="instructions">Instructions: <span class="required" style="color:red">*</span></label>' +
            '<div class="col-sm-10">' +
            '<textarea required rows="3" name= "instructions[]" maxlength="500" cols="50" class="form-control" id="instructions" placeholder="Enter Instructions"></textarea>' +
            '<a style="color:red;" href="javascript:void(0);" onclick="removeSetsReps(event)" id="remove_sets_reps_button">Remove</a>' +
            '</div>' +
            '</div>' +
            '</div>';
    $('#sets_reps').append(child_node);
//    $('#sets').val('');
//    $('#reps').val('');
//    $('#instructions').val('');
}
function getNewValues() {
    if ($('#video_diagram :selected').text() != 'Select Diagram') {
        $('#add_video_form').removeAttr('disabled');
    }

}
function removeEditSetsReps(e) {
    var conveniancecount = $("div[class*='sets_reps']").length;
    if (conveniancecount == 1) {
        $("#general_title").text('Alert');
        $('#general_body').text('Video must have atleast one sets, reps and instructions');
        $('#general_popup_modal').modal('show');
        $('#general_cancel').css('display', 'none');
    } else {
        $(e.currentTarget).parent().parent().parent().remove();
    }
}

function addMoreSetsReps() {
    parent_node = $('#sets_reps').find($('#video_sets_reps'));
//    child_node = parent_node.clone();
    var child_node = '<div id="video_sets_reps" class="sets_reps">' +
//                        '<div class="form-group">'+
//                            '<label class="control-label col-sm-2" for="sets">Sets: <span class="required" style="color:red">*</span></label>'+
//                            '<div class="col-sm-4">'+
//                                '<input required type="number" min="0" max="100" name="sets[]" class="form-control" id="sets" placeholder="Enter Sets">'+
//                            '</div>'+
//                            '<label class="control-label col-sm-2" for="reps">Reps: <span class="required" style="color:red">*</span></label>'+
//                            '<div class="col-sm-4">'+
//                                '<input required type="number" min="0" max="100" name="reps[]" class="form-control" id="reps" placeholder="Enter Reps">'+
//                            '</div>'+
//                        '</div>'+
            '<div class="form-group">' +
            '<label class="control-label col-sm-2" for="instructions">Instructions: <span class="required" style="color:red">*</span></label>' +
            '<div class="col-sm-10">' +
            '<textarea required rows="3" maxlength="500" name= "instructions[]" cols="50" class="form-control" id="instructions" placeholder="Enter Instructions"></textarea>' +
            '<a style="color:red;" href="javascript:void(0);" onclick="removeSetsReps(event)" id="remove_sets_reps_button">Remove</a>' +
            '</div>' +
            '</div>' +
            '</div>';
    $('#sets_reps').append(child_node);
//    $('#sets').val('');
//    $('#reps').val('');
//    $('#instructions').val('');
    var conveniancecount = $("div[class*='sets_reps']").length;
    if (conveniancecount > 1) {
        $('#remove_sets_reps_button').css('display', 'block');
    }
}
function removeSetsReps(e) {
    var conveniancecount = $("div[class*='sets_reps']").length;
    if (conveniancecount == 1) {
        $("#general_title").text('Alert');
        $('#general_body').text('Video must have atleast one sets, reps and instructions');
        $('#general_popup_modal').modal('show');
        $('#general_cancel').css('display', 'none');
    } else {
        $(e.currentTarget).parent().parent().parent().remove();
    }
}

  