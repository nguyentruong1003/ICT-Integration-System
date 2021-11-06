<div class="col-md-10 col-xl-11 box-detail box-user">
    <div class="breadcrumbs">
        <a class="text-primary" href="#">{{ __('data_field_name.notification.notification_management') }}</a> \ <span class="text-muted">{{ __('data_field_name.notification.public_config') }}</span>
    </div>
    <div class="creat-box bg-content border-20">
        <div class="detail-task pt-44">
            <h4 class="mb-8">{{ __('data_field_name.notification.notification_management') }}</h4>
            <p class="size13 text-3">{{ __('data_field_name.notification.notification_description') }}</p>
            <hr>
            <div class="table-responsive py-32">
                <table class="table table-general mb-0 wm-600">
                    <thead>
                        <tr class="border-radius">
                            <th style="width:50%" scope="col" class="border-radius-left font-weight-bold">{{ __('data_field_name.notification.schedule') }}</th>
                            <th style="width:30%" scope="col" class="text-center font-weight-bold"></th>
                            <th scope="col" class="text-center font-weight-bold">{{ __('data_field_name.notification.method_broadcast') }}</th>
                            <th scope="col" class=" text-center font-weight-bold border-radius-right">{{ __('data_field_name.notification.method_mail') }}</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($types as $key => $value)
                            <?php
                            $name = explode('|', __('data_field_name.notification.type_' . strtolower($value['name'])));
                            $scheduleEditable = ($key == \App\Enums\ENotificationType::IDEA_DEADLINE || $key == \App\Enums\ENotificationType::TOPIC_DEADLINE);
                            ?>

                            <tr>
                                <td class="pb-0">
                                    <h5 class="mb-8 size18">{{ $name[0] }}</h5>
                                    <p class="text-3 mb-0">{{ $name[1] ?? '' }}</p>
                                </td>
                                <td class="text-center pb-0">
                                    @if ($scheduleEditable)
                                        <a href="#" data-toggle="modal" data-target="#schedule-modal-{{ $key }}" class="text-6 size12">
                                            {{ __('data_field_name.notification.schedule') }}
                                        </a>
                                    @endif
                                </td>
                                <td class="text-center pb-0">
                                    <div class="custom-control custom-switch" wire:loading.remove>
                                        <input type="checkbox" class="custom-control-input" id="{{ $key }}-broadcast" wire:change="toggleMethod('{{ $key }}', 'broadcast', $event.target.checked)" {{ in_array('broadcast', $value['via']) ? 'checked' : '' }}>
                                        <label class="custom-control-label" for="{{ $key }}-broadcast"></label>
                                    </div>
                                    <div class="spinner-border text-primary" role="status" wire:loading>
                                        <span class="sr-only">Loading...</span>
                                    </div>
                                </td>
                                <td class="text-center pb-0">
                                    <div class="custom-control custom-switch" wire:loading.remove>
                                        <input type="checkbox" class="custom-control-input" id="{{ $key }}-mail" wire:change="toggleMethod('{{ $key }}', 'mail', $event.target.checked)" {{ in_array('mail', $value['via']) ? 'checked' : '' }}>
                                        <label class="custom-control-label" for="{{ $key }}-mail"></label>
                                    </div>
                                    <div class="spinner-border text-primary" role="status" wire:loading>
                                        <span class="sr-only">Loading...</span>
                                    </div>
                                </td>
                            </tr>
                            @if ($scheduleEditable)
                                <div class="modal-fix-1 modal fade " id="schedule-modal-{{ $key }}" wire:ignore>
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            @livewire('admin.config.notification.notification-schedule', ['notificationType' => $key, 'data' => $value])
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach

                    </tbody>
                </table>
            </div>
            <div class="text-center mt-8">
                <a href="/" class="btn btn-main bg-4 mr-20 text-3 size16 px-48 py-14">{{ __('common.button.cancel') }}</a>
                <button type="button" class="btn btn-main bg-primary text-9 size16 px-48 py-14" wire:click="saveModel">{{ __('common.button.save') }}</button>
            </div>
        </div>
    </div>

    <script>
        window.addEventListener('close-modal-event', function() {
            $('.modal').modal('hide');
        })
    </script>
</div>
