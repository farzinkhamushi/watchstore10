<?php

namespace App\GraphQL\Types;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;

class ProductType extends GraphQLType
{

    protected $attributes = [
        'name' => 'Product',
        'description' => 'A product'
    ];

    public function fields(): array {
        return [
            'id' => [
                'type' => Type::nonNull(Type::int()),
            ],
            'name' => [
                'type' => Type::string(),
            ],
            'description' => [
                'type' => Type::string(),
            ],
            'price' => [
                'type' => Type::float(),
            ],
            'category' => [
                'type' => \GraphQL::type('Category'),
            ],
            'brand' => [
                'type' => \GraphQL::type('Brand'),
            ],
            'color' => [
                'type' => \GraphQL::type('Color'),
            ],
        ];
    }


}
