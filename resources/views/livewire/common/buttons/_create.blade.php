@if (checkRoutePermission('create'))
<button type="button" data-toggle="modal" data-target="#modalCreateEdit" title="{{__('common.button.create')}}"  wire:click="resetInputFields" class="btn-sm btn-primary" wire:click="create"><i class="fa fa-plus"></i> {{__('common.button.create_upper')}}</button>
@endif
