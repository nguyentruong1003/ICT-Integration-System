<div class="modal-content">
    <h3 class="text-center font-weight-bold">{{ $notificationName[0] ?? '' }}</h3>
    <p class="text-center size14 text-3 mb-24">{{ $notificationName[1] ?? '' }}</p>
    <h4 class="text-uppercase size18 pb-12">{{ __('data_field_name.notification.schedule_type') }}</h4>

    @if ($inGroup2)
        <div class="form-group">
            <label>{{ __('data_field_name.notification.schedule_deadline') }}</label>
            @include('layouts.partials.input._inputDate', ['place_holder' => 'dd/mm/yyyy', 'input_id' => 'deadline-' . $notificationType, 'default_date' => $deadline])
            @error('deadline')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label>{{ __('data_field_name.notification.schedule_remind_before') }} ({{ __('data_field_name.notification.schedule_unit_day') }})</label>
            <input type="number" min="0" class="form-control" wire:model.defer="remindBefore" max="60" oninput="this.value = this.value.replace(/[^0-9]/, '').substr(0, 2)">
            @error('remindBefore')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="text-center mt-42">
            <button type="button" data-dismiss="modal" class="btn btn-main bg-4 mr-20 text-3 size16 px-48 py-14">{{ __('common.button.cancel') }}</button>
            <button type="submit" class="btn btn-main bg-primary text-9 size16 px-48 py-14" wire:click="saveSchedule">{{ __('common.button.save') }}</button>
        </div>
    @endif
</div>
