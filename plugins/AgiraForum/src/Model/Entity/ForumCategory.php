<?php
namespace AgiraForum\Model\Entity;

use Cake\ORM\Entity;

/**
 * ForumCategory Entity
 *
 * @property int $id
 * @property string $name
 * @property bool $active
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 *
 * @property \AgiraForum\Model\Entity\ForumTopic[] $forum_topics
 */
class ForumCategory extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        '*' => true,
        'id' => false
    ];
}
