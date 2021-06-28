$(document).ready(function() {
	// Selector de fecha
    $('#data_1 .input-group.date').datepicker({
        keyboardNavigation: false,
        language: "es",
        format: "yyyy-mm-dd",
        calendarWeeks: true,
        autoclose: true,
        todayHighlight: true
    });

    // Input select
    $(".select2").select2({
        language: "es"
    });

    // Validación del formulario
    $("#frm").validate({
        rules: {
          //respuesta[]: {required: true, minlength:1 , maxlength: 1},
          estado: { required: true},
      }
    });


});