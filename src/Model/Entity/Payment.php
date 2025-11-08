<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Payment Entity
 *
 * @property int|null $order_id
 * @property \Cake\I18n\DateTime|null $order_date
 * @property string|null $order_status
 * @property string|null $total_amount
 * @property int $payment_id
 * @property string|null $payment_method
 * @property \Cake\I18n\DateTime|null $payment_date
 *
 * @property \App\Model\Entity\Order $order
 */
class Payment extends Entity
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
        'order_id' => true,
        'order_date' => true,
        'order_status' => true,
        'total_amount' => true,
        'payment_method' => true,
        'payment_date' => true,
        'order' => true,
    ];
}
