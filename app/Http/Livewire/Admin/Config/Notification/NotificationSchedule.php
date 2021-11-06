<?php

namespace App\Http\Livewire\Admin\Config\Notification;

use App\Enums\ENotificationType;
use App\Enums\EScheduleType;
use App\Enums\EWeekDays;
use Carbon\Carbon;
use Exception;
use Livewire\Component;

class NotificationSchedule extends Component
{

    // basic
    public $notificationName;
    public $notificationType;
    public $data;
    public $inGroup2;

    // input fields
    public $remindBefore;
    public $deadline;

    protected function getListeners()
    {
        return [
            ('set-deadline-' . $this->notificationType) => 'setDeadline'
        ];
    }

    protected function rules()
    {
        return [
            'remindBefore' => 'nullable|numeric|min:0',
            'deadline' => 'nullable|date|after:now',
        ];        
    }

    protected function getValidationAttributes()
    {
        return [
            'remindBefore' => __('data_field_name.notification.schedule_remind_before'),
            'deadline' => __('data_field_name.notification.schedule_deadline'),
        ];
    }

    public function mount($notificationType, $data)
    {

        $this->notificationType = $notificationType;
        $this->data = $data;
        $this->notificationName = explode("|", __('data_field_name.notification.type_' . strtolower($data['name'])));
        $this->inGroup2 = ENotificationType::inGroup2($notificationType);

        $this->deadline = $this->data['deadline'] ?? Carbon::now();
        $this->remindBefore = $this->data['remind_before'] ?? 10;
    }

    public function render()
    {
        return view('livewire.admin.config.notification.notification-schedule');
    }

    public function saveSchedule()
    {

        $this->validate();
        $this->data['deadline'] = $this->deadline;
        $this->data['remind_before'] = $this->remindBefore;
        $this->emitUp('save-model-event', $this->notificationType, $this->data);
    }

    public function setDeadline($value) {
        $this->deadline = date('Y-m-d', strtotime($value['deadline-' . $this->notificationType]));
    }
}
