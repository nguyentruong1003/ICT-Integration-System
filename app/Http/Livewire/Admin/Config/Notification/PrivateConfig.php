<?php

namespace App\Http\Livewire\Admin\Config\Notification;

use App\Enums\ENotificationType;
use App\Enums\ESystemConfigType;
use App\Models\Notification;
use App\Models\SystemConfig;
use Carbon\Carbon;
use Exception;
use Livewire\Component;

class PrivateConfig extends Component
{
    public $model;
    public $config;

    public $topicDeadline;
    public $topicRemindBefore;
    public $ideaDeadline;
    public $ideaRemindBefore;
    public $deliveringRemindBefore;

    protected $listeners = [
        'set-idea-deadline' => 'setIdeaDeadline',
        'set-topic-deadline' => 'setTopicDeadline'
    ];

    protected function rules()
    {
        return [
            'topicDeadline' => 'nullable|after:now',
            'topicRemindBefore' => 'nullable|numeric|min:0',
            'ideaDeadline' => 'nullable|after:now',
            'ideaRemindBefore' => 'nullable|numeric|min:0',
            'deliveringRemindBefore' => 'nullable|numeric|min:0'
        ];
    }

    protected function getValidationAttributes()
    {
        return [
            'topicDeadline' => __('data_field_name.notification.schedule_deadline'),
            'topicRemindBefore' => __('data_field_name.notification.schedule_remind_before'),
            'ideaDeadline' => __('data_field_name.notification.schedule_deadline'),
            'ideaRemindBefore' => __('data_field_name.notification.schedule_remind_before'),
            'deliveringRemindBefore' => __('data_field_name.notification.schedule_remind_before')
        ];
    }

    public function mount()
    {
        $this->model = SystemConfig::firstOrCreate([
            'name' => 'Deadline Configuration',
            'admin_id' => null,
            'type' => ESystemConfigType::NOTIFICATION,
            'model_name' => Notification::class,
        ]);

        $this->config = $this->model->content ?? [
            ENotificationType::IDEA_DEADLINE => [
                'name' => 'TOPIC_DEADLINE',
                'deadline' => '',
                'remind_before' => 15
            ],
            ENotificationType::TOPIC_DEADLINE => [
                'name' => 'TOPIC_DEADLINE',
                'deadline' => '',
                'remind_before' => 15
            ],
            ENotificationType::DELIVERING => [
                'name' => 'DELIVERING',
                'remind_before' => 3
            ]
        ];

        $this->ideaDeadline = $this->config[ENotificationType::IDEA_DEADLINE]['deadline'] ?? '';
        $this->ideaRemindBefore = $this->config[ENotificationType::IDEA_DEADLINE]['remind_before'] ?? 15;

        $this->topicDeadline = $this->config[ENotificationType::TOPIC_DEADLINE]['deadline'] ?? '';
        $this->topicRemindBefore = $this->config[ENotificationType::TOPIC_DEADLINE]['remind_before'] ?? 15;

        $this->deliveringRemindBefore = $this->config[ENotificationType::DELIVERING]['remind_before'] ?? 15;
    }

    public function render()
    {
        return view('livewire.admin.config.notification.private-config');
    }

    public function save()
    {
        $this->validate();

        $this->config[ENotificationType::IDEA_DEADLINE]['deadline'] = $this->ideaDeadline;
        $this->config[ENotificationType::IDEA_DEADLINE]['remind_before'] = $this->ideaRemindBefore;

        $this->config[ENotificationType::TOPIC_DEADLINE]['deadline'] = $this->topicDeadline;
        $this->config[ENotificationType::TOPIC_DEADLINE]['remind_before'] = $this->topicRemindBefore;

        $this->config[ENotificationType::DELIVERING]['remind_before'] = $this->deliveringRemindBefore;

        $this->model->content = $this->config;
        $this->model->save();
        $this->dispatchBrowserEvent('show-toast', ['message' => __('notification.common.success.configure'), 'type' => 'success']);
    }

    public function setIdeaDeadline($value)
    {
        $this->ideaDeadline = date('Y-m-d', strtotime($value['idea-deadline']));
    }

    public function setTopicDeadline($value)
    {
        $this->topicDeadline = date('Y-m-d', strtotime($value['topic-deadline']));
    }
}
