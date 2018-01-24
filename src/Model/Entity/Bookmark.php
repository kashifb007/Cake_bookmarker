<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\Collection\Collection;
/**
 * Bookmark Entity
 *
 * @property int $id
 * @property int $user_id
 * @property string $title
 * @property string $description
 * @property string $url
 * @property bool $favourite
 * @property int $sort_order
 * @property \Cake\I18n\FrozenTime $last_visited
 * @property int $no_visits
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 * @property string $bookmark_status
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Category[] $categories
 * @property \App\Model\Entity\Tag[] $tags
 */
class Bookmark extends Entity
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
        'user_id' => true,
        'title' => true,
        'description' => true,
        'url' => true,
        'favourite' => true,
        'sort_order' => true,
        'last_visited' => true,
        'no_visits' => true,
        'created' => true,
        'modified' => true,
        'bookmark_status' => true,
        'user' => true,
        'categories' => true,
        'tags' => true,
        'tag_string' => true
    ];

    protected function _getTagString()
    {
        if (isset($this->_properties['tag_string'])) {
            return $this->_properties['tag_string'];
        }
        if (empty($this->tags)) {
            return '';
        }
        $tags = new Collection($this->tags);
        $str = $tags->reduce(function ($string, $tag) {
            return $string . $tag->title . ', ';
        }, '');
        return trim($str, ', ');
    }

}
