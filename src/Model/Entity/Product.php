<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Product Entity
 *
 * @property int $product_id
 * @property string|null $product_name
 * @property int|null $category_id
 * @property string|null $price
 * @property int|null $stock_quantity
 * @property string|null $description
 * @property string|null $img_url
 *
 * @property \App\Model\Entity\Category $category
 */
class Product extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array<string, bool>
     */
    protected array $_accessible = [
        'product_name' => true,
        'category_id' => true,
        'price' => true,
        'description' => true,
        'img_url' => true,
        'category' => true,
        'is_enabled' => true,
    ];
}
