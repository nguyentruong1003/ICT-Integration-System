<div class="col-md-10 col-xl-11 box-detail box-user bg-light rounded">
    <div class="mt-3">
        <a class="text-primary" href="#">{{ __('data_field_name.notification.notification_management') }}</a> \ <span class="text-muted">{{ __('data_field_name.notification.private_config') }}
    </div>

    <div class="mt-3 p-3 bg-white rounded">
        <h2>{{ __('data_field_name.notification.file_deadline') }}</h2>
        <form wire:submit.prevent="save">
            <h5>{{ __('data_field_name.notification.idea') }}</h5>
            <div class="row">
                <div class="col-sm form-group">
                    <label>{{ __('data_field_name.notification.schedule_deadline') }}</label>
                    @include('layouts.partials.input._inputDate', ['place_holder' => 'dd/mm/yyyy', 'input_id' => 'idea-deadline', 'default_date' => $ideaDeadline])
                    @error('ideaDeadline')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-sm form-group">
                    <label>{{ __('data_field_name.notification.schedule_remind_before') }} ({{ __('data_field_name.notification.schedule_unit_day') }})</label>
                    <input type="number" class="form-control" wire:model.defer="ideaRemindBefore">
                    @error('ideaRemindBefore')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <h5>{{ __('data_field_name.notification.topic') }}</h5>
            <div class="row">
                <div class="col-sm form-group">
                    <label>{{ __('data_field_name.notification.schedule_deadline') }}</label>
                    @include('layouts.partials.input._inputDate', ['place_holder' => 'dd/mm/yyyy', 'input_id' => 'topic-deadline', 'default_date' => $topicDeadline])
                    @error('topicDeadline')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-sm form-group">
                    <label>{{ __('data_field_name.notification.schedule_remind_before') }} ({{ __('data_field_name.notification.schedule_unit_day') }})</label>
                    <input type="number" class="form-control" wire:model.defer="topicRemindBefore">
                    @error('topicRemindBefore')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <h5>{{ __('data_field_name.notification.delivering') }}</h5>
            <div class="row">
                <div class="col-sm-6 form-group">
                    <label>{{ __('data_field_name.notification.schedule_remind_before') }} ({{ __('data_field_name.notification.schedule_unit_day') }})</label>
                    <input type="number" class="form-control" wire:model.defer="deliveringRemindBefore">
                    @error('deliveringRemindBefore')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form-group text-center">
                <button type="button" class="btn btn-main bg-light text-4 size16 px-48 py-14" wire:loading.attr="disabled">{{ __('common.button.cancel') }}</button>
                <button class="btn btn-main bg-primary text-9 size16 px-48 py-14" wire:loading.attr="disabled">{{ __('common.button.save') }}</button>
            </div>
        </form>
    </div>
</div>
