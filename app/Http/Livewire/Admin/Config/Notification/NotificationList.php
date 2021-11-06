<?php

namespace App\Http\Livewire\Admin\Config\Notification;

use App\Enums\ENotificationType;
use App\Enums\EScheduleType;
use App\Enums\ESystemConfigType;
use App\Models\Notification;
use App\Models\SystemConfig;
use Illuminate\Support\Facades\Queue;
use Livewire\Component;

class NotificationList extends Component
{

    public SystemConfig $model;
    public $types;

    public $selectedType;
    public $selectedData;

    protected $listeners = [
        'save-model-event' => 'saveModel'
    ];

    public function mount()
    {
        $this->model = SystemConfig::query()
            ->where('model_name', Notification::class)
            ->where('admin_id', auth()->id())
            ->firstOrNew();

        $this->types = $this->model->content ?? [];

        if (!$this->model->exists) {
            $types = ENotificationType::getList();
            $names = array_flip(ENotificationType::getConstants());

            foreach ($types as $type => $value) {
                $this->types[$type] = [
                    "name" => $names[$type],
                    "via" => [],
                    "remind_before" => 10,
                    "deadline" => date('Y-m-d'),

                ];
            }
        }
    }

    public function render()
    {
        return view('livewire.admin.config.notification.notification-list');
    }

    public function toggleMethod($type, $method, $isActive)
    {
        // dd($type, $method, $isActive);
        $methods = $this->types[$type]['via'] ?? [];
        if ($isActive) {
            $methods[] = $method;
        } else {
            $methods = array_values(array_diff($methods, [$method]));
        }
        $this->types[$type]['via'] = $methods;
    }

    public function saveModel($type = null, $data = null)
    {
        if ($type != null && $data != null) {
            $this->types[$type] = $data;
        }

        $this->model->model_name = Notification::class;
        $this->model->admin_id = auth()->id();
        $this->model->type = ESystemConfigType::NOTIFICATION;
        $this->model->content = ($this->types);
        $this->model->name = 'Notification Configuration';
        $this->model->save();
        $this->dispatchBrowserEvent('show-toast', ['message' => __('notification.common.success.configure'), 'type' => 'success']);

        $this->dispatchBrowserEvent('close-modal-event');
    }
}
