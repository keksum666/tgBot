<?php

namespace App\Telegram;

use DefStudio\Telegraph\Facades\Telegraph;
use DefStudio\Telegraph\Handlers\WebhookHandler;
use DefStudio\Telegraph\Keyboard\Button;
use DefStudio\Telegraph\Keyboard\Keyboard;
use DefStudio\Telegraph\Keyboard\ReplyButton;
use DefStudio\Telegraph\Keyboard\ReplyKeyboard;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Stringable;

class Handler extends WebhookHandler
{
    public function start(): void
    {
        $this->chat->html("Выбери ")
            ->replyKeyboard($this->getMainMenuButtons())->send();
    }

    protected function handleUnknownCommand(Stringable $text): void
    {
        $this->chat->html('Не известная команда')
            ->replyKeyboard($this->getMainMenuButtons())->send();
    }

    protected function handleChatMessage(Stringable $text): void
    {
        switch ($text) {
            case 'Где находится корпус ИЭиБ':
                $this
                    ->chat
                    ->photo(Storage::disk('public')->path('1.jpg'))
                    ->message('Корпус ИЭиБ находится по андресу г.Ульяновск ул.Пушкинская д.4А, на входе вы увидите большую вывеску синего цвета, где написано: "Ульяновский государственный университет"')
                    ->send();
                break;
            case 'Как добраться до буфета':
                $this
                    ->chat
                    ->photo(Storage::disk('public')->path('3.jpg'), '3.jpg')
                    ->message('Буфет находится слева от входа по коридору, рядом с автоматами быстрого питания.')->send();
                break;
            case 'Факультет деканата управления':
                $this
                    ->chat
                    ->photo(Storage::disk('public')->path('4.jpg'), '3.jpg')
                    ->message('Кабинет декана факультета управления находится на 6 этаже справа при выходе из лифта до белой двери, после налево, номер кабинета 606.')->send();
                break;
            case 'Где находится конференц зал':
                $this->chat
                    ->photo(Storage::disk('public')->path('5.jpg'))
                    ->message('Конференц-зал находится на 1 этаже справа от входа, прямо по коридору до белой двери, после направо, номер кабинета 112.')->send();
                break;
            case 'Библиотека':
                $this->chat
                    ->photo(Storage::disk('public')->path('6.jpg'))
                    ->message('Библиотека/ читальный зал находится на 8 этаже в 803 кабинете слева при выходе из лифта до белой двери, после направо и прямо.')->send();
                break;
            case 'Зона отдыха':
                $this->chat
                    ->photo(Storage::disk('public')->path('7.jpg'))
                    ->message('Зона отдыха находится на 5 этаже, опознавательные предметы: синий большой диван, маленькие оранжевые пуфики.')->send();
                break;
            case 'Как добраться до Пушкинской 4а':
                $this->chat->html("<strong>tttt!</strong>\n\nI'm here!")
                    ->replyKeyboard($this->getRoadButtons())->send();
                break;
            case 'Какие кабинеты нужно знать первокурсникам':
                $this->chat
                    ->photo(Storage::disk('public')->path('8.jpg'))
                    ->message('Кабинеты, которые нужно знать первокурснику: а) деканат таможенного дела находится на 1 этаже, слева от входа, прямо по коридору, после налево номер  кабинет 110. б) кафедра менеджмента и теории экономики находится на 6 этаже справа при выходе из лифта до белой двери, после налево, номер кабинета 609. в) кафедра экономического анализа и государственного управления находится на 6 этаже справа при выходе из лифта до белой двери, после налево, номер кабинета 610.')->send();
                break;
            case 'Контакты':
                $this->chat->message('Наш сайт: https://ulsu.ru/ru/
Наша почта: contact@ulsu.ru')->send();
                break;
            case 'Назад':
                $this->chat->html('Выбери пункт')->replyKeyboard($this->getMainMenuButtons())->send();
                break;
        }
    }

    private function getMainMenuButtons(): ReplyKeyboard
    {
        return ReplyKeyboard::make()
            ->row([
                ReplyButton::make('Где находится корпус ИЭиБ'),
            ])
            ->row([
                ReplyButton::make('Как добраться до буфета'),
                ReplyButton::make('Где находится конференц зал'),
            ])
            ->row([
                ReplyButton::make('Факультет деканата управления'),
                ReplyButton::make('Библиотека'),
            ])
            ->row([
                ReplyButton::make('Зона отдыха'),
                ReplyButton::make('Контакты')
            ])
            ->row([
                ReplyButton::make('Какие кабинеты нужно знать первокурсникам'),
            ]);
    }

    private function getRoadButtons(): ReplyKeyboard
    {
        return ReplyKeyboard::make()
            ->row([
                ReplyButton::make('Новый город'),
                ReplyButton::make('Верхняя терраса'),
            ])
            ->row([
                ReplyButton::make('Нижняя терраса'),
                ReplyButton::make('Заволжье'),
            ])
            ->row([
                ReplyButton::make('Назад')
            ]);
    }
}
