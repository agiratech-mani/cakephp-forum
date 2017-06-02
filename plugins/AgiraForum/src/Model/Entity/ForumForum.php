<?php
namespace AgiraForum\Model\Entity;

use Cake\ORM\Entity;

/**
 * ForumForum Entity
 *
 * @property int $id
 * @property int $forum_topic_id
 * @property string $title
 * @property string $content
 * @property int $user_id
 * @property int $status
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 *
 * @property \AgiraForum\Model\Entity\ForumTopic $forum_topic
 * @property \AgiraForum\Model\Entity\User $user
 * @property \AgiraForum\Model\Entity\ForumPost[] $forum_posts
 */
class ForumForum extends Entity
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
