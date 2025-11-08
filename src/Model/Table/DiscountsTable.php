<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Discounts Model
 *
 * @method \App\Model\Entity\Discount newEmptyEntity()
 * @method \App\Model\Entity\Discount newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Discount> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Discount get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Discount findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Discount patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Discount> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Discount|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Discount saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Discount>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Discount>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Discount>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Discount> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Discount>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Discount>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Discount>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Discount> deleteManyOrFail(iterable $entities, array $options = [])
 */
class DiscountsTable extends Table
{
    /**
     * Initialize method
     *
     * @param array<string, mixed> $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('discounts');
        $this->setDisplayField('discount_id');
        $this->setPrimaryKey('discount_id');
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->scalar('discount_code')
            ->maxLength('discount_code', 255)
            ->allowEmptyString('discount_code');

        $validator
            ->scalar('discount_description')
            ->allowEmptyString('discount_description');

        $validator
            ->decimal('discount_amount')
            ->allowEmptyString('discount_amount');

        $validator
            ->date('start_date')
            ->allowEmptyDate('start_date');

        $validator
            ->date('end_date')
            ->allowEmptyDate('end_date');

        $validator
            ->boolean('is_active')
            ->allowEmptyString('is_active');

        return $validator;
    }
}
