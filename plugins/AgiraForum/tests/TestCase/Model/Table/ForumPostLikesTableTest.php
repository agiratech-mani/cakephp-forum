<?php
namespace AgiraForum\Test\TestCase\Model\Table;

use AgiraForum\Model\Table\ForumPostLikesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * AgiraForum\Model\Table\ForumPostLikesTable Test Case
 */
class ForumPostLikesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \AgiraForum\Model\Table\ForumPostLikesTable
     */
    public $ForumPostLikes;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.agira_forum.forum_post_likes',
        'plugin.agira_forum.users',
        'plugin.agira_forum.forum_posts',
        'plugin.agira_forum.forum_forums',
        'plugin.agira_forum.forum_topics',
        'plugin.agira_forum.forum_categories',
        'plugin.agira_forum.forum_tags',
        'plugin.agira_forum.forum_forums_forum_tags'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('ForumPostLikes') ? [] : ['className' => 'AgiraForum\Model\Table\ForumPostLikesTable'];
        $this->ForumPostLikes = TableRegistry::get('ForumPostLikes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ForumPostLikes);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
