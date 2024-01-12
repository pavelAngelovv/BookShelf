const initDatepicker = () => {
  $('.js-datepicker').datepicker({
    format: 'yyyy-mm-dd'
  });
};

// Event listener for datepicker icon
const initDatepickerIconListener = () => {
  $('.input-group-text').on('click', function () {
    $(this).closest('.input-group').find('.js-datepicker').focus();
  });
};

document.addEventListener('DOMContentLoaded', () => {
  initDatepicker();
  initDatepickerIconListener();
});