<?php

namespace Saade\FilamentFullCalendar\Widgets\Forms;

use Filament\Forms;

trait EditEventForm {

    public $editEventFormState = [];

    public function getEditEventModalCloseButtonLabel(): string {

        return $this->editEventForm->isDisabled()
            ? __('filament-support::actions/view.single.modal.actions.close.label')
            : __('filament::resources/pages/edit-record.form.actions.cancel.label');
    }

    public function getEditEventModalSubmitButtonLabel(): string {

        return __('filament::resources/pages/edit-record.form.actions.save.label');
    }

    public function getEditEventModalTitle(): string {

        return $this->editEventForm->isDisabled()
            ? __('filament::resources/pages/view-record.title', ['label' => $this->getModalLabel()])
            : __('filament::resources/pages/edit-record.title', ['label' => $this->getModalLabel()]);
    }

    public function onDeleteEventSubmit(): void {

        $this->deleteEvent($this->event);
        $this->dispatchBrowserEvent('close-modal', ['id' => 'fullcalendar--edit-event-modal']);
    }

    public function deleteEvent($event): void {
        // Override this function and do whatever you want with $data
    }

    public function onEditEventSubmit(): void {

        $this->editEvent($this->editEventForm->getState());
        $this->dispatchBrowserEvent('close-modal', ['id' => 'fullcalendar--edit-event-modal']);
    }

    public function editEvent(array $data): void {
        // Override this function and do whatever you want with $data
    }

    protected function getEditEventForm(): array {

        return [
            'editEventForm' => $this->makeForm()
                                    ->schema(static::getEditEventFormSchema())
                                    ->statePath('editEventFormState'),
        ];
    }

    protected static function getEditEventFormSchema(): array {

        return [
            Forms\Components\TextInput::make('title')
                                      ->required(),
            Forms\Components\DateTimePicker::make('start')
                                           ->required(),
            Forms\Components\DateTimePicker::make('end')
                                           ->default(NULL),
        ];
    }
}
