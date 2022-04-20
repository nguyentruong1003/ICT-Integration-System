<div>
    <div class="input-group">
        <input
            type="text"
            class="form-control bg-white"
            placeholder="{{ $placeholder }}"
            id="{{ $name }}"
            value="{{ !empty($value) ? date('d/m/Y', strtotime($value)) : '' }}" {{ $disabled ? 'disabled' : '' }}
            readonly
            data-format="{{ $format }}"
            data-min="{{ $min }}"
            data-max="{{ $max }}"
            data-container="{{ $container }}"
            onmouseover="initDatePicker(this)"
            onkeypress="initDatePicker(this)"
        >
        <div class="input-group-append">
            <span class="input-group-text">
                <i class="fas fa-calendar"></i>
            </span>
        </div>
    </div>
<script>

window.initDatePicker = function (input) {
  if (input.datepicker) return;

  input.emitLocalEvent = function (event) {
    var date = event.date;
    window.livewire.emit('set-' + input.id, date ? "".concat(date.getFullYear(), "-").concat(date.getMonth() + 1, "-").concat(date.getDate()) : null);
  };

  input.emitGlobalEvent = function (event) {
    var date = event.date;
    window.livewire.emit('set-date-value', input.id, date ? "".concat(date.getFullYear(), "-").concat(date.getMonth() + 1, "-").concat(date.getDate()) : null);
  };

  input.datepicker = $(input).datepicker({
    autoclose: true,
    format: input.getAttribute('data-format') || 'dd/mm/yyyy',
    startDate: input.getAttribute('data-min') || null,
    endDate: input.getAttribute('data-max') || null,
    container: input.getAttribute('data-container') || 'body',
    immediateUpdates: true,
    language: 'vi',
    todayHighlight: true,
    clearBtn: true
  }).on('changeDate', function (e) {
    input.emitGlobalEvent(e);
    input.emitLocalEvent(e);
  }).on('changeMonth', function (e) {
    input.emitGlobalEvent(e);
    input.emitLocalEvent(e);
  }).on('changeYear', function (e) {
    input.emitGlobalEvent(e);
    input.emitLocalEvent(e);
  });
};
</script>
</div>
