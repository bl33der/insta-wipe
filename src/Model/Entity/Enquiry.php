<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Enquiry Entity
 *
 * @property int $id
 * @property string $email
 * @property string $subject
 * @property string $message
 * @property \Cake\I18n\DateTime|null $created
 * @property bool $is_resolved
 */
class Enquiry extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array<string, bool>
     */
    protected array $_accessible = [
        'email' => true,
        'subject' => true,
        'message' => true,
        'created' => true,
        'is_resolved' => true,
    ];
}
