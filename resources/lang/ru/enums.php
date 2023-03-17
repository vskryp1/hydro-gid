<?php

    use App\Enums\ProductAvailability;
    use App\Enums\ProductSaleType;
    use App\Enums\DeliveryType;
    use App\Enums\ServiceType;

    return [

        ProductAvailability::class => [
            ProductAvailability::NOT_AVAILABLE     => 'Нет в наличии',
            ProductAvailability::AVAILABLE         => 'В наличии',
            ProductAvailability::EXPECTED_DELIVERY => 'Ожидается поставка',
            ProductAvailability::UNDER_ORDER       => 'Под заказ',
        ],
        ProductSaleType::class     => [
            ProductSaleType::WHOLESALE        => 'Розница',
            ProductSaleType::RETAIL           => 'Опт',
            ProductSaleType::WHOLESALE_RETAIL => 'Опт и розница',
        ],
        DeliveryType::class        => [
            DeliveryType::PICKUP           => 'Cамовывоз из магазина',
            DeliveryType::PICKUP_NP        => 'Самовывоз из Новой почты',
            DeliveryType::COURIER_NP       => 'Курьер Новой почты',
            DeliveryType::DELIVERY_COMPANY => 'Другие транспортные компании',
        ],
        ServiceType::class         => [
            ServiceType::ORDER    => 'Форма заказа услуги',
            ServiceType::CALLBACK => 'Заказать звонок',
            ServiceType::QUESTION => 'Форма вопросы и ответы',
            ServiceType::CONTACT  => 'Форма контактов',
        ],
    ];