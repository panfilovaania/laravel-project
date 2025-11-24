<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Resource>
 */
class ResourceFactory extends Factory
{
     protected $resourceNames = [
        'vr-helmet-oculus', 'vr-helmet-htc', 'vr-helmet-valve', 'vr-helmet-psvr',
        'motion-controllers', 'haptic-gloves', 'vr-treadmill', 'motion-camera',
        'vr-pc-station', 'vr-console-station', 'surround-sound-system',
        'vr-charging-station', 'vr-sanitizer', 'vr-headset-stand',
        'high-end-gpu', 'motion-sensors', 'vr-backpack-pc', 'wireless-adapter'
    ];

    protected $resourceLabels = [
        'VR Шлем Oculus', 'VR Шлем HTC', 'VR Шлем Valve', 'VR Шлем PSVR',
        'Мotion Контроллеры', 'Тактические Перчатки', 'VR Беговая Дорожка', 'Камера Движения',
        'VR PC Станция', 'VR Консольная Станция', 'Система Объемного Звука',
        'Зарядная Станция', 'Стерилизатор VR', 'Стойка для VR Шлемов',
        'Мощная Видеокарта', 'Датчики Движения', 'VR Рюкзак-ПК', 'Беспроводной Адаптер'
    ];

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
         $index = array_rand($this->resourceNames);
        
        return [
            'name' => $this->resourceNames[$index],
            'label' => $this->resourceLabels[$index],
            'available' => true
        ];
    }
}
