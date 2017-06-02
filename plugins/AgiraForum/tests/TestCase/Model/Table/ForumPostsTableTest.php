<?php
namespace AgiraForum\Test\TestCase\Model\Table;

use AgiraForum\Model\Table\ForumPostsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * AgiraForum\Model\Table\ForumPostsTable Test Case
 */
class ForumPostsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \AgiraForum\Model\Table\ForumPostsTable
     */
    public $ForumPosts;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.agira_forum.forum_posts',
        'plugin.agira_forum.forum_forums',
        'plugin.agira_forum.forum_topics',
        'plugin.agira_forum.forum_categories',
        'plugin.agira_forum.users'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('ForumPosts') ? [] : ['className' => 'AgiraForum\Model\Table\ForumPostsTable'];
        $this->ForumPosts = TableRegistry::get('ForumPosts', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ForumPosts);

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
