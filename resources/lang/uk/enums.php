<?php

    use App\Enums\DeliveryType;
    use App\Enums\ProductAvailability;
    use App\Enums\ProductSaleType;

    return [

        ProductAvailability::class => [
            ProductAvailability::NOT_AVAILABLE     => 'Немає в наявності',
            ProductAvailability::AVAILABLE         => 'В наявності',
            ProductAvailability::EXPECTED_DELIVERY => 'Очікується поставка',
            ProductAvailability::UNDER_ORDER       => 'Під замовлення',
        ],
        ProductSaleType::class     => [
            ProductSaleType::WHOLESALE        => 'Роздріб',
            ProductSaleType::RETAIL           => 'Опт',
            ProductSaleType::WHOLESALE_RETAIL => 'Опт і роздріб',
        ],
        DeliveryType::class        => [
            DeliveryType::PICKUP           => 'Самовивіз з магазину',
            DeliveryType::PICKUP_NP        => 'Самовивіз з Нової пошти',
            DeliveryType::COURIER_NP       => 'Кур\'єр Нової пошти',
            DeliveryType::DELIVERY_COMPANY => 'Інші транспортні компанії',
        ],
        ServiceType::class         => [
            ServiceType::ORDER    => 'Форма замовлення послуги',
            ServiceType::CALLBACK => 'Форма зворотного зв\'язку',
            ServiceType::QUESTION => 'Форма питання і відповіді',
            ServiceType::CONTACT  => 'Форма контактів',
        ],
    ];
