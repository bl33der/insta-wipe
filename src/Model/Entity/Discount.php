<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Discount Entity
 *
 * @property int $discount_id
 * @property string|null $discount_code
 * @property string|null $discount_description
 * @property string|null $discount_amount
 * @property \Cake\I18n\Date|null $start_date
 * @property \Cake\I18n\Date|null $end_date
 * @property bool|null $is_active
 */
class Discount extends Entity
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
        'discount_code' => true,
        'discount_description' => true,
        'discount_amount' => true,
        'start_date' => true,
        'end_date' => true,
        'is_active' => true,
    ];
}
